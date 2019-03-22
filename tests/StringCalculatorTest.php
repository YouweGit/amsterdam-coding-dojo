<?php declare (strict_types = 1);

namespace App\Test;
use App\StringCalculator;

class StringCalculatorTest extends \PHPUnit\Framework\TestCase
{
    private $stringCalculator;

    protected function setUp()
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }

    public function testStringCalculatorExists()
    {
        $this->assertInstanceOf(
            StringCalculator::class,
            $this->stringCalculator
        );
    }
    public function testAddReturnTypeString()
    {
        $return = $this->stringCalculator->add("123");

        $this->assertTrue(is_string($return));
    }

    public function testEmptyString()
    {
        $return = $this->stringCalculator->add("");

        $this->assertEquals($return, "0");
    }

    public function testSumOfTwoStrings()
    {
        $return = $this->stringCalculator->add("1,1");

        $this->assertEquals($return, "2");
    }

    public function testFloatingPoints()
    {
        $return = $this->stringCalculator->add("1.1,1");

        $this->assertEquals($return, "2.1");
    }

    public function testNewLineSeparator()
    {
        $return = $this->stringCalculator->add("1\n2,3");

        $this->assertEquals($return, "6");
    }

    public function testThatCombinedCommaAndNewlineReturnsErrorMessage()
    {
        $numbers = "175.2,\n35";
        $return = $this->stringCalculator->add($numbers);
        $this->assertEquals("Number expected but '\n' found at position 6.", $return);
    }

    public function testThatPositionOfInvalidCharacterCombinationIsReturnedInErrorMessage()
    {
        $numbers = "175.2,351,75.2,\n35";
        $position = strpos($numbers, ",\n");
        $expected = "Number expected but '\n' found at position " . $position . ".";
        $return = $this->stringCalculator->add($numbers);
        $this->assertEquals($expected, $return);
    }


}
