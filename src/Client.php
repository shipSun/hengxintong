<?php
/**
 * Created by PhpStorm.
 * User: ship
 * Date: 2022/7/17 0017
 * Time: 10:38
 */
namespace HengXinTong;

use GuzzleHttp\Utils;

/**
 * Class Client
 * @property \GuzzleHttp\Client $client
 */
class Client{
    protected $base_uri;
    protected $channel_id;

    protected $client;
    public $debug=false;

    public function __construct($domain,$channel_id){
        $this->base_uri = $domain;
        $this->channel_id = $channel_id;
    }
    protected function init(){
        $config['base_uri'] = $this->base_uri;
        $config['verify'] = false;
        $config['headers'] = [
            'channel_id'=>$this->channel_id,
            'Accept'=>'application/json',
        ];
        $config['debug'] = false;
        $config['version'] = CURL_HTTP_VERSION_1_1;
        $config['http_errors'] = false;
        $this->client = new \GuzzleHttp\Client($config);
    }
    public function post($uri,$data){
        if(!$this->client){
            $this->init();
        }
        $op['json'] = $data;
        if($this->debug){
            $this->log('接口',$this->base_uri.$uri);
            $this->log('参数',$data);
            $res = $this->client->post($uri,$op);
            $this->log('结果',$res->getBody()->getContents());
        }
        return $this->client->post($uri,$op);
    }
    protected function log($tag, $data){
        $msg = '['.$tag.']';
        if(is_array($data)){
            $msg.= Utils::jsonEncode($data);
        }else{
            $msg.= $data;
        }
        $msg.=PHP_EOL;
        echo $msg;
    }
}




