<?php declare (strict_types = 1);

namespace App;

class StringCalculator
{
    public function add(string $number): string
    {
        $values = explode(",", $number);
        return (string) array_sum($values);
    }
}
