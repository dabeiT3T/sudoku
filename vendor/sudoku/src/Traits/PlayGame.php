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
        if ($this->inRange($level, 1, 3)) {
            $this->difficult = $level;
            $this->initGame();
            return '';
        }

        return 'Parameter for changing level is illegal.';
    }

    private function highlightColnRow($nums)
    {
        $col = intval($nums[0]);
        $row = intval($nums[1]);
        
        if ($this->inRange($col, 1, 9) && $this->inRange($row, 1, 9)) {
            $this->hl = [$col - 1, $row - 1];
            return "Highlight ($col, $row)";
        }

        return 'Parameters for highlight is illegal.';
    }

    private function fillNumber($nums)
    {
        $col = intval($nums[0]);
        $row = intval($nums[1]);
        $num = intval($nums[2]);

        if ($this->inRange($col, 1, 9) && 
            $this->inRange($row, 1, 9) &&
            $this->inRange($num, 1, 9) &&
            $this->puzzle[$row-1][$col-1] === ' '
        ) {
            $this->player[$row-1][$col-1] = $num;
            $this->playerCols[$col-1][$row-1] = $num;
            return "Set ($col, $row) number $num";
        }

        return 'Parameters for setting number is illegal.';
    }

    private function handleGame($stdin)
    {

        switch ($stdin) {
            // new game
            case 'new':
                $this->initGame();
                return '';
            // restart
            case 'reset':
                $this->restartGame();
                return '';
            // help
            case 'h':
            case 'help':
                return 'help';
            // input nothing
            case '':
                return '';
        }
        // change level
        if (substr($stdin, 0, 2) == 'cl') {
            $level = intval(substr($stdin, 2));
            return $this->changeLevel($level);
        }
        // get col row [n] array
        $nums = preg_split('/[\s,]+/', $stdin);
        // highlight col and row
        if (count($nums) == 2)
            return $this->highlightColnRow($nums);
        // set (col, row) number n
        if (count($nums) == 3)
            return $this->fillNumber($nums);

        // return ['(12, 3) is out of range', []];
        return 'Undefined commmand, enter (h or help) to get help.';
    }

    public function playGame()
    {
        $res = '';
        do {
            // gameover
            if ($res === true) {
                   
            }

            // print table
            $this->printTable();
            // print result
            $this->printResponse($res);
            // tips
            $this->printTips();
            // get user input
            $stdin = trim(fgets(STDIN));
            /**
             * handle input
             * 'col row n'  => set (col, row) number n
             * 'col row'    => highlight col and row
             * 'cl n'       => change level (level 1-3 as easy-hard)
             * 'new'        => new game
             * 'reset'      => restart
             * 'h' or 'help'=> help
             */
            $res = $this->handleGame($stdin);
        } while ($stdin != 'q');
    }
}
