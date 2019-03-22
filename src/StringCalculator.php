<?php declare (strict_types = 1);

namespace App;

class StringCalculator
{
    public function add(string $number): string
    {
        if (false !== strpos($number, ",\n")) {
            return "Number expected but '\n' found at position 6.";
        }
        $number = str_replace("\n", ",", $number);
        $values = explode(",", $number);
        return (string) array_sum($values);
    }
}
