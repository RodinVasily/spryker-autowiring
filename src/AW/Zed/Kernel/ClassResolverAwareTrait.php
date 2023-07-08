<?php

namespace AW\Zed\Kernel;

use AW\Shared\Kernel\ClassResolver\AbstractDependencyInjectionClassResolver;
use AW\Zed\Kernel\DependencyInjection\DependencyInjectionClassResolver;

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