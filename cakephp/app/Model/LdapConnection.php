<?php

App::uses('LdapUser', 'Model');

class LdapConnection extends AppModel {

	var $useTable = false;
	var $name = 'LdapConnection';

	private $host;
	private $port;
	private $baseDn;
	private $login;
	private $password;

	private $ldapConnection;

	public function __construct()
	{
		parent::__construct();
	}

	private function checkConfiguration()
	{
			
		$ldapServerConfiguration = get_class_vars('DATABASE_CONFIG');

		if(!empty($ldapServerConfiguration['ldap']['host'])
		&& !empty($ldapServerConfiguration['ldap']['port'])
		&& !empty($ldapServerConfiguration['ldap']['baseDn'])
		&& !empty($ldapServerConfiguration['ldap']['login'])
		&& !empty($ldapServerConfiguration['ldap']['password']))
		{
			$this->host =  $ldapServerConfiguration['ldap']['host'];
			$this->port =  $ldapServerConfiguration['ldap']['port'];
			$this->baseDn =  $ldapServerConfiguration['ldap']['baseDn'];
			$this->login =  $ldapServerConfiguration['ldap']['login'];
			$this->password =  $ldapServerConfiguration['ldap']['password'];
			return true;
		}

		throw  new Exception ('The ldap configuration is not valid : <br />
			<ul>
				<li>host = ' . @$ldapServerConfiguration['ldap']['host'] . '</li>
				<li>port = ' . @$ldapServerConfiguration['ldap']['port'] . '</li>
				<li>baseDn = ' . @$ldapServerConfiguration['ldap']['baseDn'] . '</li>
				<li>login = ' . @$ldapServerConfiguration['ldap']['login'] . '</li>
				<li>password = ' . @$ldapServerConfiguration['ldap']['password'] . '</li>
			</ul>'
			);
	}

	private function connect() {

		try {

			if(empty($this->ldapConnection) && $this->checkConfiguration())
			{
				$this->ldapConnection = ldap_connect($this->host, $this->port);
				ldap_set_option($this->ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
				if(!@ldap_bind($this->ldapConnection, $this->login, $this->password)) {
					throw new Exception ('The connection to the ldap server is imposible : <br />
						<ul>
							<li>login = ' . $this->login . '</li>
							<li>password = ' . $this->password . '</li>
						</ul>' 
					
						);
				}
					
			}
		}
		catch(Exception $e)
		{
			throw  $e;
		}
	}

	private function findAll($attribute = 'cn', $value = '*')
	{
		$this->connect();
		$result = ldap_search($this->ldapConnection, $this->baseDn, $attribute . '=' . $value);

		if ($result)
		{
			ldap_sort($this->ldapConnection, $result, $attribute);

			$res = ldap_get_entries($this->ldapConnection, $result);
		
			return $res;
		}
	}

	public function auth($user, $password)
	{
		$result = $this->findAll('cn', $user);

		if(@$result[0])
		{
			$founddCn = @$result[0]['cn'][0];
			$foundPass = @$result[0]['userpassword'][0];
			$foundMail = @$result[0]['mail'][0];

			if(!strcmp($founddCn, $user) && !strcmp($foundPass, $password))
			{
				$foundedUser = new LdapUser($founddCn, $foundPass, $foundMail); 
				
				return $foundedUser;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>