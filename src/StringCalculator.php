<?php declare (strict_types = 1);

namespace App;

class StringCalculator
{
    public function add(string $number): string
    {
        $values = explode(",", $number);
        var_dump($values);
        return "";
    }
}
