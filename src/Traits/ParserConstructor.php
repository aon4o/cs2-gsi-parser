<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Traits;

use ReflectionClass;
use ReflectionEnum;
use ReflectionException;
use ReflectionNamedType;

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
                try {
                    $re = new ReflectionEnum($type_name);
                    $backing = $re->getBackingType()->getName();

                    if ($backing === 'int') {
                        if (is_int($value)) {
                            $cast = $value;
                        } elseif (is_string($value) && ctype_digit($value)) {
                            $cast = (int) $value;
                        } else {
                            $cast = null;
                        }
                    } else {
                        if (is_string($value)) {
                            $cast = $value;
                        } else {
                            $cast = null;
                        }
                    }

                    if ($cast !== null) {
                        $property->setValue($this, $type_name::from($cast));

                    } else {
                        if ($type->allowsNull()) {
                            $property->setValue($this, null);
                        }
                    }
                } catch (ReflectionException $e) {
                    // fallback: skip conversion
                    if ($type->allowsNull()) {
                        $property->setValue($this, null);
                    }
                }

                continue;
            }

            // classes: only instantiate when we have array/object data
            if (class_exists($type_name)) {
                if (is_object($value)) {
                    $property->setValue($this, new $type_name($value));
                } elseif (is_array($value)) {
                    // convert associative arrays into stdClass so constructors expecting object work
                    $obj = json_decode(json_encode($value));
                    $property->setValue($this, new $type_name($obj));
                } else {
                    // value is scalar (true/false) - map to null when possible
                    if ($type->allowsNull()) {
                        $property->setValue($this, null);
                    }
                }

                continue;
            }

            if ($type->isBuiltin()) {
                if ($type_name === 'int') {
                    $property->setValue($this, (int) $value);
                } elseif ($type_name === 'float') {
                    $property->setValue($this, (float) $value);
                } elseif ($type_name === 'bool') {
                    $property->setValue($this, (bool) $value);
                } elseif ($type_name === 'string') {
                    $property->setValue($this, (string) $value);
                } elseif ($type_name === 'array') {
                    // Attempt to detect an element class via the @var docblock for arrays
                    $doc = $property->getDocComment();
                    $elemClass = null;

                    if ($doc !== false) {
                        if (preg_match('/@var\\s+array<[^,>]+,\\s*([\\\\A-Za-z0-9_]+)>/', $doc, $m)) {
                            $short = $m[1];

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
                                        if (! class_exists($instClass) || (new ReflectionClass($instClass))->isAbstract()) {
                                            $out[$k] = $vobj;

                                            continue;
                                        }
                                    }
                                } catch (ReflectionException $e) {
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
                } else {
                    $property->setValue($this, $value);
                }

                continue;
            }

            $property->setValue($this, $value);
        }
    }
}
