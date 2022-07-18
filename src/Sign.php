<?php
/**
 * Created by PhpStorm.
 * User: ship
 * Date: 2022/7/17 0017
 * Time: 14:12
 */
namespace HengXinTong;

class Sign {
    public static function encrypt($data,$key,$type="md5"){
        if(isset($data['sign_type'])){
            unset($data['sign_type']);
        }
        if($type=='md5'){
            $sign = static::md5(static::transformStr($data,$key));
        }
        return strtoupper($sign);
    }

    protected static function transformStr($params,$key){
        ksort($params);
        $str = '';
        foreach ($params as $k => $val) {
            if (empty($val)) {
                continue;
            }
            $str .= $k . '=' . $val . '&';
        }
        $str = rtrim($str, '&');
        $str .= '&key=' . $key;
        return $str;
    }

    protected static function md5($str){
        return md5($str);
    }

    public static function verify($data,$key,$sign,$type="md5"){
        $newSign = static::encrypt($data,$key,$type);
        if($newSign == $sign){
            return true;
        }
        return false;
    }
}