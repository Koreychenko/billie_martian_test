<?php


namespace App\Services\Mars;

use DateTime;
use App\Models\PlanetTime;
use App\Services\ITimeService;


class TimeService implements ITimeService
{
    public function getTime(DateTime $earthTime): PlanetTime
    {
        return new PlanetTime(1, 2, 3, 4);
    }
}