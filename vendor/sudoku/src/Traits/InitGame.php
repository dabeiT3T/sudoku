<?php

namespace Sudoku\Traits;

trait InitGame {

    use FillBlanks, DigBlanks;

    private function initGame()
    {
        $this->fillBlanks();
        // this store puzzle
        $this->puzzle       = $this->sudoku;
        $this->puzzleCols   = $this->cols;
        unset($this->cols);         // no need any more
        $this->digBlanks();
        // this store player's fill (which will be print)
        $this->player       = $this->puzzle;
        $this->playerCols   = $this->puzzleCols;
        // no highlight
        $this->hl = [null, null];
    }
}
