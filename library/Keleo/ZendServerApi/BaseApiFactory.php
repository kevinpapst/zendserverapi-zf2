<?php

namespace Keleo\ZendServerApi;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use RuntimeException;
use ReflectionClass;

class BaseApiFactory implements AbstractFactoryInterface
{
    private $availableServices = array('deployment', 'monitor');


    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return in_array($name, $this->availableServices);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $serviceLocator->get('Config');
        $server = $config['zsapi']['default_server'];

        if (!isset($config['zsapi'][$server])) {
            throw new RuntimeException('Could not find default server "'.$server.'"');
        }

        $settings = $config['zsapi'][$server];
        if (isset($config['zsapi']['settings'])) {
            $settings = array_merge($config['zsapi']['settings'], $settings);
        }

        $api = new ReflectionClass('\ZendService\ZendServerAPI\\' . ucfirst(strtolower($name)));
        $baseApi = $api->newInstance($settings);

        return $baseApi;
    }
}
