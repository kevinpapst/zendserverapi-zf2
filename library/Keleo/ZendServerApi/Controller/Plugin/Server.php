<?php

namespace Keleo\ZendServerApi\Controller\Plugin;

class Server extends AbstractBaseApiPlugin
{
    /**
     * @return string
     */
    protected function getBaseApiFactoryKey()
    {
        return 'server';
    }

}
