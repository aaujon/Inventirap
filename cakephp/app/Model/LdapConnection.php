<?php

App::uses('LdapUser', 'Model');

class LdapConnection extends AppModel {

	var $useTable = false;
	var $name = 'LdapConnection';

	private $host;
	private $port;
	private $baseDn;
	private $authenticationType;

	public function __construct() {
		parent::__construct();
	}

	private function checkConfiguration()
	{
			
		$ldapServerConfiguration = get_class_vars('DATABASE_CONFIG');

		if(!empty($ldapServerConfiguration['ldap']['host'])
		&& !empty($ldapServerConfiguration['ldap']['port'])
		&& !empty($ldapServerConfiguration['ldap']['baseDn'])
		&& !empty($ldapServerConfiguration['ldap']['authenticationType']))
		{
			$this->host =  $ldapServerConfiguration['ldap']['host'];
			$this->port =  $ldapServerConfiguration['ldap']['port'];
			$this->baseDn =  $ldapServerConfiguration['ldap']['baseDn'];
			$this->authenticationType =  $ldapServerConfiguration['ldap']['authenticationType'];
			return true;
		}

		throw  new Exception ('The ldap configuration is not valid : <br />
			<ul>
				<li>host = ' . @$ldapServerConfiguration['ldap']['host'] . '</li>
				<li>port = ' . @$ldapServerConfiguration['ldap']['port'] . '</li>
				<li>baseDn = ' . @$ldapServerConfiguration['ldap']['baseDn'] . '</li>
				<li>authenticationType = ' . @$ldapServerConfiguration['ldap']['authenticationType'] . '</li>
			</ul>'
			);
	}
	
	public function getAllLdapUsers()
	{
		try {

			if($this->checkConfiguration())
			{
				$ldapConnection = ldap_connect($this->host, $this->port);
				ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
				$results = ldap_search($ldapConnection, $this->baseDn, 'uid=*');
				
				$res = ldap_get_entries($ldapConnection, $results);
	
				return $res;
				
			}
		}
		catch(Exception $e)
		{
			throw  $e;
		}
		
		return false;
	}

	public function ldapAuthentication($login, $password)
	{
		try {

			if($this->checkConfiguration())
			{
				$ldapConnection = ldap_connect($this->host, $this->port);
				
//				ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
//				$results = ldap_search($ldapConnection, $this->baseDn, $this->authenticationType . '=' . $login);
//				$res = ldap_get_entries($ldapConnection, $results);
//				return $res['count'] == 1;
				
				return ldap_bind($ldapConnection, $this->authenticationType . '=' . $login . ',' . $this->baseDn, $password);
			}
		}
		catch(Exception $e)
		{
			// throw  $e;
		}
		
		return false;
	}

}
?>