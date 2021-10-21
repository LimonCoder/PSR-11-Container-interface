<?php



namespace App\Core;


use Psr\Container\ContainerInterface;
use App\Exception\ContainerException;

class Container implements ContainerInterface
{
    private  $entries = [];

    public function get($id)
    {

        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)){
                return $entry();
            }
            $id = $entry;

        }


        return $this->resolve($id);
    }



    public function set(string $id,  $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        // 1. Inspect the class that we are trying to get from the container
        $reflectionClass = new \ReflectionClass($id);



        if (! $reflectionClass->isInstantiable()) {
            throw new ContainerException('Class "' . $id . '" is not instantiable');
        }



        // 2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();

        if (! $constructor) {
            return new $id;
        }



        // 3. Inspect the constructor parameters (dependencies)
        $parameters = $constructor->getParameters();

        if (! $parameters) {
            return new $id;
        }



        // 4. If the constructor parameter is a class then try to resolve that class using the container
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($id) {
                $name = $param->getName();
                $type = $param->getType();

                if (! $type) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint'
                    );
                }

                if ($type instanceof \ReflectionUnionType) {
                    throw new ContainerException(
                        'Failed to resolve class "' . $id . '" because of union type for param "' . $name . '"'
                    );
                }


                if ($type instanceof \ReflectionNamedType && ! $type->isBuiltin()) {

                    return $this->get($type->getName());
                }

                throw new ContainerException(
                    'Failed to resolve class "' . $id . '" because invalid param "' . $name . '"'
                );
            },
            $parameters
        );


        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }
}
