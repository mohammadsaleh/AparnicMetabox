<?php
class AparnicMetaboxBehavior extends ModelBehavior{
    
    public function afterFind(Model $model, $results, $primary = false) {
        $metaBoxFields = $this->__getAparnicMetaboxFields();
//        debug($results);
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
//        debug($results);
        return $results;
    }
    //----------------------------------------------------------
    private function __getAparnicMetaboxFields() {
        $boxes = Configure::read('AparnicMetabox.boxes');
        $currentAction = Configure::read('currentAction');
        $boxes = $boxes[$currentAction];
        $ext = Set::extract('{n}.{n}.name', $boxes);
        $fields = Set::flatten($ext);
//        debug($fields);
        return $fields;
    }
}

