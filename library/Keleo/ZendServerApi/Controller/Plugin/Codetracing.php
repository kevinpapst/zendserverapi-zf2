<?php

namespace Keleo\ZendServerApi\Controller\Plugin;

class Codetracing extends AbstractBaseApiPlugin
{
    /**
     * @return string
     */
    protected function getBaseApiFactoryKey()
    {
        return 'codetracing';
    }

}
