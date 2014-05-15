<?php

class AparnicMetaboxComponent extends Component{
    
    public function startup(Controller $controller) {
        $currentAction = Inflector::camelize($controller->request->params['controller']) . '/' . $controller->request->params['action'];
        Configure::write('currentAction', $currentAction);
    }
}
