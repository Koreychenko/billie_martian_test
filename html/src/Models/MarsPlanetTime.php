<?php


namespace App\Models;


class MarsPlanetTime extends PlanetTime
{
    /**
     * @return string
     */
    public function getFormattedTime(): string
    {
        return parent::getFormattedTime() . ' MTC';
    }

    /**
     * @return string
     */
    public function getFormattedDays(): string
    {
        return parent::getFormattedDays() . ' MSD';
    }
}