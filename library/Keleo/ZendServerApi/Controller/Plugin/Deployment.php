<?php

namespace Keleo\ZendServerApi\Controller\Plugin;

class Deployment extends AbstractBaseApiPlugin
{
    /**
     * @return string
     */
    protected function getBaseApiFactoryKey()
    {
        return 'deployment';
    }

}
