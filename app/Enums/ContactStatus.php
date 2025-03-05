<?php

namespace App\Enums;

enum ContactStatus: string
{
    case Pending = 'PENDING';
    case WaitingResponse = 'WAITING_RESPONSE';
    case Answered = 'ANSWERED';
    case Archived = 'ARCHIVED';
}
