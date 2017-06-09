# smssender
template-based sms send plugin for laravel 5.4+,default to use aliyun sms service

# pre-condition
config service provider and the config file according to https://github.com/skychf/aliyunmns

# How to install and configurate package

1. install the laravel package 
  composer require "jacksunny/smssender":"dev-master"
  
  please check exist line "minimum-stability": "dev" in composer.json if failed
  
2. prepare the config file required by the project skychf/aliyumns ,which name is  config/aliyunmns.php

  return [
      'end_point' => env('ALIYUN_END_POINT', 'http://locationid.mns.cn-hangzhou.aliyuncs.com/'),
      'access_id' => env('ALIYUN_ACCESS_ID', 'APPKEYAPPKEY'),
      'access_key' => env('ALIYUN_ACCESS_KEY', 'APPSECRETAPPSECRETAPPSECRETAPPSECRET'),
      'topic_name' => env('ALIYUN_TOPIC_NAME', 'sms.topic-cn-hangzhou'),
      'sms_sign_name' => env('ALIYUN_SMS_SIGN_NAME', 'SMSNAMESMSNAME'),
      'sms_template_code' => env('ALIYUN_SMS_TEMPLATE_CODE', 'SMSCODESMSCODE')
  ];


3. append new service provider file line in the section providers of file app.config
  after appended,it should looks like
   'providers' => [
        Illuminate\Auth\AuthServiceProvider::class,
        ......
        Jacksunny\SmsSender\AliyunSmsSendServiceProvider::class,
    ],
4.  add test code to check if it works

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
  
5. please notify me if you got any problem or error on it,thank you!
