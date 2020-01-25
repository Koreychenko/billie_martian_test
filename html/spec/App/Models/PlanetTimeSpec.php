<?php

namespace spec\App\Models;

use App\Models\PlanetTime;
use PhpSpec\ObjectBehavior;

class PlanetTimeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(100, 20, 10, 30);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PlanetTime::class);
    }

    function it_is_has_workingGetters()
    {
        $this->getDays()->shouldReturn(100.0);
        $this->getHours()->shouldReturn(20);
        $this->getMinutes()->shouldReturn(10);
        $this->getSeconds()->shouldReturn(30);
        $this->getFormattedTime()->shouldReturn('20:10:30');
    }
}
