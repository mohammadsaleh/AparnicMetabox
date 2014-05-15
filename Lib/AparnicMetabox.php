<?php

App::uses('File', 'Utility');

/**
 * AparnicMetabox
 *
 * @version  1.0
 * @author   MohammadSaleh <mohammadsaleh.sayari@gmail.com>
 */
class AparnicMetabox {

    /**
     * Analyze meta.json
     * @param String $pluginName
     */
    public static function addMetaJson($pluginName) {

        $boxes = array();
        if (Configure::check('AparnicMetabox.boxes')) {
            $boxes = Configure::read('AparnicMetabox.boxes');
        }

        $json = self::getMetaJsonContent($pluginName);
//        debug($json);
//        exit();
        if (!is_array($json['targetAction'])) {
            $json['targetAction'] = array($json['targetAction']);
        }
        
        foreach ($json['boxes'] as $boxTitle => $fields) {
            foreach ($json['targetAction'] as $targetAction) {
                $boxes[$targetAction][] = $fields;
                Croogo::hookAdminBox($targetAction, $boxTitle, 'AparnicMetabox.metabox');
            }
        }
        Configure::write('AparnicMetabox.boxes', $boxes);
    }
    //----------------------------------------------------------
    /**
     * Reading meta.json content
     * @param String $pluginName
     * @return Array
     */
    public static function getMetaJsonContent($pluginName) {
        $jsonFile = new File(CakePlugin::path($pluginName) . 'Config' . DS . 'meta.json');
        $json = $jsonFile->read();
        $json = json_decode($json, true);
        return $json;
    }
    //----------------------------------------------------------

}
