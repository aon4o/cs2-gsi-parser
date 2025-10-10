<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Traits;

use ReflectionClass;

trait ParserConstructor
{
    public function __construct(object $data)
    {
        $reflection = new ReflectionClass(self::class);

        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $type = $property->getType()?->getName();
            $value = $data->{$name};
            echo "$name: $type\n";

            if (enum_exists($type)) {
                if ($value !== null) {
                    $this->{$name} = $type::from($value);
                }

                continue;
            }

            if (class_exists($type)) {
                $this->{$name} = new $type($value);
            }
        }

        return $this;
    }
}
