<?php declare (strict_types = 1);

namespace App\Test;
use App\StringCalculator;

class StringCalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function testStringCalculatorExists()
    {
        $this->assertInstanceOf(
            StringCalculator::class,
            new StringCalculator()
        );
    }
    public function testAddReturnTypeString()
    {
        $stringCalculator = new StringCalculator();

        $return = $stringCalculator->add("123");

        $this->assertTrue(is_string($return));
    }

    public function testEmptyString()
    {
        $stringCalculator = new StringCalculator();

        $return = $stringCalculator->add("");

        $this->assertEquals($return, "0");
    }
}
