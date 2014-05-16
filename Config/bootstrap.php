<?php
Croogo::hookHelper('*', 'AparnicMetabox.AparnicMetabox');
Croogo::hookBehavior('Node', 'AparnicMetabox.AparnicMetabox');

App::uses('AparnicMetabox', 'AparnicMetabox.Lib');
AparnicMetabox::addMetaJson('AparnicMetabox');
