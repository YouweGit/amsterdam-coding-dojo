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
            ',',
            $this->replaceSeparators($number)
        );
    }
    private function replaceSeparators(string $number): string
    {
        return str_replace(
            $this->getSeparators($number),
            ',',
            $number
        );
    }
    private function getSeparators(string $number): array
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
        try{
            $this->checkIfLastCharIsValid($number);
            $this->checkForInvalidSeparatorPosition($number);
            $this->checkForNegativeNumber($number);
        }catch (\RuntimeException $e) {
            return $e->getMessage();
        }
        return '';
    }
    private function checkIfLastCharIsValid(string $number) : void
    {
        if (substr($number, -1) === ',') {
            throw  new \RuntimeException('Number expected but EOF found.');
        }
    }
    private function checkForInvalidSeparatorPosition(string $number): void
    {
        $position = strpos($number, ",\n");
        if (false !== $position) {
            $position++;
            throw new \RuntimeException("Number expected but '\n' found at position $position.");
        }
    }

    private function checkForNegativeNumber(string $number): void
    {
        foreach ($this->getValuesFromString($number) as $explodedString) {
            if ((int)$explodedString < 0) {
                $negativeNumbers[] = $explodedString;
            }
        }
        if (isset($negativeNumbers)) {
            throw new \RuntimeException('Negative not allowed : ' . implode(',', $negativeNumbers));
        }
    }
}
