<?php

namespace cyberinferno\Cabal\Helpers;

/**
 * Class Character
 *
 * Contains methods helpful to decode character information
 *
 * @package cyberinferno\Cabal\Helpers
 * @author Karthik P
 */
class Character
{
    /**
     * Encode style
     *
     * @param int $gender
     * @param int $aura
     * @param int $hair
     * @param int $hairColor
     * @param int $face
     * @param int $classRank
     * @param int $class
     * @return int
     */
    public static function EncodeStyle($gender, $aura, $hair, $hairColor, $face, $classRank, $class)
    {
        $return = 0;
        $return += $gender * hexdec("4000000");
        $return += $aura * hexdec("400000") / 2;
        $return += $hair * hexdec("20000");
        $return += $hairColor * hexdec("2000");
        $return += $face * hexdec("100");
        $return += $classRank * 8;
        $return += $class;
        return $return;
    }

    /**
     * Decode style
     *
     * @param int $styleCode
     * @return array
     */
    public static function DecodeStyle($styleCode)
    {
        $style = [];
        $style['gender'] = intval($styleCode / hexdec("4000000"));
        $style['aura'] = intval(($styleCode % hexdec("4000000")) / hexdec("200000"));
        $style['hair'] = intval(($styleCode % hexdec("200000")) / hexdec("20000"));
        $style['hairColor'] = intval(($styleCode % hexdec("20000")) / hexdec("2000"));
        $style['face'] = intval(($styleCode % hexdec("2000")) / hexdec("100"));
        $style['rank'] = intval(($styleCode % hexdec("100")) / 8);
        $style['class'] = ($styleCode / 1 & 7);
        return $style;
    }

    /**
     * Encode position
     *
     * @param int $x
     * @param int $y
     * @return int
     */
    public static function EncodePosition($x, $y)
    {
        return ($x << 16) | $y;
    }

    /**
     * Decode position
     *
     * @param int $pos
     * @return array
     */
    public static function DecodePosition($pos)
    {
        $position = [];
        $position['x'] = ($pos >> 16);
        $position['y'] = $pos ^ ($position['x'] << 16);
        return $position;
    }
}