<?php

namespace AW\Yves\Kernel\DependencyInjection;

use AW\Shared\Kernel\ClassResolver\AbstractDependencyInjectionClassResolver;
use Spryker\Shared\Kernel\ClassResolver\AbstractClassResolver;
use Spryker\Shared\Kernel\LocatorLocatorInterface;
use Spryker\Yves\Kernel\ClassResolver\DependencyProvider\DependencyProviderResolver;
use Spryker\Yves\Kernel\ClassResolver\Factory\FactoryResolver;
use Spryker\Yves\Kernel\Locator;

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