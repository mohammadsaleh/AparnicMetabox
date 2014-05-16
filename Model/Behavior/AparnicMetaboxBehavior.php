<?php
class AparnicMetaboxBehavior extends ModelBehavior{
    
    private $__request;
    
    public function setup(Model $Model, $config = Array()) {
        $this->__request = Router::getRequest(true);
    }
    
    public function afterFind(Model $model, $results, $primary = false) {
        if(isset($this->__request->params['admin']) && $this->__request->params['admin']){
            $metaBoxFields = $this->__getAparnicMetaboxFields();
    //        debug($results);
            if(!empty($metaBoxFields)){
                
                foreach ($results as &$result) {
                    if(isset($result['Meta'])){
                        foreach($result['Meta'] as $key => $meta){
                            if(in_array($meta['key'], $metaBoxFields)){
                                $result['AparnicMetabox'][$meta['key']] = array_intersect_key(
                                    $meta, 
                                    array('id' => '', 'key' => '', 'value' => '')
                                );
                                unset($result['Meta'][$key]);
                            }
                        }
                    }
                }
                
            }
        }
//        debug($results);
        return $results;
    }
    //----------------------------------------------------------
    private function __getAparnicMetaboxFields() {
        $boxes = Configure::read('AparnicMetabox.boxes');
        $currentAction = Inflector::camelize($this->__request->params['controller']) . '/' . $this->__request->params['action'];
        if(isset($boxes[$currentAction])){
            $boxes = $boxes[$currentAction];
            $ext = Set::extract('{n}.{n}.name', $boxes);
            $fields = Set::flatten($ext);
    //        debug($fields);
            return $fields;
        }
        return false;
    }
}

