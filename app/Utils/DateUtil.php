<?php

namespace App\Utils;

use App\Enums\DayOfWeek;
use Carbon\Carbon;

class DateUtil
{
    /**
     *
     * @param DayOfWeek $week
     * @return Carbon
     */
    public static function dayOfWeekDate(DayOfWeek $week): Carbon
    {
        $daysOfWeekDates = self::dayOfWeekDates();
        $date = $daysOfWeekDates[$week->name];

        return with(clone $date);
    }


    /**
     * @param string $weekday
     * @return Carbon
     */

    public static function dateOfday(string $weekday): Carbon
    {
        $daysOfWeekDates = self::dayOfWeekDates();
        $date = $daysOfWeekDates[strtoupper($weekday)];

        return with(clone $date);
    }

    /**
     * @param string|null $locale
     * @return array
     */
    public static function daysOfWeek(string|null $locale): array {
        return array_map(
            function (string $dayOfWeek, Carbon $value) use ($locale) {
                return ucfirst($value->locale($locale)->dayName);
            },
            self::dayOfWeekDates()
        );
    }

    /**
     * @return array
     */
    public static function dayOfWeekDates(): array {
        return [
            DayOfWeek::SUNDAY->name => Carbon::create(2017),
            DayOfWeek::MONDAY->name => Carbon::create(2017, 1, 2),
            DayOfWeek::TUESDAY->name => Carbon::create(2017, 1, 3),
            DayOfWeek::WEDNESDAY->name => Carbon::create(2017, 1, 4),
            DayOfWeek::THURSDAY->name => Carbon::create(2017, 1, 5),
            DayOfWeek::FRIDAY->name => Carbon::create(2017, 1, 6),
            DayOfWeek::SATURDAY->name => Carbon::create(2017, 1, 7),
        ];
    }

    /**
     * Function to translate the day of the week from Spanish to English
     * @param string $dayOfWeek
     * @return mixed
     */
    public static function translateDayOfWeek(string $dayOfWeek) {
        $days = [
            'Lunes' => DayOfWeek::MONDAY,
            'Martes' => DayOfWeek::TUESDAY,
            'Miércoles' => DayOfWeek::WEDNESDAY,
            'Jueves' => DayOfWeek::THURSDAY,
            'Viernes' => DayOfWeek::FRIDAY,
            'Sábado' => DayOfWeek::SATURDAY,
            'Domingo' => DayOfWeek::SUNDAY
        ];

        return $days[$dayOfWeek];
    }

    /**
     * Function to convert 2017-01-01 to Sunday and so on with all days
     * @param Carbon $date
     * @return string
     */
    public static function translateDateToDayOfWeek(Carbon $date): string
    {
        $date=ucfirst($date->dayName);
        $date = self::translateDayOfWeek($date);
        return Carbon::parse(self::dayOfWeekDates()[$date->name])->locale('es_ES')->translatedFormat('l');
    }

    public static function values(): array
    {
        return [
            Carbon::createFromFormat('Y-m-d', '2017-01-01')->format('Y-m-d'),
            Carbon::createFromFormat('Y-m-d', '2017-01-02')->format('Y-m-d'),
            Carbon::createFromFormat('Y-m-d', '2017-01-03')->format('Y-m-d'),
            Carbon::createFromFormat('Y-m-d', '2017-01-04')->format('Y-m-d'),
            Carbon::createFromFormat('Y-m-d', '2017-01-05')->format('Y-m-d'),
            Carbon::createFromFormat('Y-m-d', '2017-01-06')->format('Y-m-d'),
            Carbon::createFromFormat('Y-m-d', '2017-01-07')->format('Y-m-d'),
        ];
    }
}
