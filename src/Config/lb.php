<?php

return [
    /*
     * sdk 版本
     */
    'sdk_version' => '1.0.0',

    /*
     * sdk 名称
     */
    'sdk_user_agent' => 'qiniu-lb-sdk',

    /*
     * 访问key
     */
    'access_key' => env('QINIU_LB_ACCESS_KEY'),

    /*
     * 校验key(秘钥)
     */
    'secret_key' => env('QINIU_LB_SECRET_KEY'),

    /*
     * 空间名
     */
    'hub_name' => env('QINIU_LB_HUB_NAME', null),

    /*
     * 推流域名
     */
    'publish_live_rtmp_domain' => env('QINIU_LB_PUBLISH_LIVE_RTMP_DOMAIN', ''),

    /**
     * 播放域名(rtmp) stream
     */
    'live_rtmp_domain' => env('QINIU_LB_LIVE_RTMP_DOMAIN', ''),

    /**
     * 播放域名(hls) stream.m3u8
     */
    'live_hls_domain' => env('QINIU_LB_LIVE_HLS_DOMAIN', ''),

    /**
     * 播放域名(hdl) stream.flv
     */
    'live_hdl_domain' => env('QINIU_LB_LIVE_HDL_DOMAIN', ''),

    /*
     * 直播封面域名.
     */
    'live_snapshot_play_domain' => env('LIVE_SNAPSHOT_PLAY_DOMAIN', ''),

    /*
     * 是否启用https
     */
    'use_https' => env('QINIU_LB_USE_HTTPS', false),

    /*
     * api 域名
     */
    'api_host' => env('QINIU_LB_API_HOST', 'pili.qiniuapi.com'),

    /*
     * api 版本
     */
    'api_version' => env('QINIU_LB_API_VERSION', 'v2'),

    /*
     * 直播连麦api 域名
     */
    'rtcapi_host' => env('QINIU_LB_RTCAPI_HOST', 'http://rtc.qiniuapi.com'),

    /*
     * 连麦api版本 (支持v1 或 v2)
     */
    'rtcapi_version' => env('QINIU_LB_RTCAPI_VERSION', 'v2'),
];
