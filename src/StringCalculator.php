<?php declare (strict_types=1);

namespace App;

class StringCalculator
{
    public function add(string $number): string
    {
        $errors = $this->checkErrors($number);
        if ($errors !== '') {
            return $errors;
        }

        return (string) array_sum(
            $this->getValuesFromString($number)
        );
    }
    private function getValuesFromString(string $number): array
    {
        return explode(
            ",",
            $this->replaceSeparators($number)
        );
    }
    private function replaceSeparators(string $number): string
    {
        return str_replace(
            $this->getSeparator($number),
            ",",
            $number
        );
    }
    private function getSeparator(string $number): array
    {
        $separators = ['\n', "\n"];
        $beginNewSeparator = strpos($number, "//");
        $endNewSeparator = strpos($number, '\n');
        if ($beginNewSeparator !== false) {
            $separators[] = substr(
                $number,
                $beginNewSeparator+2,
                $endNewSeparator - ($beginNewSeparator+2)
            );
        }
        return $separators;
    }
    private function checkErrors(string $number): string
    {
        if (!$this->isLastCharValid($number)) {
            return 'Number expected but EOF found.';
        }
        $position = $this->getInvalidSeparatorPosition($number);
        if ($position !== 0) {
            return "Number expected but '\n' found at position $position.";
        }
        return '';
    }
    private function isLastCharValid(string $number) : bool
    {
        return substr($number, -1) !== ',';
    }
    private function getInvalidSeparatorPosition(string $number): int
    {
        $position = strpos($number, ",\n");
        if (false !== $position) {
            return ++$position;
        }
        return 0;
    }
}
