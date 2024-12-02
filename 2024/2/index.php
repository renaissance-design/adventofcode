<?php

class Day2 {

    private $reports;

    public function __construct($file) {

        $this->populateReports($file);
    }

    private function populateReports($file) {

        if (file_exists($file) && is_readable($file)) {

            foreach (file($file) as $line) {
                $this->reports[] = explode(' ', $line);
            }
        }
    }

    private function isSafe($report) {
        $trend = ($report[0] < $report[1] ? 'inc' : 'dec');

        for ($i = 0; $i < (count($report) - 1); $i++) {
            if (($trend == 'inc' && $report[$i] > $report[$i + 1]) || ($trend == 'dec' && $report[$i] < $report[$i + 1])) {
                return false;
            }
            $safetyFactor = abs($report[$i] - ($report[$i + 1]));
            if ($safetyFactor == 0 || $safetyFactor > 3) {

                return false;
            }
        }
        return true;
    }

    private function isSafeFudged($report) {
        $trend = ($report[0] < $report[1] ? 'inc' : 'dec');
        $dangerLevel = 0;

        for ($i = 0; $i < (count($report) - 1); $i++) {
            if (($trend == 'inc' && $report[$i] > $report[$i + 1]) || ($trend == 'dec' && $report[$i] < $report[$i + 1])) {
                $dangerLevel++;
            }
            $safetyFactor = abs($report[$i] - ($report[$i + 1]));
            if ($safetyFactor == 0 || $safetyFactor > 3) {
                $dangerLevel++;
            }
            if($dangerLevel > 1) {
                return false;
            }
        }
        
        return true;
    }

    public function solvePart1() {
        $safe = 0;
        foreach ($this->reports as $report) {
            if ($this->isSafe($report)) {
                $safe++;
            }
        }
        return $safe;
    }

    public function solvePart2() {
        $safe = 0;
        foreach ($this->reports as $report) {
            if ($this->isSafeFudged($report)) {
                $safe++;
            }
        }
        return $safe;
    }
}

$day2 = new Day2('input.txt');

echo 'Part 1: ' . $day2->solvePart1() . "\r\n";
echo 'Part 2: ' . $day2->solvePart2();
