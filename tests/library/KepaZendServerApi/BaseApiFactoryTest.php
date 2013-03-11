<?php

namespace tests;

use PHPUnit_Framework_TestCase;

class BaseApiFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testBaseApiFactory()
    {
        $config = array(
            "service_manager" => array(
                "abstract_factories" => array(
                    'zsapi' => 'KepaZendServerApi\BaseApiFactory'
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

        $serviceManager = new \Zend\ServiceManager\ServiceManager();
        $serviceManager->setService('Config', $config);

        $baseApiFactory = new \KepaZendServerApi\BaseApiFactory();
        $api = $baseApiFactory->createServiceWithName($serviceManager, 'deployment', 'deployment');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Deployment', $api);
    }

    public function testAvailableServices()
    {
        $config = array(
            "service_manager" => array(
                "abstract_factories" => array(
                    'zsapi' => 'KepaZendServerApi\BaseApiFactory'
                )
            )
        );

        $serviceManager = new \Zend\ServiceManager\ServiceManager();
        $serviceManager->setService('Config', $config);

        $baseApiFactory = new \KepaZendServerApi\BaseApiFactory();
        $api = $baseApiFactory->canCreateServiceWithName($serviceManager, 'deployment', 'deployment');
        $this->assertTrue($api);

        $api = $baseApiFactory->canCreateServiceWithName($serviceManager, 'monitor', 'deployment');
        $this->assertTrue($api);

        $api = $baseApiFactory->canCreateServiceWithName($serviceManager, 'bla', 'deployment');
        $this->assertFalse($api);
    }
}
