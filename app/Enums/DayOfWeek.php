<?php

namespace App\Enums;

enum DayOfWeek
{
    case MONDAY;
    case TUESDAY;
    case WEDNESDAY;
    case THURSDAY;
    case FRIDAY;
    case SATURDAY;
    case SUNDAY;

    public static function values(): array {
        return [
            self::MONDAY->name,
            self::TUESDAY->name,
            self::WEDNESDAY->name,
            self::THURSDAY->name,
            self::FRIDAY->name,
            self::SATURDAY->name,
            self::SUNDAY->name,
        ];
    }
}
