<?php


namespace App\Services;


use Exception;

class TimeServiceFactory
{
    public function getTimeService(string $planetName)
    {
        $planetTimeServiceName = 'App\\Services\\' . ucfirst($planetName) . '\\TimeService';

        if (class_exists($planetTimeServiceName)) {
            return new $planetTimeServiceName();
        }

        throw new Exception('Invalid planet name');
    }
}