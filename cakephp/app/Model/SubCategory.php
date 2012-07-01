<?php
class SubCategory extends AppModel {
	public $name = 'SubCategory';
	public $displayField = 'name';

	var $belongsTo = 'Category';
	var $hasMany = 'Material';
	
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
