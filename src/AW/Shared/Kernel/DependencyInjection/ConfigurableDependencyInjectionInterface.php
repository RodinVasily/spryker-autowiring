<?php

namespace AW\Shared\Kernel\DependencyInjection;
interface ConfigurableDependencyInjectionInterface
{
    public function getDependencyInjectionConfig(): array;
}