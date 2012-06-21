<?php

// Pass settings in $components array
public $components = array(
    'Auth' => array(
        'loginAction' => array(
            'controller' => 'SpecialUsers',
            'action' => 'login'
		),
        'authError' => 'Voius n\'êtes pas autorisé à effectuer cette action.',
        'authenticate' => array(
            'Form' => array(
                'fields' => array('uid' => 'password')
            )
        )
    )
);

?>