<?php

class Day1 {

    private $left;
    private $right;

    public function __construct($file) {
        $this->populateLists($file);
    }

    private function populateLists($file) {

        if (file_exists($file) && is_readable($file)) {

            foreach (file($file) as $line) {

                $split = explode('   ', $line);

                $this->left[] = (int) $split[0];
                $this->right[] = (int) $split[1];
            }
        }
    }

    public function solvePart1() {
        sort($this->left, SORT_NUMERIC);
        sort($this->right, SORT_NUMERIC);

        for ($i = 0; $i < count($this->left); $i++) {
            $results[$i] = ( $this->left[$i] > $this->right[$i] ? $this->left[$i] - $this->right[$i] : $this->right[$i] - $this->left[$i] );
        }

        return array_sum($results);
    }

    public function solvePart2() {
        for ($i = 0; $i < count($this->left); $i++) {
            $results[$i] = $this->left[$i] * count(array_keys($this->right, $this->left[$i]));
        }
        return array_sum($results);
    }
}

$day1 = new Day1('input.txt');

echo 'Part 1: ' . $day1->solvePart1() . "\r\n";
echo 'Part 2: ' . $day1->solvePart2();
