<?php

declare(strict_types=1);

namespace WebDevelovers\ResourceModels;

use DateTimeInterface;
use DateTimeZone;
use InvalidArgumentException;
use Throwable;

use function is_string;
use function method_exists;

class DateTimeUtils
{
    public const string DEFAULT_TIMEZONE = 'Europe/Rome';

    /** @throws InvalidArgumentException */
    public static function localizeDateTime(
        DateTimeInterface $dateTime,
        string|DateTimeZone $timezone = self::DEFAULT_TIMEZONE,
    ): DateTimeInterface {
        if (is_string($timezone)) {
            try {
                $timezone = new DateTimeZone($timezone);
            } catch (Throwable) {
                throw new InvalidArgumentException('Invalid timezone: ' . $timezone);
            }
        }

        $localizedDateTime = clone $dateTime;
        if (! method_exists($localizedDateTime, 'setTimezone')) {
            throw new InvalidArgumentException('Unsupported type: ' . $dateTime::class);
        }

        return $localizedDateTime->setTimezone($timezone);
    }
}
