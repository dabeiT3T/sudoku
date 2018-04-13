<?php

namespace Sudoku\Traits;

trait InitGame {

    use FillBlanks, DigBlanks;

    private function initGame()
    {
        $this->fillBlanks();
        // this store puzzle (which will be print)
        $this->puzzle       = $this->sudoku;
        $this->puzzleCols   = $this->cols;
        unset($this->cols);         // no need any more
        $this->digBlanks();
        // this store player's fill
        $this->player       = $this->puzzle;
        $this->playerCols   = $this->puzzleCols;
        unset($this->puzzleCols);   // no need any more
    }
}
