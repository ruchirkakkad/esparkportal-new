<?php
/**
 * Created by PhpStorm.
 * User: ruchir
 * Date: 4/8/2015
 * Time: 12:21 PM
 */

class Helper
{
    public static function simple_decrypt($string, $key = null)
    {
        $key = $_SERVER['REMOTE_ADDR'];
        $string = base64_decode(base64_decode($string));
        $key = md5($key); //to improve variance
        /* Open module, and create IV */
        $td = mcrypt_module_open('des', '', 'cfb', '');

        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = substr($string, 0, $iv_size);
        $string = substr($string, $iv_size);
        /* Initialize encryption handle */
        if (mcrypt_generic_init($td, $key, $iv) != -1)
        {
            /* Encrypt data */
            $c_t = mdecrypt_generic($td, $string);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            return $c_t;
        } //end if
    }

    public static function simple_encrypt($string, $key = null)
    {
        $key = $_SERVER['REMOTE_ADDR'];
        srand((double) microtime() * 1000000); //for sake of MCRYPT_RAND
        $key = md5($key); //to improve variance
        /* Open module, and create IV */
        $td = mcrypt_module_open('des', '', 'cfb', '');
        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        /* Initialize encryption handle */
        if (mcrypt_generic_init($td, $key, $iv) != -1)
        {
            /* Encrypt data */
            $c_t = mcrypt_generic($td, $string);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            $c_t = $iv . $c_t;
            return base64_encode(base64_encode($c_t));
        } //end if
    }



}