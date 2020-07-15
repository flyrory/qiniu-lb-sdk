<h1 align="center"> qiniu-lb-sdk </h1>

<p align="center">基于官方sdk封装.</p>


## Installing

```shell
$ composer require flyrory/qiniu-lb-sdk -vvv
```

## Usage

> 生成配置文件 
```
php artisan vendor:publish
```

> 引入包

```
use Flyrory\QiniuLbSdk\QiniuLb;
```

> 使用简介

```
# 创建流
$result = app(QiniuLb::class)->createStream($streamKey);

# 获取流信息
$result = app(QiniuLb::class)->getStreamInfo($streamKey);

# 获取流列表
$result = app(QiniuLb::class)->getStreamList($streamKey, $limit, $offset);

# 获取正在直播的流列表

$result = app(QiniuLb::class)->getLiveStreamList($streamKey, $limit, $offset);

# 批量查询流直播信息

$result = app(QiniuLb::class)->getBatchLiveStreamList($streamKeys);

# 查询流的直播状态
$result = app(QiniuLb::class)->getLiveStatus($streamKey);

# 禁用流

$result = app(QiniuLb::class)->disableStream($streamKey);

# 启用流

$result = app(QiniuLb::class)->enableStream($streamKey);

# 保存直播数据

$result = app(QiniuLb::class)->saveLive($streamKey, $options);

# 查询推流历史记录

$result = app(QiniuLb::class)->getHistoryActivity($streamKey, $start, $end)；

# 保存直播截图

$result = app(QiniuLb::class)->saveSnapshot($streamKey, $options);

# 更改流的实时转码规格

$result = app(QiniuLb::class)->editConverts($streamKey, $options);

# 生成推流地址

$result = app(QiniuLb::class)->getRtmpPublishUrl($streamKey, $expireAfterSeconds);

# 生成rtmp播放地址

$result = app(QiniuLb::class)->getRtmpPlayUrl($streamKey);

# 生成hls（m3u8）播放地址

$result = app(QiniuLb::class)->getHlsPlayUrl($streamKey);

# 生成hdl(flv) 播放地址

$result = app(QiniuLb::class)->getHdlPlayUrl($streamKey);

# 生成直播封面截图地址

$result = app(QiniuLb::class)->getSnapshotPlayURL($streamKey);

```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/flyrory/qiniu-lb-sdk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/flyrory/qiniu-lb-sdk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT