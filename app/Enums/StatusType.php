<?php

namespace App\Enums;

enum StatusType: int
{
    case TO_DO = 0;
    case IN_PROGRESS = 1;
    case DONE = 2;
}
