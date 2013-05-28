<?php

namespace Keleo\ZendServerApi\Controller\Plugin;

class Filter extends AbstractBaseApiPlugin
{
    /**
     * @return string
     */
    protected function getBaseApiFactoryKey()
    {
        return 'filter';
    }

}
