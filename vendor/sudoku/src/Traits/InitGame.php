<?php

namespace Sudoku\Traits;

trait InitGame {

    private function getDiffNum($x, $y)
    {
        $a = range(1, 9);
        // x-axis
        if (isset($this->sudoku[$y])) {
            $a = array_diff($a, $this->sudoku[$y]);
        }
        // y-axis
        if (isset($this->cols[$x]))
            $a =  array_diff($a, $this->cols[$x]);

        // in-9-blanks(big blank)
        $b = [];
        $c = floor($y/3)*3;
        $r = floor($x/3)*3;

        for ($i=$c; $i < ($c+3); $i++) { 
            if (isset($this->sudoku[$i]))
                $b = array_merge($b, array_slice($this->sudoku[$i], $r, 3));
        }
        $a =  array_diff($a, $b);

        shuffle($a);
        return reset($a);
    }

    private function fillBlank($r, $c)
    {
        $row = $r * 3;  // 3
        $col = $c * 3;  // 0
        $lp = 0;
        do {
            for ($i=0; $i < 3; $i++) { 
                if (isset($this->cols[$col+$i]))
                    array_splice($this->cols[$col+$i], $r * 3, 3);
            }

            for ($i=0; $i < 3; $i++) { 
                if (isset($this->sudoku[$row+$i]))
                    array_splice($this->sudoku[$row+$i], $c * 3, 3);
            }

            for ($i=$row; $i < $row+3; $i++) { // y
                for ($j=$col; $j < $col+3; $j++) { // x
                    $num = $this->getDiffNum($j, $i);
                    $this->sudoku[$i][$j] = $num;
                    $this->cols[$j][] = $num;
                }
            }
            // escape dead loop
            if ($lp > 100) {
                $this->initGame();
                return true;
            }
            $lp++;
        } while(
            count(array_filter($this->cols[$col])) < ($r+1)*3 ||
            count(array_filter($this->cols[$col+1])) < ($r+1)*3 ||
            count(array_filter($this->cols[$col+2])) < ($r+1)*3
        );
        return false;
    }

    private function fillBlanks()
    {
        for ($i=0; $i < 3; $i++) { 
            for ($j=0; $j < 3; $j++) { 
                if ($this->fillBlank($j, $i))
                    return true;
            }
        }
    }

    private function digBlanks()
    {
        
    }

    private function initGame()
    {
        $this->sudoku = [];
        $this->cols = [];
        $this->fillBlanks();
        $this->digBlanks();
    }
}
