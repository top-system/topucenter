<?php

/**
* 检查手机号码格式
* @param $mobile 手机号码
*/
function check_mobile($mobile){
    if(preg_match('/1[34578]\d{9}$/',$mobile))
        return true;
    return false;
}

/**
* 检查固定电话
* @param $mobile
* @return bool
*/
function check_telephone($mobile){
    if(preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/',$mobile))
        return true;
    return false;
}