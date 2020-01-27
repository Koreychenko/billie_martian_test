<?php


namespace App\Services\Mars;

use App\Models\MarsPlanetTime;
use App\Models\PlanetTime;
use App\Services\ITimeService;
use DateTime;
use DateTimeZone;
use Exception;


class TimeService implements ITimeService
{
    protected string $planetName = 'Mars';

    protected const EPOCH_1970 = '1970-01-01';

    public function getPlanet(): string
    {
        return $this->planetName;
    }

    /**
     * @param DateTime $earthTime
     *
     * @return PlanetTime
     * @throws Exception
     */
    public function getTime(DateTime $earthTime): PlanetTime
    {
        $epoch1970 = new DateTime($this::EPOCH_1970, new DateTimeZone('UTC'));

        $utcDiff = $this->getDiffInSeconds($epoch1970, $earthTime);

        /**
         * Formula is given from here https://www.giss.nasa.gov/tools/mars24/help/algorithm.html
         */
        $days = ((($utcDiff / 86400 + 2440587.5 + (64.184 / 86400) - 2451545 - 4.5) / 1.027491252) + 44796 - 0.00096);

        /* hours */
        $mtch = ($days * 24) % 24;
        /* minutes */
        $mtcm = ($days * 1440) % 60;
        /* seconds */
        $mtcs = ($days * 86400) % 60;

        $msd = round($days, 2);

        return new MarsPlanetTime($msd, $mtch, $mtcm, $mtcs);
    }

    /**
     * Returns precise difference between two dates in seconds
     *
     * @param DateTime $date1
     * @param DateTime $date2
     *
     * @return float
     */
    protected function getDiffInSeconds(DateTime $date1, DateTime $date2): float
    {
        $diff = $date1->diff($date2);

        return (int)$diff->format('%a') * 86400 + $diff->h * 3600 + $diff->i * 60 + $diff->s;
    }
}