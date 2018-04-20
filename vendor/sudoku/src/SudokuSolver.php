<?php

namespace Sudoku;

use Sudoku\Traits\Utils;
use Sudoku\Traits\InitGame;
use Sudoku\Traits\PlayGame;
use Sudoku\Traits\PrintGame;

class SudokuSolver {

    protected $sudoku = [];
    protected $sudokuCols = [];

    protected $ctSolutions = 0;

    private function checkOriginSudoku($origin)
    {
        if (is_array($origin) && count($origin) == 9) {
            foreach ($origin as $key => $row) {
                if (count($row) != 9)
                    return false;
            }
            return true;
        }

        return false;
    }

    private function generateCols()
    {
        for ($i=0; $i < 9; $i++) { 
            for ($j=0; $j < 9; $j++) { 
                $this->sudokuCols[$i][] = $this->sudoku[$j][$i];
            }
        }
    }

    public function __construct($origin)
    {
        if ($this->checkOriginSudoku($origin)) {
            $this->sudoku = $origin;
            $this->generateCols();
        }
    }
}
