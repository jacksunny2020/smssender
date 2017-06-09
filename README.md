# smssender
template-based sms send ,default to use aliyun sms service

# pre-condition
config service provider and the config file according to https://github.com/skychf/aliyunmns

# How to install and configurate package

1. install the laravel package 
  composer require "jacksunny/smssender":"dev-master"
  
  please check exist line "minimum-stability": "dev" in composer.json if failed

2. append new service provider file line in the section providers of file app.config
  after appended,it should looks like
   'providers' => [
        Illuminate\Auth\AuthServiceProvider::class,
        ......
        Jacksunny\SmsSender\AliyunSmsSendServiceProvider::class,
    ],
3.  add test code to check if it works

    $sms_template_factory = App::make(\Jacksunny\SmsSender\SmsTemplateFactory::class);
        $params = [
            'receiver_name' => 'Jack',
            'brand_name' => 'Jack Tech',
            'user_name' => 'Lucy',
            'user_mobile' => '13155556215',
            'waybill' => '10166512487',
            'service_tel' => '99952148',
            'brand_name_clone' => 'Jack Tech',
        ];
        $template = $sms_template_factory->getDispatchSmsTemplate();
        $mobile = '13888888888';
        $result = $template->sendSms($mobile, $params);
  
4. please notify me if you got any problem or error on it,thank you!
