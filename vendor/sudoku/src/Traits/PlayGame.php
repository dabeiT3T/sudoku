<?php

namespace Sudoku\Traits;

trait PlayGame {

    private function restartGame()
    {
        // reset player's fill
        $this->player       = $this->puzzle;
        $this->playerCols   = $this->puzzleCols;
    }

    private function changeLevel($level)
    {
        if ($level >= 1 && $level <= 3) {
            $this->difficult = $level;
            $this->initGame();
            return ['', []];
        }

        return ['Parameter for changing level is illegal.', []];
    }

    private function handleGame($stdin)
    {

        switch ($stdin) {
            // new game
            case 'new':
                $this->initGame();
                return ['', []];
            // restart
            case 'reset':
                $this->restartGame();
                return ['', []];
            // help
            case 'h':
            case 'help':
                return ['help', []];
            // input nothing
            case '':
                return ['', []];
        }

        if (substr($stdin, 0, 2) == 'cl') {
            $level = intval(substr($stdin, 2));
            return $this->changeLevel($level);
        }

        // return ['(12, 3) is out of range', []];
        return ['Undefined commmand, enter (h or help) to get help.', []];
    }

    public function playGame()
    {
        $res = '';
        $hl = [];
        do {
            // gameover
            if ($res === true) {
                   
            }

            // print table
            call_user_func_array([$this, 'printTable'], $hl);
            // print result
            $this->printResponse($res);
            // tips
            $this->printTips();
            // get user input
            $stdin = trim(fgets(STDIN));
            /**
             * handle input
             * 'col row n'  => set (cow, rol) number n
             * 'col row'    => highlight col and row
             * 'cl n'       => change level (level 1-3 as easy-hard)
             * 'new'        => new game
             * 'reset'      => restart
             * 'h' or 'help'=> help
             */
            list($res, $hl) = $this->handleGame($stdin);
        } while ($stdin != 'q');
    }
}
