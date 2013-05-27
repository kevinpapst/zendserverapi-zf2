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
            'version' => \ZendService\ZendServerAPI\Version::ZS56,
            'name' => '',
            'key' => '',
            'host' => '.my.phpcloud.com',
            'port' => 10082,
            'timeout' => 60
        ),
        'settings' => array(
            'proxy' => '',
            'loglevel' =>  \Zend\Log\Logger::DEBUG
        )
    )
);
