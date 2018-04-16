<?php

namespace Sudoku\Traits;

trait PlayGame {

    private function restartGame()
    {
        // reset player's fill
        $this->player       = $this->puzzle;
        $this->playerCols   = $this->puzzleCols;
    }

    private function handleGame($stdin)
    {

        if ($stdin == 'new') {
            $this->initGame();
            return ['', []];
        }

        if ($stdin == 'reset') {
            $this->restartGame();
            return ['', []];
        }

        if ($stdin == 'h' || $stdin == 'help')
            return ['help', []];


        return ['(12, 3) is out of range', []];
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
             * 'cd n'       => change difficult (level 1-3 as easy-hard)
             * 'new'        => new game
             * 'reset'      => restart
             * 'h' or 'help'=> help
             */
            list($res, $hl) = $this->handleGame($stdin);
        } while ($stdin != 'q');
    }
}
