<?php

namespace Omnipay\Paytm\Common;

class Signer
{
    /**
     * 签名key
     *
     * @var string
     */
    protected $key;

    /**
     * 加密向量
     *
     * @var string
     */
    protected $iv = '@@@@&&&&####$$$$';

    /**
     * 加密方法
     * @var string
     */
    protected $cipherMethod = 'AES-128-CBC';

    /**
     * 设置签名key
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->setKey($key);
    }
    
    /**
     * 生成签名
     *
     * @param mixed $data
     * @return string
     */
    public function make($data)
    {
        if (!$this->key) {
            throw new \Exception('Please set signature key!');
        }

        if (is_array($data)) {
            $data = $this->toWaitEncryptString($data);
            return $this->make($data);
        }

        $salt = Util::randString(4);
        $hash = hash('sha256', $data . '|' . $salt);
        $encrypted = openssl_encrypt($hash . $salt, $this->cipherMethod, html_entity_decode($this->key), 0, $this->iv);
        return $encrypted;
    }

    /**
     * 验证签名
     *
     * @param mixed $data 
     * @param string $sign
     * @return boolean
     */
    public function verify($data, $sign)
    {
        if (!$this->key) {
            throw new \Exception('Please set signature key!');
        }
        if (is_array($data)) {
            unset($data['CHECKSUMHASH']);
            $data = $this->toWaitEncryptString($data);
        }

        $decrypted = openssl_decrypt($sign, $this->cipherMethod, html_entity_decode($this->key), 0, $this->iv);
        $salt = substr($decrypted, -4);
        $hash = hash('sha256', $data .  '|' . $salt);
        if (substr($decrypted, 0, -4) == $hash) {
            return true;
        }
        return false;
    }

    /**
     * 设置秘钥
     * @param $key
     */
    public function setKey($key)
    {
        $this->key  = $key;
    }

    /**
     * 拼接成待加密字符串
     * @param array $data
     * @return string
     */
    protected function toWaitEncryptString(array $data)
    {
        ksort($data);
        $values = array_values($data);
        $values = array_map(function ($item) {
            return $item == 'null' ? '' : $item;
        }, $values);

        return implode('|', $values);
    }
}