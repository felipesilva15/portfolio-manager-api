<?php

namespace App\Enums;

enum ProjectStatus: string 
{
    case Pending = 'PENDING';
    case InProgress = 'IN_PROGRESS';
    case Completed = 'COMPLETED';
    case Abandoned = 'ABANDONED';
}