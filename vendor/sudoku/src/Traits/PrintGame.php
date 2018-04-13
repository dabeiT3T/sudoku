<?php

namespace Sudoku\Traits;

use Sudoku\ShellColors;

trait PrintGame {
    protected function printRow($row, $x, $y, $r)
    {
        echo '|';
        foreach ($row as $key => $v) {
            if ($x === $key || $r === $y) {
                echo ShellColors::getColoredString(' '. $v, 'black', 'green');
            } else {
                if ($v == ' ') {
                    echo ' ';
                    echo ShellColors::getColoredString($v, 'black', 'light_gray');
                } else
                    echo ShellColors::getColoredString(' ' . $v, 'black');
            }


            if ($key % 3 == 2) {
                echo ShellColors::getColoredString(' ', 'black');
                echo '|';
            }
        }
    }

    protected function printBorderNum()
    {
        echo ShellColors::getColoredString("     1 2 3   4 5 6   7 8 9  \n", 'light_green');;
                                      //   '   +-------+-------+-------+'
    }

    protected function printBorder()
    {
        echo "   +-------+-------+-------+\n";
        //   '   | 1 2 3 | 4 5 6 | 7 8 9 |'
    }

    protected function printResponse($res)
    {
        echo ShellColors::getColoredString($res, 'light_red');
        echo "\n";
    }

    protected function printTips()
    {
        echo 'Enter (x y [number]) or (q) to quit:';
    }

    protected function printTable($x = null, $y = null)
    {
        system('clear');
        $this->printBorderNum();
        $this->printBorder();
        foreach ($this->player as $key => $row) {
            echo ' ' . ShellColors::getColoredString($key+1 . ' ', 'light_green');
            $this->printRow($row, $x, $y, $key);
            echo ' ' . ShellColors::getColoredString($key+1, 'light_green');
            echo "\n";
            if ($key % 3 == 2)
                $this->printBorder();
        }
        $this->printBorderNum();
    }

    public function __toString()
    {
        return ShellColors::getColoredString('sudoku', 'light_green') .
            ' v0.1 by ' .
            ShellColors::getColoredString('dabei', 'light_blue') .
            " wish u enjoy it: )\n";
    }
}
