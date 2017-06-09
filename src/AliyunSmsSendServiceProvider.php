<?php

namespace Jacksunny\SmsSender;

use Illuminate\Support\ServiceProvider;

class AliyunSmsSendServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //默认设置为使用阿里云短信发送，如果需要使用其他短信发送机制请修改以下代码
        $this->app->singleton('Jacksunny\SmsSender\SmsSenderContract', function ($app) {
            return new SmsSenderAliyumns();
        });
        //因为 SmsTemplateFactory 依赖于 SmsSenderContract 所以必须放在他们之后初始化
        $this->app->singleton('Jacksunny\SmsSender\SmsTemplateFactory', function($app) {
            $sms_sender = $this->app->make('Jacksunny\SmsSender\SmsSenderContract');
            return new SmsTemplateFactory($sms_sender);
        });
    }

}
