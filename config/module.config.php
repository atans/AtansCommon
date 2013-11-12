<?php

return array(
    'controller_plugins' => array(
        'invokables' => array(
            'ajax' => 'AtansCommon\Controller\Plugin\Ajax',
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_map' => array(
            'alert/bootstrap'       => __DIR__ . '/../view/alert/bootstrap.phtml',
            'navigation/bootstrap'  => __DIR__ . '/../view/navigation/bootstrap.phtml',
            'pagination/query'      => __DIR__ . '/../view/pagination/query.phtml',
        ),
    ),
);
