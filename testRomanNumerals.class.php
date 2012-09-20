<?php

include_once 'romanNumerals.class.php';

class testRomanNumerals extends PHPUnit_Framework_TestCase {
    
    /**
     * @dataProvider provider
     */
    
    public function testAdd($a, $b){
        $roman = new RomanNumerals();
        $this->assertEquals($roman->toRoman($a), $b);
    }
    
    public function provider(){
        return array(
            array(4000000, null), 
            array(-1, null), 
            array(10, 'X'), 
            array(90, 'XC')
        );
    }
    
    /**
     * @dataProvider decimalProvider
     */
    public function testDecimal($a, $b){
        $roman = new RomanNumerals();
        $this->assertEquals($roman->toDecimal($a), $b);
    }
    
    public function decimalProvider(){
        return array(
            array(1, 0),
            array('X', 10),
            array('cm', 9e5)
        );
    }

//    public function testAboveLimitToRoman(){
//        
//        $roman = new RomanNumerals();
//        $this->assertEquals($roman->toRoman(4000000), null);
//    }
//    
//    public function testUnderLimitToRoman(){
//        $roman = new RomanNumerals();
//        $this->assertEquals($roman->toRoman(-1), null);
//    }
//    
//    public function testTenToRoman(){
//        $roman = new RomanNumerals();
//        $this->assertEquals($roman->toRoman(10), 'X');
//    }
//    
//    public function testNinetyToRoman(){
//        $roman = new RomanNumerals();
//        $this->assertEquals($roman->toRoman(90), 'XC');
//    }
//    
//    public function testToDecimalIsNoString(){
//        $roman = new RomanNumerals();
//        $this->assertEquals($roman->toDecimal(1), 0);
//    }
//    
//    public function testToDecimalIsString(){
//        $roman = new RomanNumerals();
//        $this->assertEquals($roman->toDecimal('X'), 10);
//    }
}

?>