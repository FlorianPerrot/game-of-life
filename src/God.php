<?php
/**
 * Created by PhpStorm.
 * User: florianperrot
 * Date: 18/04/2018
 * Time: 12:54
 */

namespace App;


class God
{
    static function canLive($cellStatus, $neighbor): bool
    {
        $liveCells = count(self::filterBy(Grid::LIVE, $neighbor));

        if ($cellStatus === Grid::LIVE) {
            //Step 1
            if ($liveCells < 2) {
                return false;
            }

            //Step 2
            if ($liveCells > 3) {
                return false;
            }

            //Step 3
            return true;
        }
        else {
            //Step 4
            if ($liveCells === 3) {
                return true;
            }
            return false;
        }
    }

    static function filterBy($filter, $neighbor): array
    {
        return array_values(array_filter($neighbor, function($status) use ($filter) {return $status === $filter;}));
    }
}