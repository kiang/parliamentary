<?php

Router::connect('/', array('controller' => 'parliamentarians', 'action' => 'stat'));
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
