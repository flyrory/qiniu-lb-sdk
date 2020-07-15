<?php

namespace Flyrory\QiniuLbSdk;

final class Transport
{
    private $_mac;

    public function __construct($mac)
    {
        $this->_mac = $mac;
    }

    public function send($method, $url, $body = null)
    {
        $headers = $this->_setHeaders($method, $url, $body);
        $response = HttpRequest::send($method, $url, $body, $headers);
        return $response->body;
    }

    private function _setHeaders($method, $url, $body = null)
    {
        if ($method != HttpRequest::GET) {
            $cType = 'application/json';
        } else {
            $cType = null;
        }
        $macToken = $this->_mac->MACToken($method, $url, $cType, $body);
        $ua = Utils::getUserAgent(config('lb.sdk_user_agent'), config('lb.sdk_version'));
        return array(
            'Content-Type'  => $cType,
            'User-Agent'    => $ua,
            'Authorization' => $macToken,
        );
    }
}
