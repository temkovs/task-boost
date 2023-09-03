<?php

namespace App\Enums;

use Illuminate\Http\JsonResponse;

enum Color: int
{
    case YELLOW = 0;
    case BLUE = 1;
    case GREEN = 2;
    case RED = 3;
    case PINK = 4;
    case PURPLE = 5;
    case TURQUOISE = 6;
    case BROWN = 7;

    public static function setColor($color): string
    {
        return match ((int) $color) {
            Color::YELLOW->value => 'yellow',
            Color::BLUE->value => 'blue',
            Color::RED->value => 'red',
            Color::PINK->value => 'pink',
            Color::PURPLE->value => 'purple',
            Color::TURQUOISE->value => 'turquoise',
            Color::BROWN->value => 'brown',
            default => 'green',
        };
    }
}
