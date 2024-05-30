<?php

namespace App\Service;

use App\Dto\DateInputDto;
use App\Dto\DateOutputDto;
use DateTime;
use DateTimeZone;

class DateService
{
    private ?DateTime $date;

    public function getOutput(DateInputDto $input): DateOutputDto
    {
        $this->date = new DateTime($input->date, new DateTimeZone($input->timezone));

        $output = new DateOutputDto();
        $output->offset_in_minutes = $this->getOffsetInMinutes();
        $output->days_in_february = $this->getDaysInFebruary();
        $output->current_month = $this->getCurrentMonth();
        $output->days_in_current_month = $this->getDaysInCurrentMonth();

        return $output;
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
