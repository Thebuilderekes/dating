<?php
declare(strict_types=1);

namespace App\Helpers;

class DateTimeHelper
{
    public static function timeAgo(string $datetime, bool $full = false, string $timezone = 'Africa/Lagos'): string
    {
        $now = new \DateTime('now', new \DateTimeZone($timezone));
        $ago = new \DateTime($datetime, new \DateTimeZone($timezone));
        $diff = $now->diff($ago);

        // Calculate weeks manually
        $diffWeeks = (int) floor($diff->d / 7);
        $diffDays = $diff->d - ($diffWeeks * 7);

        $components = [
            'y' => $diff->y,
            'm' => $diff->m,
            'w' => $diffWeeks,
            'd' => $diffDays,
            'h' => $diff->h,
            'i' => $diff->i,
            's' => $diff->s,
        ];

        $strings = [];

        foreach ($components as $key => $value) {
            if ($value > 0) {
                $unit = match ($key) {
                    'y' => 'year',
                    'm' => 'month',
                    'w' => 'week',
                    'd' => 'day',
                    'h' => 'hour',
                    'i' => 'minute',
                    's' => 'second',
                };
                $strings[] = "$value $unit" . ($value > 1 ? 's' : '');
            }
        }

        if (!$full) {
            $strings = array_slice($strings, 0, 1);
        }

        return $strings ? implode(', ', $strings) . ' ago' : 'just now';
    }
}

