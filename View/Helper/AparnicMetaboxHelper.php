<?php
App::uses('File', 'Utility');
class AparnicMetaboxHelper extends AppHelper{
    
    public $helpers = array('Html', 'Form');
    
    public function beforeRender($viewFile) {
        $boxes = Configure::read('AparnicMetabox.boxes');
//        debug($boxes);
        $this->_View->set('boxes', $boxes);
    }
    //----------------------------------------------------------
    public function create($box = array()) {
        if(!empty($box)){
            foreach($box as $field){
                $field = array_merge( array(
                    'type' => 'text',
                    'name' => '',
                    'defaultValue' => ''
                ), $field);
                $fieldType = $field['type'];
                $fieldName = $field['name'];
                $defaultValue = $field['defaultValue'];
                $uuid = String::uuid();
                
                if(isset($this->request->data['AparnicMetabox'][$fieldName])){
                    $defaultValue = $this->request->data['AparnicMetabox'][$fieldName]['value'];
                    if(isset($this->request->data['AparnicMetabox'][$fieldName]['id'])){
                        echo $this->Form->input('Meta.' . $uuid . '.id', 
                            array(
                                'value' => $this->request->data['AparnicMetabox'][$fieldName]['id'],
                                'type' => 'hidden'
                            )
                        );
                        $this->Form->unlockField('Meta.' . $uuid . '.id');
                    }
                }
                echo $this->Form->input('Meta.' . $uuid . '.key', 
                    array(
                        'value' => $fieldName,
                        'type' => 'hidden'
                    )
                );
                echo $this->Form->input('Meta.' . $uuid . '.value', 
                    array(
                        'type' => $fieldType,
                        'label' => $fieldName,
                        'value' => $defaultValue
                    )
                );
                $this->Form->unlockField('Meta.' . $uuid . '.key');
		$this->Form->unlockField('Meta.' . $uuid . '.value');
            }
        }
    }
    //----------------------------------------------------------
}