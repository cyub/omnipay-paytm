<?php

namespace Omnipay\Paytm\Common;

use Exception;

class Util
{
    /**
     * 加密
     *
     * @param string $data
     * @param string $key
     * @param string $iv
     * @param array $settings
     * @return string
     */
    public static function encrypt($data, $key, $iv, $settings = array())
    {
        if (!extension_loaded('mcrypt')) {
            throw new Exception('mcrypt extension is must');
        }

        $defaults = array(
            'algorithm' => MCRYPT_RIJNDAEL_128,
            'mode' => MCRYPT_MODE_CBC,
            'pad' => 'pkcs5'
        );
        $settings = array_merge($defaults, $settings);


        $module = mcrypt_module_open($settings['algorithm'], '', $settings['mode'], '');

        if ($settings['pad']) {
            $size = mcrypt_get_block_size($settings['algorithm'], $settings['mode']);
            $padMethod = $settings['pad'] . 'Pad';

            $data = Util::$padMethod($data, $size);
        }

        mcrypt_generic_init($module, $key, $iv);
        $encryptedData = mcrypt_generic($module, $data);
        mcrypt_generic_deinit($module);

        return $encryptedData;
    }

    /**
     * 解密
     *
     * @param string $data
     * @param string $key
     * @param string $iv
     * @param array $settings
     * @return string
     */
    public static function decrypt($data, $key, $iv, $settings = array())
    {
        if (!extension_loaded('mcrypt')) {
            throw new Exception('mcrypt extension is must');
        }

        $defaults = array(
            'algorithm' => MCRYPT_RIJNDAEL_128,
            'mode' => MCRYPT_MODE_CBC,
            'unpad' => 'pkcs5'
        );
        $settings = array_merge($defaults, $settings);

        $module = mcrypt_module_open($settings['algorithm'], '', $settings['mode'], '');

        mcrypt_generic_init($module, $key, $iv);
        $decryptedData = mdecrypt_generic($module, $data);
        if ($settings['unpad']) {
            $unpadMethod = $settings['unpad'] . 'Unpad';
            $decryptedData =  Util::$unpadMethod($decryptedData);
        }
        $res = rtrim($decryptedData);
        mcrypt_generic_deinit($module);

        return $res;
    }

    /**
     * pkcs5填充
     *
     * @param string $text
     * @param int $blocksize
     * @return string
     */
    public static function pkcs5Pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     * pkcs5反填充
     *
     * @param string $text
     * @return string
     */
    public static function pkcs5UnPad($text)
    {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) {
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    /**
     * 生成随机字符串
     *
     * @param int $length
     * @return string
     */
    public static function randString($length)
    {
        $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
        $data .= "0FGH45OP89";
        
        $random = "";
        $len = strlen($data);

        srand((double) microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, rand() % $len, 1);
        }

        return $random;
    }
}
