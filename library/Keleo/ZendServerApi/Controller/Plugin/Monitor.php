<?php

namespace Keleo\ZendServerApi\Controller\Plugin;

class Monitor extends AbstractBaseApiPlugin
{
    /**
     * @return string
     */
    protected function getBaseApiFactoryKey()
    {
        return 'monitor';
    }

}
