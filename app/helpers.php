<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

if (! function_exists('test')) {
    function test()
    {
        return app('test');
    }
}

if (! function_exists('active_link')) {
    function active_link(string $name, string $active = 'active'): string
    {
        return Route::is($name) ? $active : '';
    }
}

if (! function_exists('route_is')) {
    function route_is(string $name, ): bool
    {
        return Route::is($name) ? true : false;
    }
}

if (! function_exists('alert')) {
    function alert(string $value)
    {
        session(['alert' => $value]);
    }
}

if (! function_exists('validate')) {
    function validate(array $attributes, array $rules): array
    {
        return validator($attributes, $rules)->validate();
    }
}

if (! function_exists('getBaseDate')) {
    function getBaseDate()
    {
        return DB::table('base_date')->first()->time;
    }
}

