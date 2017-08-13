<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\SmsSender;

use Skychf\AliyunMNS\Sms;

/**
 * Description of SmsSenderAliyumns
 *
 * @author 施朝阳
 * @date 2017-6-9 9:27:20
 */
class SmsSenderAliyumns implements SmsSenderContract {

    public function __construct() {
        
    }

    public function send(BaseSmsTemplate $template, array $receiver_mobiles, array $params = null) {
        $result = true;
        if (!isset($receiver_mobiles)) {
            return false;
        }
        $sms = new Sms();
        foreach ($receiver_mobiles as $receiver) {
            $mobile = $receiver;
            $params['code'] = $template->code;
            $template_args = $params;
            $send_result = $sms->send($mobile, $template_args);
            $result = $result && $send_result;
        }
        return $result;
    }

}
