<?php

namespace App\Models\Enums;

enum UserRequestStatusEnum {
    case PENDING;
    case APPROVED;
    case REJECTED;
    case OTHER;
}
