<?php

namespace App\Helpers;

class ArrayUtils
{
    public static function getArrayOfAnArrayProperty(array $array, string $propertyName): array {
        $properties = collect($array)
                            ->pluck($propertyName)
                            ->all();

        return $properties;
    }
}