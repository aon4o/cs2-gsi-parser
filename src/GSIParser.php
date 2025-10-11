<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

use Aon4o\Cs2GsiParser\GameStates\Menu;
use Aon4o\Cs2GsiParser\GameStates\Playing;
use Aon4o\Cs2GsiParser\GameStates\Spectating;
use InvalidArgumentException;

class GSIParser
{
    /**
     * @param  mixed  $data
     *
     * @return Menu|Playing|Spectating
     *
     * @throws InvalidArgumentException
     */
    public static function parse(mixed $data = null): Menu|Playing|Spectating
    {
        $data_type = gettype($data);

        return match ($data_type) {
            'string' => self::fromJSON($data),
            'array' => self::fromArray($data),
            'object' => self::fromObject($data),
            default => throw new InvalidArgumentException('Invalid data type: ' . $data_type),
        };
    }

    public static function fromJSON(string $data): Menu|Playing|Spectating
    {
        return self::fromArray(json_decode($data, true));
    }

    public static function fromArray(array $data): Menu|Playing|Spectating
    {
        return self::fromObject(json_decode(json_encode($data)));
    }

    public static function fromObject(object $data): Menu|Playing|Spectating
    {
        if (isset($data->allplayers) && $data->allplayers) {
            return new Spectating($data);
        }

        if (isset($data->map) && $data->map) {
            return new Playing($data);
        }

        return new Menu($data);
    }
}
