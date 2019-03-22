<?php declare (strict_types=1);

namespace App;

class StringCalculator
{
    public function add(string $number): string
    {
        if (!$this->isLastCharValid($number)) {
            return 'Number expected but EOF found.';
        }

        $position = strpos($number, ",\n");
        if (false !== $position) {
            $position++;
            return "Number expected but '\n' found at position $position.";
        }
        $number = str_replace("\n", ",", $number);
        $values = explode(",", $number);
        return (string)array_sum($values);
    }

    private function isLastCharValid(string $number) : bool
    {
        $lastChar = substr($number, -1);
        if ($lastChar === ',') {
            return false;
        }

        return true;
    }
}
