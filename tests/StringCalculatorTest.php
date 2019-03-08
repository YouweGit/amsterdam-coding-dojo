<?php
/**
 * Created by PhpStorm.
 * User: paulo.bettini
 * Date: 2019-03-08
 * Time: 16:15
 */

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
    public function testAddRetrunTypeString(){
        $obj = new StringCalculator();
        $this->assertIsString(
            $obj->add('testing')
        );
    }
}
