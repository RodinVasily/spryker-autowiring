<?php

namespace AW\Shared\Kernel\ClassResolver;

use DI\ContainerBuilder;
use DI\Factory\RequestedEntry;
use AW\Shared\Kernel\DependencyInjection\ConfigurableDependencyInjectionInterface;
use AW\Shared\Kernel\KernelConfig;
use Spryker\Shared\Kernel\ClassResolver\AbstractClassResolver;
use Spryker\Shared\Kernel\ClassResolver\ClassInfo;
use Spryker\Shared\Kernel\LocatorLocatorInterface;

abstract class AbstractDependencyInjectionClassResolver
{
    /**
     * @var \AW\Shared\Kernel\KernelConfig
     */
    protected static $sharedConfig;

    /**
     * @template T
     *
     * @param string $className
     *
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     *
     * @return mixed|T
     */
    public function resolveClass(string $className): mixed
    {
        $dependencyProviderResolver = $this->getDependencyProviderResolver();
        $config = $dependencyProviderResolver->resolve($className);

        $moduleDependencyInjectionConfig = [];
        if ($config instanceof ConfigurableDependencyInjectionInterface) {
            $moduleDependencyInjectionConfig = $config->getDependencyInjectionConfig();
        }

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->useAutowiring(true);

        $containerBuilder->addDefinitions($this->getSprykerCoreDependencyInjectionConfig());
        $containerBuilder->addDefinitions($this->getResolvableDependencyInjectionConfig());
        $containerBuilder->addDefinitions($this->getLocatableDependencyInjectionConfig());
        $containerBuilder->addDefinitions($moduleDependencyInjectionConfig);

        return $containerBuilder->build()->get($className);
    }

    protected function getSharedConfig(): KernelConfig
    {
        if (static::$sharedConfig === null) {
            static::$sharedConfig = new KernelConfig();
        }

        return static::$sharedConfig;
    }

    protected function getResolvableDependencyInjectionConfig(): array
    {
        $definitions = [];
        $locator = $this->getLocator();

        foreach ($this->getSharedConfig()->getResolvableClassesWildCards() as $wildCard => $resolverClass) {
            $definitions[$wildCard] = function (RequestedEntry $entry) use ($locator, $resolverClass) {
                $resolver = new $resolverClass;
                return $resolver->resolve($entry->getName());
            };
        }

        return $definitions;
    }

    protected function getLocatableDependencyInjectionConfig(): array
    {
        $definitions = [];
        $locator = $this->getLocator();

        foreach ($this->getSharedConfig()->getLocatableClassesWildCards() as $wildCard => $locatorMethod) {
            $definitions[$wildCard] = function (RequestedEntry $entry) use ($locator, $locatorMethod) {
                $classInfo = new ClassInfo();
                $classInfo->setClass($entry->getName());

                $module = mb_strtolower($classInfo->getModule());

                return $locator->$module()->$locatorMethod();
            };
        }

        return $definitions;
    }

    protected function getSprykerCoreDependencyInjectionConfig(): array
    {
        $factoryResolver = $this->getFactoryResolver();

        return [
            'Spryker\*' => function (RequestedEntry $entry) use ($factoryResolver) {
                $classInfo = new ClassInfo();
                $classInfo->setClass($entry->getName());

                $factory = $factoryResolver->resolve($entry->getName());

                $classParts = explode("\\", $entry->getName());
                $className = end($classParts);
                $className = str_replace('Interface', '', $className);
                $methodName = 'create' . $className;

                return $factory->$methodName();
            }
        ];
    }

    /**
     * @return \Spryker\Shared\Kernel\ClassResolver\AbstractClassResolver
     */
    abstract protected function getFactoryResolver(): AbstractClassResolver;

    /**
     * @return \Spryker\Shared\Kernel\ClassResolver\AbstractClassResolver
     */
    abstract protected function getDependencyProviderResolver(): AbstractClassResolver;

    /**
     * @return \Spryker\Shared\Kernel\LocatorLocatorInterface
     */
    abstract protected function getLocator(): LocatorLocatorInterface;
}