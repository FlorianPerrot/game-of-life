<?php
namespace App;

use App\Exceptions\InvalidGridElementException;

class Grid
{
    const LIVE = 'o';

    const DIE = '-';

    private $grid;

    function __construct(int $xSize = 0, int $ySize = 0)
    {
        for ($i=0; $xSize > $i; $i++) {
            $tab = [];
            for ($y=0; $ySize > $y; $y++) {
                $tab[] = self::DIE;
            }
            $this->grid[] = $tab;
        }
    }

    public function neighbor(int $x, int $y): array
    {
        $neighbor = [];
        $this->getElement($x, $y);

        foreach ($this->getAroundPosition($x, $y) as $position) {
            try {
                $neighbor[] = $this->getElement($position[0], $position[1]);
            }
            catch (InvalidGridElementException $e) {}
        }

        return $neighbor;
    }

    public function setGrid(array $grid)
    {
        $this->grid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    public function print()
    {
        foreach ($this->grid as $row) {
            print(implode(' ', $row) . "\n");
        }
    }

    private function getAroundPosition($x, $y): array
    {
        return [
            [$x - 1, $y - 1],
            [$x - 1, $y],
            [$x - 1, $y + 1],
            [$x, $y - 1],
            [$x, $y + 1],
            [$x + 1, $y - 1],
            [$x + 1, $y],
            [$x + 1, $y + 1],
        ];
    }

    private function getElement($x, $y)
    {
        if (array_key_exists($x, $this->grid) && array_key_exists($y, $this->grid[$x])) {
            return $this->grid[$x][$y];
        }

        throw new InvalidGridElementException();
    }
}