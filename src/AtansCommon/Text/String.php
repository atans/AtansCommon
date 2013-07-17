<?php
namespace AtansCommon\Text;

class String
{
    /**
     * Default encoding
     */
    const ENCODING = 'utf-8';

    /**
     * Cut string
     *
     * @param  string $string
     * @param  int    $length
     * @param  string $append
     * @param  string $encoding
     * @return string
     */
    public static function cut($string, $length, $append = '...', $encoding = self::ENCODING)
    {
        return self::sub($string, 0, $length, $encoding) . $append;
    }

    /**
     * Returns String length
     *
     * @param  string $string
     * @param  string string $encoding
     * @return int
     */
    public static function length($string, $encoding = self::ENCODING)
    {
        return mb_strlen($string, $encoding);
    }

    /**
     * Sub string
     *
     * @param  string $string
     * @param  int    $start
     * @param  null   $length
     * @param  string $encoding
     * @return string
     */
    public static function sub($string, $start, $length = null, $encoding = self::ENCODING)
    {
        if (is_null($length)) {
            $length = mb_strlen($string, $encoding) - $start;
        }
        return mb_substr($string, $start, $length, $encoding);
    }
}
