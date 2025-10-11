<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Traits;

use BackedEnum;
use ReflectionClass;
use ReflectionEnum;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;

trait ParserConstructor
{
    /**
     * @throws ReflectionException
     */
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

            if ($value === null) {
                $property->setValue($this, $value);

                continue;
            }

            if (! $type instanceof ReflectionNamedType) {
                throw new ReflectionException('Unsupported property type for ' . $name);
            }

            $type_name = $type->getName();

            if (enum_exists($type_name)) {
                $this->handleEnum($property, $value);

                continue;
            }

            if (class_exists($type_name)) {
                $this->handleClass($property, $value);

                continue;
            }

            if ($type->isBuiltin()) {
                $this->handleBuiltIn($type_name, $property, $value, $reflection);

                continue;
            }

            $property->setValue($this, $value);
        }
    }

    /**
     * @param  ReflectionProperty  $property
     * @param  mixed  $value
     *
     * @return void
     *
     * @throws ReflectionException
     */
    protected function handleEnum(ReflectionProperty $property, mixed $value): void
    {
        $type = $property->getType();

        /** @var BackedEnum $type_name */
        $type_name = $type->getName();

        $reflection = new ReflectionEnum($type_name);
        $backing = $reflection->getBackingType()->getName();

        if ($backing === 'int') {
            if (is_int($value)) {
                $cast_value = $value;
            } elseif (is_string($value) && ctype_digit($value)) {
                $cast_value = (int) $value;
            } else {
                $cast_value = null;
            }
        } elseif (is_string($value)) {
            $cast_value = $value;
        } else {
            $cast_value = null;
        }

        if ($cast_value !== null) {
            $property->setValue($this, $type_name::from($cast_value));

        } elseif ($type->allowsNull()) {
            $property->setValue($this, null);
        }
    }

    /**
     * @param  ReflectionProperty  $property
     * @param  mixed  $value
     *
     * @return void
     */
    protected function handleClass(ReflectionProperty $property, mixed $value): void
    {
        $type = $property->getType();
        $type_name = $type->getName();

        if (is_object($value)) {
            $property->setValue($this, new $type_name($value));
        } elseif (is_array($value)) {
            $property->setValue($this, new $type_name($value));
        } elseif ($type->allowsNull()) {
            $property->setValue($this, null);
        }
    }

    /**
     * @param  string  $type_name
     * @param  ReflectionProperty  $property
     * @param  $value
     * @param  ReflectionClass  $reflection
     *
     * @return void
     */
    protected function handleBuiltIn(
        string $type_name,
        ReflectionProperty $property,
        $value,
        ReflectionClass $reflection,
    ): void {
        match ($type_name) {
            'int' => $property->setValue($this, (int) $value),
            'float' => $property->setValue($this, (float) $value),
            'bool' => $property->setValue($this, (bool) $value),
            'string' => $property->setValue($this, (string) $value),
            'array' => $this->handleBuiltInArray($property, $reflection, $value),
            'default' => $property->setValue($this, $value),
        };
    }

    /**
     * @param  ReflectionProperty  $property
     * @param  ReflectionClass  $reflection
     * @param  $value
     *
     * @return void
     */
    protected function handleBuiltInArray(ReflectionProperty $property, ReflectionClass $reflection, $value): void
    {
        $doc = $property->getDocComment();
        $elemClass = null;

        if ($doc !== false) {
            $matches = [];
            if (preg_match('/@var\\s+array<[^,>]+,\\s*([\\\\A-Za-z0-9_]+)>/', $doc, $matches)) {
                $short = $matches[1];

                // try several candidate namespaces to resolve the short class name
                $candidates = [
                    $short,
                    '\\' . $short,
                    $reflection->getNamespaceName() . '\\' . $short,
                    'Aon4o\\Cs2GsiParser\\Types\\' . $short,
                    'Aon4o\\Cs2GsiParser\\Types\\Weapon\\' . $short,
                ];

                foreach ($candidates as $cand) {
                    if (class_exists($cand)) {
                        $elemClass = $cand;
                        break;
                    }
                }
            }
        }

        if ($elemClass !== null && (is_array($value) || is_object($value))) {
            $out = [];
            foreach ((array) $value as $k => $v) {
                if (is_object($v) || is_array($v)) {
                    $vobj = is_array($v) ? json_decode(json_encode($v)) : $v;

                    $instClass = $elemClass;

                    // if the element class is abstract (e.g. Weapon), try to resolve a concrete subclass
                    try {
                        $rc = new ReflectionClass($elemClass);
                        if ($rc->isAbstract()) {
                            // try to resolve from a 'type' property (common in weapon objects)
                            if (isset($vobj->type) && is_string($vobj->type)) {
                                $candidate = 'Aon4o\\Cs2GsiParser\\Types\\Weapon\\' . ucfirst($vobj->type);

                                if (class_exists($candidate)) {
                                    $instClass = $candidate;
                                }
                            }

                            // as a fallback, try short class name mapping
                            if ($instClass === $elemClass) {
                                $short = (is_string($vobj->type) ? $vobj->type : null);
                                if ($short) {
                                    $candidate = 'Aon4o\\Cs2GsiParser\\Types\\Weapon\\' . ucfirst($short);
                                    if (class_exists($candidate)) {
                                        $instClass = $candidate;
                                    }
                                }
                            }

                            // If still abstract or not instantiable, fallback to leaving the element as raw object/array
                            if (! class_exists($instClass) || new ReflectionClass($instClass)->isAbstract()) {
                                $out[$k] = $vobj;

                                continue;
                            }
                        }
                    } catch (ReflectionException) {
                        // ignore and use elemClass
                    }

                    $out[$k] = new $instClass($vobj);
                } else {
                    $out[$k] = $v;
                }
            }

            $property->setValue($this, $out);
        } else {
            $property->setValue($this, (array) $value);
        }
    }
}
