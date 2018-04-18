<?php

namespace Sudoku\Traits;

use Sudoku\ShellColors;

trait PrintGame {

    private function getColoredNum($str, $num, $r, $c, $bgc = null)
    {
        // give user fill num color
        if ($this->puzzle[$r][$c] == ' ')
            echo ShellColors::getColoredString($str, 'blue', $bgc ?? 'light_gray');
        else
            echo ShellColors::getColoredString($str, 'black', $bgc ?? '');
    }

    protected function printRow($row, $x, $y, $r)
    {
        // maybe highlight same selected num in the future:)
        $num = 0;
        echo '|';
        foreach ($row as $key => $v) {
            // highlight x-axis
            if ($r === $y)
                $this->getColoredNum(' '. $v, $num, $r, $key, 'cyan');
            // highlight y-axis
            else if ($x === $key)
                $this->getColoredNum(' '. $v . ' ', $num, $r, $key,  'cyan');
            else {
                // highlight adjust
                if ($x !== $key - 1)
                    echo ' ';
                // normal print
                $this->getColoredNum($v, $num, $r, $key);
            }


            if ($key % 3 == 2) {
                if ($r === $y)
                    echo ShellColors::getColoredString(' ', 'black', 'cyan');
                else
                    echo ShellColors::getColoredString(' ', 'black');
                echo '|';
            }
        }
    }

    protected function printBorderNum()
    {
        echo ShellColors::getColoredString("     1 2 3   4 5 6   7 8 9  \n", 'light_green');;
                                      //   '   +-------+-------+-------+'
    }

    protected function printBorder()
    {
        echo "   +-------+-------+-------+\n";
        //   '   | 1 2 3 | 4 5 6 | 7 8 9 |'
    }

    protected function printHelp()
    {
        echo $this->__toString();
        
        $new    = ShellColors::getColoredString('new', 'dark_gray');
        $reset  = ShellColors::getColoredString('reset', 'dark_gray');
        $help   = ShellColors::getColoredString('help', 'dark_gray');
        $chdif  = ShellColors::getColoredString('cl n', 'dark_gray');
        $hl     = ShellColors::getColoredString('col row', 'dark_gray');
        $fill   = ShellColors::getColoredString('col row n', 'dark_gray');
        $quit   = ShellColors::getColoredString('q', 'dark_gray');

        echo <<<_HELP_
$chdif      => change level           $new  => new game  $reset => restart
$hl   => highlight col and row  $help => help      $quit     => quit
$fill => set (col, row) number n
_HELP_;
    }

    protected function printResponse($res)
    {
        if ($res == 'help')
            $this->printHelp();
        else
            echo "\n\n\n" . ShellColors::getColoredString($res, 'light_red');

        echo "\n";
    }

    protected function printTips()
    {
        echo 'Enter (x y [number]) to fill blanks:';
    }

    protected function printLevel()
    {
        echo "\n" . ShellColors::getColoredString('Level ', 'dark_gray');
        echo ShellColors::getColoredString($this->level[$this->difficult], 'light_cyan') . "\n\n";
    }

    protected function printTable()
    {
        system('clear');
        $this->printLevel();
        $this->printBorderNum();
        $this->printBorder();
        foreach ($this->player as $key => $row) {
            echo ' ' . ShellColors::getColoredString($key+1 . ' ', 'light_green');
            $this->printRow($row, $this->hl[0], $this->hl[1], $key);
            echo ' ' . ShellColors::getColoredString($key+1, 'light_green');
            echo "\n";
            if ($key % 3 == 2)
                $this->printBorder();
        }
        $this->printBorderNum();
    }

    public function __toString()
    {
        return ShellColors::getColoredString('sudoku', 'light_green') .
            ' v0.1 by ' .
            ShellColors::getColoredString('dabei', 'light_blue') .
            " wish u enjoy it: )\n";
    }
}
