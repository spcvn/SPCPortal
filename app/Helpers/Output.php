<?php
/*
 * Copyright 2016 SPC Vietnam Co., Ltd.
 * All right reserved.
*/

/**
 * @Author: Nguyen Chat Hien
 * @Date:   2017-03-14 17:09:07
 * @Last Modified by:   Nguyen Chat Hien
 * @Last Modified time: 2017-03-15 09:19:40
 */

namespace SPCVN\Helpers;

class Output
{
    static public function __outputNo($values = array()) {

        $values["status"]="NO";
        self::__output($values);
    }

    static public function __outputYes($values = array()) {

        $values["status"]="YES";
        self::__output($values);
    }

    static public function __outputExists($values = array()) {

        $values["status"]="EXISTS";
        self::__output($values);
    }

    static public function __output($res=array()){

        header("Content-type:application/json;charset=utf8");
        echo json_encode($res);
        exit;
    }
}
