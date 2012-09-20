<?php
error_reporting(E_ALL);

class RomanNumerals {
    /* Officially the numbers > 1000 should be overlined.
     * In unicode there are several codepoints for this purpose.
     * But for compatibility with ISO-8859 I used lowercase characters (more often used for this trick).
     * See for example: http://jeankorte.ca/jk-roman-numeral-converter.html
     */
    static private $asRomanTransTable = Array(
        1e6 => 'm',
        9e5 => 'cm',
        5e5 => 'd',
        4e5 => 'cd',
        1e5 => 'c',
        9e4 => 'xc',
        5e4 => 'l',
        4e4 => 'xl',
        1e4 => 'x',
        9e3 => 'ix',
        5e3 => 'v',
        4e3 => 'iv',
        1e3 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
    );

    /**
     * From decimal to Roman system.
     *
     * @param   integer $iDecimal
     * @return  string              The given decimal in Roman numeral system.
     */
    public static function toRoman($iDecimal) {
        # There is no Roman numeral representation below 1, and 3,999,999 is the longest number represented by Roman numerals
        $decimalValue = (int) $iDecimal;
        if (($iDecimal < 1) || ($iDecimal <= 0) || ($iDecimal > 3999999)) return NULL;

        $sRoman = '';
        foreach(self::$asRomanTransTable as $iNum => $sSymbol){
            if ($iDecimal < 1) break;
            while ($iDecimal >= $iNum){
                $iDecimal -= $iNum;
                $sRoman .= $sSymbol;
            }
        }
        return $sRoman;
    }

    /**
      * From roman to decimal numeral system
      *
      * @param    string    $sRoman
      * @return    integer                   0 on failure.
      */
    public static function toDecimal($sRoman){
        if(!is_string($sRoman)) return 0;

        $iStrLen = strlen($sRoman);
        $iDoubleSymbol = $iDec = $iPos = 0;
        foreach(self::$asRomanTransTable as $iNum => $sSymbol){
            $iLen = strlen($sSymbol);
            $iCount = 0;
            if($iDoubleSymbol){
                --$iDoubleSymbol;
                continue;
            }

            # Mind the fact that 1000 in the Roman numeral system may be represented by M or i.
            while((($sChunk = substr($sRoman, $iPos, $iLen)) == $sSymbol) || (($iNum < 1e4) && ($sChunk == strtr($sSymbol, 'iM', 'Mi')))){
                if($iLen == 2) $iDoubleSymbol = 3 - 2*($iNum % 3);
                $iDec += $iNum;
                $iPos += $iLen;

                # All symbols that represent 1eX may appear at maximum three times. All other symbols may only represent one time in a roman number.
                if(fmod(log10($iNum), 1) || (++$iCount == 3)) break;
            }
            if($iPos == $iStrLen) break;
        }

        # If there are symbols left, then the number was mallformed (following default rules (M = 1000 and i = 1000)).
        return (($iPos == $iStrLen)? $iDec : 0);
    }
}

?>