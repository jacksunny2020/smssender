<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\SmsSender;

/**
 * Description of SmsTemplate
 *
 * @author 施朝阳
 * @date 2017-6-8 19:02:25
 */
class SmsTemplateFactory {

    protected $sms_sender = null;

    public function __construct(SmsSenderContract $sms_sender) {
        $this->sms_sender = $sms_sender;
    }

    public function getDispatchSmsTemplate(array $params = null) {
        $name = config('aliyunmns.sms_sign_name');
        $code = config('aliyunmns.sms_template_code');
        $param_names = ['receiver_name',
            'brand_name',
            'user_name',
            'user_mobile',
            'waybill',
            'service_tel',
            'brand_name_clone'];
        return new BaseSmsTemplate($this->sms_sender, $code, $name, $param_names, $params);
    }

}
