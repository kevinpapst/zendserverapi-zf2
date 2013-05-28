<?php

namespace Keleo\ZendServerApi\Controller\Plugin;

use Keleo\ZendServerApi\BaseApiFactory;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\Exception;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use ZendService\ZendServerAPI\BaseAPI;

abstract class AbstractBaseApiPlugin extends AbstractPlugin implements ServiceManagerAwareInterface
{
    /**
     * @var BaseAPI
     */
    protected $baseApi;
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @return string
     */
    protected abstract function getBaseApiFactoryKey();

    /**
     * Set service manager
     *
     * @param ServiceManager $serviceManager
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @param BaseAPI $baseApi
     */
    public function setBaseAPI(BaseAPI $baseApi)
    {
        $this->baseApi = $baseApi;
    }

    /**
     * @return BaseAPI
     */
    public function getBaseAPI()
    {
        return $this->baseApi;
    }

    /**
     * Returns the BaseAPI object
     *
     * @param string $server
     * @return BaseAPI
     */
    public function __invoke($server = null)
    {
        if ($this->baseApi === null) {
            $locator = $this->serviceManager->getServiceLocator();
            if ($server !== null) {
                $locator->setAllowOverride(true);
                $config = $locator->get('Config');
                $config['zsapi']['default_server'] = $server;
                $locator->setService('Config', $config);
            }
            $this->setBaseAPI($locator->get($this->getBaseApiFactoryKey()));
        }

        return $this->getBaseAPI();
    }

    public function get($server = null)
    {
        return $this($server);
    }

}
