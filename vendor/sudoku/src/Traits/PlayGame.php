<?php

namespace Sudoku\Traits;

trait PlayGame {

    private function handleGame($stdin)
    {
        return ['(12, 3) is out of range', []];
    }

    public function playGame()
    {
        $res = '';
        $hl = [];
        do {
            call_user_func_array([$this, 'printTable'], $hl);
            $this->printResponse($res);
            $this->printTips();
            $stdin = trim(fgets(STDIN));
            list($res, $hl) = $this->handleGame($stdin);
        } while($stdin != 'q');
    }
}
