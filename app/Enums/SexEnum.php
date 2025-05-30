<?php

namespace App\Enums;

/**
 * @OA\Schema(
 *   schema="SexEnum",
 *   type="string",
 *   description="Sexual orientation",
 *   enum={"F", "M", "O"}
 * )
 */
enum SexEnum: string
{
    case Female = 'F';
    case Male = 'M';
    case Other = 'O';
}
