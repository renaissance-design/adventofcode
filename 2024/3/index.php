<?php

class Day3 {

    private $program;
    private $instructions;
    private $output;

    public function __construct($file) {
        $this->readInput($file);
    }

    private function readInput($file) {
        if (file_exists($file) && is_readable($file)) {
            $fileHandle = fopen($file, 'r');
            $this->program = fread($fileHandle, filesize($file));
            fclose($fileHandle);
        }
    }

    private function extractInstructions($program) {
        preg_match_all('/mul\([0-9]+,[0-9]+\)/', $this->program, $this->instructions);
    }

    private function executeInstructions($instructions) {
        foreach ($instructions[0] as $instruction) {
            $instructionsClean[] = explode(',', str_replace('mul(', '', str_replace(')', '', $instruction)));
        }
        foreach ($instructionsClean as $instructionClean) {
            $this->output[] = $instructionClean[0] * $instructionClean[1];
        }
    }

    public function solvePart1() {
        $this->extractInstructions($this->program);
        $this->executeInstructions($this->instructions);
        return array_sum($this->output);
    }
}

$day3 = new Day3('input.txt');

echo 'Part 1: ' . $day3->solvePart1() . "\r\n";
