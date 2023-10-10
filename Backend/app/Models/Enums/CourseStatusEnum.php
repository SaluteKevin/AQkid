<?php

namespace App\Models\Enums;

enum CourseStatusEnum {
    case PENDING;
    case OPEN;
    case FULL;
    case ACTIVE;
    case ENDED;
    case CANCELLED;
}
