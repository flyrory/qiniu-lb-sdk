<?php
namespace Flyrory\QiniuLbSdk;

/**
 * 直播流相关操作.
 *
 * @author chenjian@chjgo.com
 *
 * Class QiniuLb
 * @package Flyrory\QiniuLbSdk
 *
 */
class QiniuLb
{
    public $accessKey = '';

    public $secretKey = '';

    public $hubName = '';

    public $mac = null;

    public $client = null;

    public $hub = null;

    public $rtmpPublishUrl = '';

    public $rtmpPlayUrl = '';

    public $hlsPlayUrl = '';

    public $hdlPlayUrl = '';

    public $snapshotPlayUrl = '';

    /**
     * 初始化对象.
     *
     * QiniuLb constructor.
     */
    public function __construct()
    {
        $this->accessKey = config('lb.access_key');
        $this->secretKey = config('lb.secret_key');
        $this->hubName = config('lb.hub_name');
        $this->rtmpPublishUrl = config('lb.publish_live_rtmp_domain');
        $this->rtmpPlayUrl = config('lb.live_rtmp_domain');
        $this->hlsPlayUrl = config('lb.live_hls_domain');
        $this->hdlPlayUrl = config('lb.live_hdl_domain');
        $this->snapshotPlayUrl = config('lb.live_snapshot_play_domain');
        $this->mac = new Mac($this->accessKey, $this->secretKey);
        $this->client = new Client($this->mac);
        $this->hub = $this->client->hub($this->mac);
    }

    /**
     * 创建流.
     *
     * @param $streamKey
     * @return \Exception|Stream
     */
    public function createStream($streamKey)
    {
        return $this->hub->create($streamKey);
    }

    /**
     * 获取流信息.
     *
     * @param $streamKey
     * @return array
     */
    public function getStreamInfo($streamKey)
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->info();
    }

    /**
     * 获取流列表.
     *
     * @param $streamKey
     * @param $limit
     * @param $offset
     * @return array|\Exception|mixed
     *
     */
    public function getStreamList($streamKey, $limit, $offset)
    {
        return $this->hub->listStreams($streamKey, $limit, $offset);
    }

    /**
     * 获取正在直播的流列表.
     *
     * @param $streamKey
     * @param $limit
     * @param $offset
     * @return array|\Exception|mixed
     */
    public function getLiveStreamList($streamKey, $limit, $offset)
    {
        return $this->hub->listLiveStreams($streamKey, $limit, $offset);
    }

    /**
     * 批量查询流直播信息.
     *
     * @param array $streamKeys
     * @return mixed
     */
    public function getBatchLiveStreamList(array $streamKeys)
    {
        return $this->hub->batchLiveStatus($streamKeys);
    }

    /**
     * 查询流的直播状态.
     *
     * @param $streamKey
     * @return mixed
     */
    public function getLiveStatus($streamKey)
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->liveStatus();
    }

    /**
     * 禁用流.
     *
     * @param $streamKey
     * @return mixed
     *
     */
    public function disableStream($streamKey)
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->disable(time() + 120);
    }

    /**
     * 启用流.
     *
     * @param $streamKey
     * @return mixed
     */
    public function enableStream($streamKey)
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->enable();
    }

    /**
     * 保存直播数据.
     *
     * @param $streamKey
     * @param array $options
     * @return mixed
     *
     */
    public function saveLive($streamKey, array $options = [])
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->saveas($options);
    }

    /**
     * 查询推流历史记录.
     *
     * @param $streamKey
     * @param int $start
     * @param int $end
     * @return mixed
     *
     */
    public function getHistoryActivity($streamKey, $start = 0, $end = 0)
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->historyActivity($start, $end);
    }

    /**
     * 保存直播截图.
     *
     * @param $streamKey
     * @param array $options
     * @return mixed
     *
     */
    public function saveSnapshot($streamKey, array $options = [])
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->snapshot($options);
    }

    /**
     * 更改流的实时转码规格.
     *
     * @param $streamKey
     * @param array $options
     * @return mixed
     *
     */
    public function editConverts($streamKey, array $options = [])
    {
        $stream = $this->hub->stream($streamKey);
        return $stream->updateConverts($options);
    }

    /**
     * 生成推流地址(rtmp).
     *
     * @param $streamKey
     * @param $expireAfterSeconds [有效期]
     * @return string
     */
    public function getRtmpPublishUrl($streamKey, $expireAfterSeconds)
    {
        $expire = time() + $expireAfterSeconds;
        $path = sprintf("/%s/%s?e=%d", $this->hubName, $streamKey, $expire);
        $token = $this->accessKey . ":" . Utils::sign($this->secretKey, $path);
        return sprintf("rtmp://%s%s&token=%s", $this->rtmpPublishUrl, $path, $token);
    }

    /**
     * 获取rtmp播放url.
     *
     * @param $streamKey
     * @return string
     */
    public function getRtmpPlayUrl($streamKey)
    {
        return sprintf("rtmp://%s/%s/%s", $this->rtmpPlayUrl, $this->hubName, $streamKey);
    }

    /**
     * 获取hls播放url(m3u8).
     *
     * @param $streamKey
     * @return string
     */
    public function getHlsPlayUrl($streamKey)
    {
        return sprintf("http://%s/%s/%s.m3u8", $this->hlsPlayUrl, $this->hubName, $streamKey);
    }

    /**
     * 获取hdl播放url(flv).
     *
     * @param $streamKey
     * @return string
     */
    public function getHdlPlayUrl($streamKey)
    {
        return sprintf("http://%s/%s/%s.flv", $this->hdlPlayUrl, $this->hubName, $streamKey);
    }

    /**
     * 生成直播封面地址.
     *
     * @param $streamKey
     * @return string
     */
    public function getSnapshotPlayURL($streamKey)
    {
        return sprintf("http://%s/%s/%s.jpg", $this->snapshotPlayUrl, $this->hubName, $streamKey);
    }
}


