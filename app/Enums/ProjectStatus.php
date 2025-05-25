<?php

namespace App\Enums;

/**
 * @OA\Schema(
 *   schema="ProjectStatusEnum",
 *   type="string",
 *   description="Project status",
 *   enum={"PENDING", "IN_PROGRESS", "COMPLETED", "ABANDONED"}
 * )
 */
enum ProjectStatus: string 
{
    case Pending = 'PENDING';
    case InProgress = 'IN_PROGRESS';
    case Completed = 'COMPLETED';
    case Abandoned = 'ABANDONED';
}