<?php

namespace Sudoku;

use Sudoku\Traits\InitGame;
use Sudoku\Traits\PlayGame;
use Sudoku\Traits\PrintGame;

class Sudoku {

    use InitGame, PlayGame, PrintGame;

    private $sudoku = [];
    private $cols = [];     // in python we can use [col[1] for col in sudoku]:)

    public function __construct()
    {
        $this->initGame();
        $this->playGame();
    }
}
