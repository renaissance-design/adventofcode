<?php

class Day3 {

    private $program;
    private $instructions;
    private $controls;
    private $tape;
    private $output;
    private $output2;

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
        preg_match_all('/mul\([0-9]+,[0-9]+\)/', $this->program, $this->instructions, PREG_OFFSET_CAPTURE);

        foreach ($this->instructions[0] as $value) {
            $this->tape[$value[1]] = $value[0];
        }
    }

    private function extractControls($program) {
        preg_match_all('/do\(\)/', $this->program, $do, PREG_OFFSET_CAPTURE);
        preg_match_all("/don't\(\)/", $this->program, $dont, PREG_OFFSET_CAPTURE);
        foreach ($do[0] as $value) {
            $this->tape[$value[1]] = $value[0];
        }
        foreach ($dont[0] as $value) {
            $this->tape[$value[1]] = $value[0];
        }
    }

    private function executeInstructions($instructions) {
        foreach ($instructions[0] as $instruction) {
            $instructionsClean[] = explode(',', str_replace('mul(', '', str_replace(')', '', $instruction[0])));
        }
        foreach ($instructionsClean as $instructionClean) {
            $this->output[] = $instructionClean[0] * $instructionClean[1];
        }
    }

    private function executeTape($tape) {
        $yoda = true;
        foreach ($tape as $value) {
            if ($value == "don't()") {
                $yoda = false;
            } elseif ($value == 'do()') {
                $yoda = true;
            } elseif ($yoda == true) {
                $instructionsClean[] = explode(',', str_replace('mul(', '', str_replace(')', '', $value)));
            }
        }
        foreach ($instructionsClean as $instructionClean) {
            $this->output2[] = $instructionClean[0] * $instructionClean[1];
        }
    }

    public function solvePart1() {
        $this->extractInstructions($this->program);
        $this->executeInstructions($this->instructions);
        return array_sum($this->output);
    }

    public function solvePart2() {
        $this->extractInstructions($this->program);
        $this->extractControls($this->program);
        ksort($this->tape);
        $this->executeTape($this->tape);
        return array_sum($this->output2);
    }
}

$day3 = new Day3('input.txt');

echo 'Part 1: ' . $day3->solvePart1() . "\r\n";
echo 'Part 2: ' . $day3->solvePart2();
