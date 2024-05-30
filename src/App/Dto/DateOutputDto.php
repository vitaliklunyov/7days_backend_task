<?php

namespace App\Dto;

class DateOutputDto
{
    public int $offset_in_minutes;

    public int $days_in_february;

    public string $current_month;

    public int $days_in_current_month;
}
