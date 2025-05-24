<?php

namespace App\Enums;

/**
 * @OA\Schema(
 *   schema="ContactStatusEnum",
 *   type="string",
 *   description="Status do contato",
 *   enum={"PENDING", "WAITING_RESPONSE", "ANSWERED", "ARCHIVED"}
 * )
 */
enum ContactStatus: string
{
    case Pending = 'PENDING';
    case WaitingResponse = 'WAITING_RESPONSE';
    case Answered = 'ANSWERED';
    case Archived = 'ARCHIVED';
}
