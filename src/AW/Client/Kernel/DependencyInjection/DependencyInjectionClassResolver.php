<?php

namespace AW\Client\Kernel\DependencyInjection;

use AW\Shared\Kernel\ClassResolver\AbstractDependencyInjectionClassResolver;
use Spryker\Client\Kernel\ClassResolver\DependencyProvider\DependencyProviderResolver;
use Spryker\Client\Kernel\ClassResolver\Factory\FactoryResolver;
use Spryker\Client\Kernel\Locator;
use Spryker\Shared\Kernel\ClassResolver\AbstractClassResolver;
use Spryker\Shared\Kernel\LocatorLocatorInterface;

class DependencyInjectionClassResolver extends AbstractDependencyInjectionClassResolver
{
    protected function getFactoryResolver(): AbstractClassResolver
    {
        return new FactoryResolver();
    }

    protected function getLocator(): LocatorLocatorInterface
    {
        return Locator::getInstance();
    }

    protected function getDependencyProviderResolver(): AbstractClassResolver
    {
        return new DependencyProviderResolver();
    }
}