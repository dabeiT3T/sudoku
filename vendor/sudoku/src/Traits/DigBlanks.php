<?php

namespace Sudoku\Traits;

trait DigBlanks {

    
    private function digBlanks()
    {
        for ($i=0; $i < 3; $i++) { 
            $x = mt_rand(0, 8);
            $y = mt_rand(0, 8);

            $num = $this->sudoku[$y][$x];
            $this->puzzle[$y][$x]       = ' ';
            $this->puzzleCols[$x][$y]   = ' ';
        }
        
        // if ($this->isBlankRepeat())
    }
}