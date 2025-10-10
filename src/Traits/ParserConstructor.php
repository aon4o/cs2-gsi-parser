<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Traits;

use ReflectionClass;
use ReflectionNamedType;

trait ParserConstructor
{
    public function __construct(object $data)
    {
        $reflection = new ReflectionClass($this);

        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $type = $property->getType();

            if (! (property_exists($data, $name) || isset($data->{$name}))) {
                continue;
            }

            $value = $data->{$name} ?? null;

            if ($type === null) {
                $property->setValue($this, $value);

                continue;
            }

            if ($type instanceof ReflectionNamedType) {
                $type_name = $type->getName();

                if ($value === null) {
                    $property->setValue($this, null);

                    continue;
                }

                if (enum_exists($type_name)) {
                    $property->setValue($this, $type_name::from($value));

                    continue;
                }

                if (class_exists($type_name)) {
                    $property->setValue($this, new $type_name($value));

                    continue;
                }

                if ($type->isBuiltin()) {
                    match ($type_name) {
                        'int' => $property->setValue($this, (int) $value),
                        'float' => $property->setValue($this, (float) $value),
                        'bool' => $property->setValue($this, (bool) $value),
                        'string' => $property->setValue($this, (string) $value),
                        'array' => $property->setValue($this, (array) $value),
                        default => $property->setValue($this, $value),
                    };

                    continue;
                }
            }

            $property->setValue($this, $value);
        }
    }
}
