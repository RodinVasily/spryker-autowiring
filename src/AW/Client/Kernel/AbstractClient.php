<?php

namespace AW\Client\Kernel;

use Spryker\Client\Kernel\AbstractClient as SprykerAbstractClient;

abstract class AbstractClient extends SprykerAbstractClient
{
    use ClassResolverAwareTrait;
}
