<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/7/17 0017
 * Time: 15:38
 */
namespace HengXinTong\encrypt;

class Rsa{
    public static function encrypt($str){
        $public_key_path = <<<ETO
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDaB/kJLC8SVMD5o21UGYVTBEoq
4Aols6o/K8ghWewKdDEmSQnxSE2hUlwxHsfn4sZCCF46gnTJDrRwzBKBUN8yJyeo
mWH/sXpfzC1oTvH5mWqa9wNTRqIj3llmauf2sW1a6bU5Zjx/PxxEXTLB7mVSdvan
H6QdUDF/h7KhLlaa6wIDAQAB
-----END PUBLIC KEY-----
ETO;
;
        $public_key = openssl_get_publickey($public_key_path);
        if (openssl_public_encrypt($str, $encrypted, $public_key)) {
            //base64编码
            return base64_encode($encrypted);
        } else {
            throw new \Exception('encrypt failed');
        }
    }
}