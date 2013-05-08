<?php

namespace KeleoTest\ZendServerAPI;

use PHPUnit_Framework_TestCase;

class BaseApiFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testBaseApiFactory()
    {
        $serviceManager = $this->getServiceManager();
        $config = $this->getServiceManagerConfig();

        $baseApiFactory = new \Keleo\ZendServerApi\BaseApiFactory();
        /* @var $api \ZendService\ZendServerAPI\Deployment */
        $api = $baseApiFactory->createServiceWithName($serviceManager, 'deployment', 'deployment');
        $this->assertInstanceOf('\ZendService\ZendServerAPI\Deployment', $api);

        $actual = $api->getRequest()->getConfig();
        $this->assertEquals($actual->getApiKey()->getKey(), $config['zsapi']['settings']['key']);
    }

    public function testAvailableServices()
    {
        $serviceManager = $this->getServiceManager();

        $baseApiFactory = new \Keleo\ZendServerApi\BaseApiFactory();
        $api = $baseApiFactory->canCreateServiceWithName($serviceManager, 'deployment', 'deployment');
        $this->assertTrue($api);

        $api = $baseApiFactory->canCreateServiceWithName($serviceManager, 'monitor', 'deployment');
        $this->assertTrue($api);

        $api = $baseApiFactory->canCreateServiceWithName($serviceManager, 'bla', 'deployment');
        $this->assertFalse($api);
    }

    protected function getServiceManagerConfig()
    {
        return array(
            "service_manager" => array(
                "abstract_factories" => array(
                    'zsapi' => 'Keleo\ZendServerApi\BaseApiFactory'
                )
            ),
            'zsapi' => array(
                'settings' => array(
                    'version' => \ZendService\ZendServerAPI\Version::ZS56,
                    'name' => 'foo',
                    'key' => '64eee272e1hbd5ghz4bf39b13932f75675f6c36c34522149f9bac0c9cb47c63e',
                    'host' => 'www.example.com',
                    'port' => 10082,
                    'timeout' => 60
                )
            )
        );
    }

    protected function getServiceManager()
    {
        $config = $this->getServiceManagerConfig();

        $serviceManager = new \Zend\ServiceManager\ServiceManager();
        $serviceManager->setService('Config', $config);

        return $serviceManager;
    }

}
