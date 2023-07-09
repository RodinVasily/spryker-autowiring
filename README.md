# Autowiring for Spryker

#Hackweekender2023

## Installation

Install it with composer

```
composer require hackweekender-aw/spryker-autowiring
```

Add a namespace to your config

```
$config[KernelConstants::CORE_NAMESPACES] = [
    [...]
    'AW'
];
```

## Usage

### Yves

* Include `\AW\Yves\Kernel\ClassResolverAwareTrait` in the controller
* Call `$this->resolveClass(AmazingYvesClass::class)->yourAmazingMethod()`

### Client

* Include `\AW\Client\Kernel\ClassResolverAwareTrait` in the client
* Call `$this->resolveClass(AmazingClientClass::class)->yourAmazingMethod()`

### Zed

* Include `\AW\Zed\Kernel\ClassResolverAwareTrait` in the facade
* Call `$this->resolveClass(AmazingZedClass::class)->yourAmazingMethod()`

### Manually configure DI

* Make the dependency provider of your module to implement the interface `\AW\Shared\Kernel\DependencyInjection\ConfigurableDependencyInjectionInterface`
* Define the custom definitions using https://php-di.org/doc/php-definitions.html#definition-types

```
public function getDependencyInjectionConfig(): array
{
    return [
        AmazingCartOperationInterface::class => DI\autowire(AmazingCartOperation::class)
            ->constructorParameter('postOperationPlugins', $this->getPostOperationPlugins())
    ];
}
```