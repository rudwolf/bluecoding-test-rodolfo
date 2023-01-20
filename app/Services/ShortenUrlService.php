<?php

namespace App\Services;

class ShortenUrlService
{
    /**
     * Default characters to use for shortening.
     *
     * @var string
     */
    private $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Salt for id encoding.
     *
     * @var string
     */
    private $salt = 'Env-l-m)bP=fFy/=CQl-XGxBDDpgUS#7aEZ2UNgtf7BaA+SVjH';

    /**
     * Length of number padding.
     */
    private $padding = 4;

    /**
     * Converts an id to an encoded string.
     *
     * @param int $n Number to encode
     * @return string Encoded string
     */
    public function Encode($n)
    {
        $k = 0;

        if ($this->padding > 0 && !empty($this->salt)) {
            $k = self::GetSeed($n, $this->salt, $this->padding);
            $n = (int) ($k.$n);
        }

        return self::NumToAlpha($n, $this->chars);
    }

    /**
     * Gets a number for padding based on a salt.
     *
     * @param int $n Number to pad
     * @param string $salt Salt string
     * @param int $padding Padding length
     * @return int Number for padding
     */
    public static function GetSeed($n, $salt, $padding)
    {
        $hash = md5($n.$salt);
        $dec = hexdec(substr($hash, 0, $padding));
        $num = $dec % pow(10, $padding);
        if ($num == 0) {
            $num = 1;
        }
        $num = str_pad($num, $padding, '0');

        return $num;
    }

    /**
     * Converts a number to an alpha-numeric string.
     *
     * @param int $num Number to convert
     * @param string $s String of characters for conversion
     * @return string Alpha-numeric string
     */
    public static function NumToAlpha($n, $s)
    {
        $b = strlen($s);
        $m = $n % $b;

        if ($n - $m == 0) {
            return substr($s, $n, 1);
        }

        $a = '';

        while ($m > 0 || $n > 0) {
            $a = substr($s, $m, 1).$a;
            $n = ($n - $m) / $b;
            $m = $n % $b;
        }

        return $a;
    }

    public function getPageTitle($url)
    {
        $title = '';
        $dom = new \DOMDocument();
        if (@$dom->loadHTMLFile($url)) {
            $elements = $dom->getElementsByTagName('title');
            if ($elements->length > 0) {
                $title = $elements->item(0)->textContent;
            }
        }
        return $title;
    }
}
