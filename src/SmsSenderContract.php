<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Jacksunny\SmsSender;

/**
 *
 * @author 施朝阳
 * @date 2017-6-9 9:05:40
 */
interface SmsSenderContract {

    function send(BaseSmsTemplate $template, array $receiver_mobiles, array $params);
}
