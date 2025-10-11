<?php

declare(strict_types=1);

if (! function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed  $target
     * @param  int|array|string|null  $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    function data_get(mixed $target, int|array|string|null $key, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        foreach ($key as $i => $segment) {
            unset($key[$i]);

            if (is_null($segment)) {
                return $target;
            }

            if ($segment === '*') {
                if (! is_iterable($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return $result;
            }

            $segment = match ($segment) {
                '\*' => '*',
                '\{first}' => '{first}',
                '{first}' => array_key_first((array) $target),
                '\{last}' => '{last}',
                '{last}' => array_key_last((array) $target),
                default => $segment,
            };

            if (is_array($target) && array_key_exists($segment, $target)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @template TValue
     * @template TArgs
     *
     * @param  TValue|Closure(TArgs): TValue  $value
     * @param  TArgs  ...$args
     *
     * @return TValue
     */
    function value(mixed $value, ...$args)
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}
