<?php
$currentAction = Inflector::camelize($this->request->params['controller']) . '/' . $this->request->params['action'];
$box = array_shift($boxes[$currentAction]);
$this->set('boxes', $boxes);
$this->AparnicMetabox->create($box);