<?php
class Category extends AppModel {
	public $name = 'Category';
	public $displayField = 'name';
	
	var $hasMany = 'SubCategory';
	
	var $_schema = array(
        'name'		=>array('type'=>'string', 'length'=>100)
	);

	var $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Le champ name doit être rempli.'
                )
                ));
}
?>
