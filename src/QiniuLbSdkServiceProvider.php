<?php

namespace Flyrory\QiniuLbSdk;

use Illuminate\Support\ServiceProvider;
use Flyrory\QiniuLbSdk\Lib\QiniuLb;

class QiniuLbSdkServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * 引导程序
     *
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        // 发布配置文件 + 可以发布迁移文件
        $this->publishes([
            __DIR__.'/config/lb.php' => config_path('lb.php'),
        ]);

    }

    /**
     * 默认包位置
     *
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // 将给定配置文件合现配置文件接合
        $this->mergeConfigFrom(
            __DIR__.'/config/lb.php', 'lb'
        );

        // 容器绑定
//        $this->app->bind('QiniuLb', function () {
//            return new QiniuLb();
//        });
        $this->app->singleton(QiniuLb::class, function(){
            return new QiniuLb();
        });

        $this->app->alias(QiniuLb::class, 'QiniuLb');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [QiniuLb::class, 'QiniuLb'];
    }
}

