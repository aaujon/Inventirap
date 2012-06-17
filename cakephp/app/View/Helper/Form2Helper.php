<?php  
class Form2Helper extends FormHelper 
{ 
    function input($fieldName, $options = array()) { 
        $this->setEntity($fieldName); 
         
        $modelKey = $this->model(); 
        $fieldKey = $this->field(); 

        if (!isset($this->fieldset[$modelKey])) { 
            $this->_introspectModel($modelKey); 
        } 

        if ((!isset($options['type']) || $options['type'] == 'select') && !isset($options['options'])) { 
            if(isset($this->fieldset[$modelKey]['fields'][$fieldKey])) 
            { 
                $type = $this->fieldset[$modelKey]['fields'][$fieldKey]['type']; 
                if(substr($type, 0, 4) == 'enum') 
                { 
                    $arr = explode('\'', $type); 
                    $enumValues = array(); 
                    foreach($arr as $value) 
                    { 
                        if($value != 'enum(' && $value != ',' && $value != ')') 
                            $options['options'][$value] = __($value, true); 
                    } 
                } 
            } 
        } 
         
        return parent::input($fieldName, $options); 
    } 
} 
?>
