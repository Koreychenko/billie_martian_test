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
        $date = new DateTime('2012-08-09T14:02:01', new \DateTimeZone('UTC'));
        $this->getTime($date)->shouldBeAnInstanceOf(PlanetTime::class);
        $this->getTime($date)->getDays()->shouldReturn(49272.52);
        $this->getTime($date)->getFormattedTime()->shouldReturn('12:27:56');
    }
}
