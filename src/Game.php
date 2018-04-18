<?php
namespace App;

class Game
{
    private $grid;

    private $god;

    function __invoke()
    {
        $this->god = new God();
        $this->grid = new Grid(6, 6);
        $this->grid->setGrid(
            [
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::LIVE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
                [Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE, Grid::DIE],
            ]
        );

        $this->grid->print();
        sleep(1);

        while (true) {
            print('=======================================' . "\n");
            $this->next();
            print('=======================================' . "\n");
            sleep(1);
        }
    }

    public function computeNextStep()
    {
        $nextGrid = $this->grid->getGrid();
        foreach ($nextGrid as $x => &$row) {
            foreach ($row as $y => &$cell) {
                $cell = God::canLive($cell, $this->grid->neighbor($x, $y)) ? Grid::LIVE : Grid::DIE;
            }
        }
        $this->grid->setGrid($nextGrid);
    }

    function next()
    {
        $this->computeNextStep();
        $this->grid->print();
    }
}