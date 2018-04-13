<?php

namespace Sudoku\Traits;

trait Utils {

    private function getDiffList($x, $y, $rows, $cols)
    {
        $a = range(1, 9);
        // x-axis
        if (isset($rows[$y])) {
            $a = array_diff($a, $rows[$y]);
        }
        // y-axis
        if (isset($cols[$x]))
            $a =  array_diff($a, $cols[$x]);

        // in-9-blanks(big blank)
        $b = [];
        $c = floor($y/3)*3;
        $r = floor($x/3)*3;

        for ($i=$c; $i < ($c+3); $i++) {
            if (isset($rows[$i]))
                $b = array_merge($b, array_slice($rows[$i], $r, 3));
        }
        
        $a =  array_diff($a, $b);

        shuffle($a);
        return $a;
    }

    private function isBlankRepeat($num, $x, $y, $rows, $cols)
    {
        // use this when digging and filling
        // array[$y][$x]

        // x-axis
        if (in_array($num, $rows[$y]) !== false)
            return false;
        // y-axis
        if (in_array($num, $cols[$x]) !== false)
            return false;
        // in-9-blanks
        $c = floor($y/3)*3;
        $r = floor($x/3)*3;
        for ($i=$c; $i < ($c+3); $i++) {
            if (isset($rows[$i])) {
                if (in_array($num, array_slice($rows[$i], $r, 3)) !== false)
                    return false;
            }
        }
        return true;
    }
}
