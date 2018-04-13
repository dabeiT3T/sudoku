<?php

namespace Sudoku\Traits;

trait FillBlanks {
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
                    $tmp = $this->getDiffList($j, $i, $this->sudoku, $this->cols);
                    $num = array_shift($tmp);
                    $this->sudoku[$i][$j] = $num;
                    $this->cols[$j][] = $num;
                }
            }
            // escape dead loop
            if ($lp > 100) {
                $this->fillBlanks();
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
        $this->sudoku   = [];
        $this->cols     = [];

        for ($i=0; $i < 3; $i++)
            for ($j=0; $j < 3; $j++)
                if ($this->fillBlank($j, $i))
                    return true;
    }
}
