<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

use InvalidArgumentException;
use ReflectionException;

class GSIParser
{
    /**
     * @param  mixed  $data
     *
     * @return GameState
     *
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    public static function parse(mixed $data = null): GameState
    {
        $data_type = gettype($data);

        return match ($data_type) {
            'string' => self::fromJSON($data),
            'array' => self::fromArray($data),
            'object' => self::fromObject($data),
            default => throw new InvalidArgumentException('Invalid data type: ' . $data_type),
        };
    }

    /**
     * @throws ReflectionException
     */
    public static function fromJSON(string $data): GameState
    {
        return self::fromArray(json_decode($data, true));
    }

    /**
     * @throws ReflectionException
     */
    public static function fromArray(array $data): GameState
    {
        return self::fromObject(json_decode(json_encode($data)));
    }

    /**
     * @throws ReflectionException
     */
    public static function fromObject(object $data): GameState
    {
        return new GameState($data);
    }
}
