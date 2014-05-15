<?php
$currentAction = Configure::read('currentAction');
$box = array_shift($boxes[$currentAction]);
$this->set('boxes', $boxes);
$this->AparnicMetabox->create($box);