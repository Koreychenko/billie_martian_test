<?php


namespace App\Services;


use App\Models\PlanetTime;
use DateTime;

interface ITimeService
{
    public function getTime(DateTime $earthTime): PlanetTime;
}