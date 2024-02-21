<?php

namespace Domain\DateTimeZone;

use DateTime;
use DateTimeZone;

class DateTimeZoneCalculator
{
    private ?DateTime $date = null;

    public function calculate(array $data): array
    {
        $this->date = new DateTime($data['date'], new DateTimeZone($data['timezone']));

        return [
            'timezone' => $data['timezone'],
            'offset_in_minutes' => $this->getOffsetInMinutes(),
            'days_in_february' => $this->getDaysInFebruary(),
            'current_month' => $this->getCurrentMonth(),
            'days_in_current_month' => $this->getDaysInCurrentMonth(),
        ];
    }

    private function getOffsetInMinutes(): int
    {
        $offsetInSeconds = $this->date->getOffset();
        return $offsetInSeconds / 60;
    }

    private function getDaysInFebruary(): int
    {
        return cal_days_in_month(CAL_GREGORIAN, 2, $this->date->format('Y'));
    }

    private function getCurrentMonth(): string
    {
        return $this->date->format('F');
    }

    private function getDaysInCurrentMonth(): int
    {
        return cal_days_in_month(CAL_GREGORIAN, $this->date->format('m'), $this->date->format('Y'));
    }
}
