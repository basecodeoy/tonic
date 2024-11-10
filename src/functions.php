<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Tonic;

if (!\function_exists('post_json_rpc') && \function_exists('Pest\Laravel\postJson')) {
    function post_json_rpc(string $method, ?array $params = null, ?string $id = null): \Illuminate\Testing\TestResponse
    {
        return \Pest\Laravel\postJson(
            route('rpc'),
            \array_filter([
                'jsonrpc' => '2.0',
                'id' => $id ?? '01J34641TE5SF58ZX3N9HPT1BA',
                'method' => $method,
                'params' => $params,
            ]),
        );
    }
}

if (!\function_exists('arr_filter_recursive')) {
    /**
     * @param  array<mixed, mixed> $array
     * @return array<mixed, mixed>
     */
    function arr_filter_recursive(array $array, ?\Closure $callback = null, bool $remove_empty_arrays = false): array
    {
        foreach ($array as $key => &$value) { // create reference
            if (\is_array($value)) {
                $value = \call_user_func_array(__FUNCTION__, [$value, $callback, $remove_empty_arrays]);

                if ($remove_empty_arrays && !(bool) $value) {
                    unset($array[$key]);
                }
            } elseif ($callback instanceof \Closure && !$callback($value)) {
                unset($array[$key]);
            } elseif (!(bool) $value) {
                // We don't want to remove `false` values...
                if (\is_bool($value)) {
                    continue;
                }

                // We don't want to remove 0 values...
                if (\is_numeric($value) && $value === 0) {
                    continue;
                }

                unset($array[$key]);
            }
        }

        unset($value); // destroy reference

        return $array;
    }
}
