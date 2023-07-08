<?php

namespace AW\Shared\Kernel;

use Spryker\Shared\Kernel\KernelConfig as SprykerKernelConfig;
use Spryker\Zed\Kernel\ClassResolver\EntityManager\EntityManagerResolver;
use Spryker\Zed\Kernel\ClassResolver\Repository\RepositoryResolver;

class KernelConfig extends SprykerKernelConfig
{
    /**
     * @return array<string>
     */
    public function getResolvableClassesWildCards(): array
    {
        return [
            '*EntityManagerInterface' => EntityManagerResolver::class,
            '*EntityManager' => EntityManagerResolver::class,
            '*RepositoryInterface' => RepositoryResolver::class,
            '*Repository' => RepositoryResolver::class,
        ];
    }

    /**
     * @return array<string>
     */
    public function getLocatableClassesWildCards(): array
    {
        return [
            '*Service' => 'service',
            '*ServiceInterface' => 'service',
            '*Client' => 'client',
            '*ClientInterface' => 'client',
            '*Facade' => 'facade',
            '*FacadeInterface' => 'facade',
            '*QueryContainer' => 'queryContainer',
            '*QueryContainerInterface' => 'queryContainer',
        ];
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDependencyInjectionCacheFilePathPattern(): string
    {
        $projectNamespaces = implode('/', $this->getProjectOrganizations());

        return APPLICATION_ROOT_DIR . '/src/Generated/Shared/Kernel/' . $projectNamespaces . '/';
    }
}
