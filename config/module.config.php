<?php

return array(
    "service_manager" => array(
        "abstract_factories" => array(
            'zsapi' => 'Keleo\ZendServerApi\BaseApiFactory'
        )
    ),
    'zsapi' => array(
        'default_server' => 'general',
        'general' => array(
            'version'   => \ZendService\ZendServerAPI\Version::ZS56,
            'name'      => '',
            'key'       => '',
            'host'      => '.my.phpcloud.com',
            'port'      => 10082,
            'timeout'   => 60
        ),
        'settings' => array(
            'proxy' => '',
            'loglevel' =>  \Zend\Log\Logger::DEBUG
        )
    ),
    'controller_plugins' => array(
        'initializers' => array(
            'ServiceManagerAwareInterface' => function($service, $serviceManager) {
                if ($service instanceof \Zend\ServiceManager\ServiceManagerAwareInterface) {
                    $service->setServiceManager($serviceManager);
                }
            }
        ),
        'invokables' => array(
            'deployment'    => 'Keleo\Controller\Plugin\Deployment',
            'monitor'       => 'Keleo\Controller\Plugin\Monitor',
            'codetracing'   => 'Keleo\Controller\Plugin\Codetracing',
            'filter'        => 'Keleo\Controller\Plugin\Filter',
            'server'        => 'Keleo\Controller\Plugin\Server',
        )
    )
);
