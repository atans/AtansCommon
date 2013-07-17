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
    ),
);
