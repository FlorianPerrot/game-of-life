<?php

use App\God;
use App\Grid;

class GodTest extends \PHPUnit\Framework\TestCase
{
    function testCanLive()
    {
        $this->assertEquals(true, God::canLive(Grid::DIE, [Grid::LIVE, Grid::LIVE, Grid::LIVE]));

        $this->assertEquals(false, God::canLive(Grid::LIVE, [Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE]));

        $this->assertEquals(true, God::canLive(Grid::LIVE, [Grid::LIVE, Grid::LIVE]));
        $this->assertEquals(true, God::canLive(Grid::LIVE, [Grid::LIVE, Grid::LIVE, Grid::LIVE]));

        $this->assertEquals(false, God::canLive(Grid::LIVE, [Grid::DIE, Grid::DIE, Grid::LIVE, Grid::DIE, Grid::DIE]));
    }

    function testFilter()
    {
        $this->assertEquals([Grid::LIVE], God::filterBy(Grid::LIVE, [Grid::LIVE, Grid::DIE, Grid::DIE]));
        $this->assertEquals([Grid::LIVE, Grid::LIVE], God::filterBy(Grid::LIVE, [Grid::LIVE, Grid::LIVE, Grid::DIE]));
        $this->assertEquals([Grid::DIE], God::filterBy(Grid::DIE, [Grid::LIVE, Grid::LIVE, Grid::DIE]));
    }
}