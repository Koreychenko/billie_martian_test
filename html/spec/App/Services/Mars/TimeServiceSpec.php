<?php

namespace spec\App\Services\Mars;

use DateTime;
use App\Models\PlanetTime;
use App\Services\Mars\TimeService;
use PhpSpec\ObjectBehavior;

class TimeServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TimeService::class);
    }

    function it_is_getRightTime()
    {
        /**
         * Time calculation example is given here http://blogs.smithsonianmag.com/science/files/2012/08/Mars24.png
         */
        $date = new DateTime('2012-08-09T14:02:01', new \DateTimeZone('UTC'));
        $this->getTime($date)->shouldBeAnInstanceOf(PlanetTime::class);
        $this->getTime($date)->getDays()->shouldReturn(49272.52);
        $this->getTime($date)->getFormattedDays()->shouldReturn("49272.52 MSD");
        $this->getTime($date)->getFormattedTime()->shouldReturn('12:27:53 MTC');

        /**
         * Time calculation example is given here https://www.giss.nasa.gov/tools/mars24/help/algorithm.html
         */
        $date = new DateTime('2000-01-06T00:00:00', new \DateTimeZone('UTC'));
        $this->getTime($date)->shouldBeAnInstanceOf(PlanetTime::class);
        $this->getTime($date)->getFormattedTime()->shouldReturn('23:59:39 MTC');

        $date = new DateTime('2004-01-03T13:46:31', new \DateTimeZone('UTC'));
        $this->getTime($date)->shouldBeAnInstanceOf(PlanetTime::class);
        $this->getTime($date)->getFormattedTime()->shouldReturn('13:09:55 MTC');
    }
}
