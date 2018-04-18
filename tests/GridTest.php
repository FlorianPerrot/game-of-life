<?php
namespace Tests;

use App\Exceptions\InvalidGridElementException;
use App\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{

    function testBuildGrid()
    {
        $grid = new Grid(2, 2);
        $this->assertEquals(
            [
                [Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE]
            ],
            $grid->getGrid()
        );
    }

    function testNeighbor()
    {
        $grid = new Grid();
        $grid->setGrid(
            [
                [Grid::DIE, Grid::LIVE],
                [Grid::DIE, Grid::LIVE],
            ]
        );

        $neighbor = $grid->neighbor(1, 1);
        $this->assertEquals([Grid::DIE, Grid::LIVE, Grid::DIE], $neighbor);

        $neighbor = $grid->neighbor(1, 0);
        $this->assertEquals([Grid::DIE, Grid::LIVE, Grid::LIVE], $neighbor);
    }

    function testComplexNeighbor()
    {

        $grid = new Grid();
        $grid->setGrid(
            [
                [Grid::DIE, Grid::LIVE, Grid::DIE],
                [Grid::DIE, Grid::LIVE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE],
            ]
        );

        $neighbor = $grid->neighbor(1, 1);
        $this->assertEquals([Grid::DIE, Grid::LIVE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE], $neighbor);

        $neighbor = $grid->neighbor(1, 0);
        $this->assertEquals([Grid::DIE, Grid::LIVE, Grid::LIVE, Grid::DIE, Grid::DIE], $neighbor);
    }

    function testInvalidElement()
    {
        $this->expectException(InvalidGridElementException::class);
        $grid = new Grid();
        $grid->setGrid(
            [
                [Grid::DIE, Grid::LIVE],
                [Grid::DIE, Grid::LIVE],
            ]
        );

        $grid->neighbor(2, 1);
    }
}