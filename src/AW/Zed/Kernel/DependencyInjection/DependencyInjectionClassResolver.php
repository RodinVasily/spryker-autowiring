<?php

namespace AW\Zed\Kernel\DependencyInjection;

use AW\Shared\Kernel\ClassResolver\AbstractDependencyInjectionClassResolver;
use Spryker\Shared\Kernel\ClassResolver\AbstractClassResolver;
use Spryker\Shared\Kernel\LocatorLocatorInterface;
use Spryker\Zed\Kernel\ClassResolver\Business\BusinessFactoryResolver;
use Spryker\Zed\Kernel\ClassResolver\DependencyProvider\DependencyProviderResolver;
use Spryker\Zed\Kernel\Locator;

class DependencyInjectionClassResolver extends AbstractDependencyInjectionClassResolver
{
    protected function getFactoryResolver(): AbstractClassResolver
    {
        return new BusinessFactoryResolver();
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