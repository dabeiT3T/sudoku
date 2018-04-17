<?php

namespace Sudoku;

use Sudoku\Traits\Utils;
use Sudoku\Traits\InitGame;
use Sudoku\Traits\PlayGame;
use Sudoku\Traits\PrintGame;

class Sudoku {

    use Utils, InitGame, PlayGame, PrintGame;

    // answer
    private $sudoku = [];
    private $cols   = [];     // in python we can use [col[1] for col in sudoku]:)

    // puzzle
    private $puzzle       = [];
    private $puzzleCols   = [];

    // Player fill the blanks
    private $player     = [];
    private $playerCols = [];
    // level
    private $difficult = 1;
    private $level = [
        1 => 'easy',
        2 => 'medium',
        3 => 'hard',
    ];
    // highlight
    private $hl;

    public function __construct()
    {
        $this->initGame();
    }
}
