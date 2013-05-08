<?php

return array(
    "service_manager" => array(
        "abstract_factories" => array(
            'zsapi' => 'Keleo\ZendServerApi\BaseApiFactory'
        )
    ),
    'zsapi' => array(
        'settings' => array(
            'version' => \ZendService\ZendServerAPI\Version::ZS56,
            'name' => '',
            'key' => '',
            'host' => '.my.phpcloud.com',
            'port' => 10082,
            'timeout' => 60
        )
    )
);
