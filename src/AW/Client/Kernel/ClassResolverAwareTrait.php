<?php

namespace AW\Client\Kernel;

use AW\Client\Kernel\DependencyInjection\DependencyInjectionClassResolver;
use AW\Shared\Kernel\ClassResolver\AbstractDependencyInjectionClassResolver;

trait ClassResolverAwareTrait
{
    /**
     * @template T
     * @param string|class-string<T> $className
     *
     * @return mixed|T
     */
    public function resolveClass(string $className): mixed
    {
        return $this->getClassResolver()->resolveClass($className);
    }

    /**
     * @return \AW\Shared\Kernel\ClassResolver\AbstractDependencyInjectionClassResolver
     */
    private function getClassResolver(): AbstractDependencyInjectionClassResolver
    {
        return new DependencyInjectionClassResolver();
    }
}