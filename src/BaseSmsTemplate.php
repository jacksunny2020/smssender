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
class BaseSmsTemplate {

    //模板编号
    public $code;
    //模板名称 
    public $name;
    //模板参数名称数组
    public $param_names;
    //模板参数数组key-value
    public $params;
    //消息发送器
    public $sms_sender;

    public function __construct(SmsSenderContract $sms_sender, $code, $name, $param_names, array $params = null) {
        $this->sms_sender = $sms_sender;
        $this->code = $code;
        $this->name = $name;
        $this->param_names = $param_names;
        if (!isset($params) && count($params) > 0) {
            $this->checkApplyParams($params);
        }
    }

    public function checkApplyParams(array $params) {
        if ($this->checkParams($params)) {
            $this->params = $params;
            return true;
        }
        return false;
    }

    public function checkParams(array $params) {
        if (!isset($params)) {
            return false;
        }
        $param_keys = array_keys($params);
        $missing_required_param = false;
        foreach ($this->param_names as $param_name) {
            if (!in_array($param_name, $param_keys)) {
                $missing_required_param = true;
                break;
            }
        }
        if ($missing_required_param) {
            return false;
        }
        return true;
    }

    public function sendSms($mobiles, $params = null) {
        if (!isset($mobiles) || count($mobiles) <= 0) {
            return false;
        }
        $receivers = array();
        if (is_array($mobiles)) {
            $receivers = $mobiles;
        } else {
            $receivers[] = $mobiles;
        }
        if (isset($this->sms_sender)) {
            if (isset($this->params) && $this->checkParams($this->params)) {
                return $this->sms_sender->send($this, $receivers, $this->params);
            } else if (isset($params) && $this->checkParams($params)) {
                return $this->sms_sender->send($this, $receivers, $params);
            } else {
                return $this->sms_sender->send($this, $receivers);
            }
        }
        return false;
    }

}
