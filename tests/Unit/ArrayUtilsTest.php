<?php

namespace Tests\Unit;

use App\Helpers\ArrayUtils;
use PHPUnit\Framework\TestCase;

class ArrayUtilsTest extends TestCase
{
    public function test_can_get_array_of_an_array_property(): void
    {
        $array = [
            [
                'id' => 1,
                'name' => 'tag one'
            ],
            [
                'id' => 2,
                'name' => 'tag two'
            ]
        ];

        $propertyArray = ArrayUtils::getArrayOfAnArrayProperty($array, 'id');

        $this->assertTrue($propertyArray == [1, 2]);
    }

    public function test_can_get_array_of_an_nested_array_property(): void
    {
        $array = [
            [
                'title' => 'test',
                'tag' => [
                    'id' => 1,
                    'name' => 'tag one'
                ],
            ],
            [
                'title' => 'test',
                'tag' => [
                    'id' => 2,
                    'name' => 'tag two'
                ],
            ],
        ];

        $propertyArray = ArrayUtils::getArrayOfAnArrayProperty($array, 'tag.id');

        $this->assertTrue($propertyArray == [1, 2]);
    }
}
