<?php

namespace Sudoku\Traits;

use Sudoku\ShellColors;

trait PrintGame {
	protected function printRow($row)
    {
        echo '|';
        foreach ($row as $key => $v) {
            echo ShellColors::getColoredString(' ' . $v, 'black', 'light_gray');
            if ($key % 3 == 2) {
                echo ShellColors::getColoredString(' ', 'black', 'light_gray');
                echo '|';
            }
        }
    }

    protected function printBorder()
    {
        echo "+-------+-------+-------+\n";
        //   '| 1 2 3 | 4 5 6 | 7 8 9 |'
    }

    protected function printTable()
    {
        system('clear');
        $this->printBorder();
        foreach ($this->sudoku as $key => $row) {
            $this->printRow($row);
            echo "\n";
            if ($key % 3 == 2)
                $this->printBorder();
        }
    }
}
