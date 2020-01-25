<?php


namespace App\Models;


class PlanetTime
{
    protected float $days;

    protected int $hours;

    protected int $minutes;

    protected int $seconds;

    public function __construct(float $days, int $hours = 0, int $minutes = 0, int $seconds = 0)
    {
        $this->days    = $days;
        $this->hours   = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    /**
     * @return float
     */
    public function getDays(): float
    {
        return $this->days;
    }

    /**
     * @return string
     */
    public function getFormattedTime(): string
    {
        return sprintf(
            '%02d:%02d:%02d',
            $this->getHours(),
            $this->getMinutes(),
            $this->getSeconds()
        );
    }

    /**
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @return int
     */
    public function getSeconds(): int
    {
        return $this->seconds;
    }
}