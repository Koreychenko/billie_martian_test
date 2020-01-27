<?php


namespace App\Services;


use Exception;

class TimeServiceFactory
{
    protected $timeServices;

    public function __construct(iterable $timeServices)
    {
        $this->timeServices = $timeServices;
    }

    public function getTimeService(string $planetName)
    {
        foreach ($this->timeServices as $timeService) {
            if ($timeService->getPlanet() == ucfirst($planetName)) {
                return $timeService;
            }
        }

        throw new Exception('Invalid planet name');
    }
}