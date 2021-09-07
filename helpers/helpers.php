<?php

if (!function_exists('ajaxResponse')) {

    /**
     * 公用AJAX响应 json
     * @param int $sta 状态码 ， 1 = 成功，0 = 失败
     * @param string $msg 信息内容
     * @param array $data 数据内容
     * @param array $other 其它字段
     * @param string $custom 定义数据键名
     * @return \Illuminate\Http\JsonResponse
     */
    function ajaxResponse($sta = 0, $msg = 'success', $data = [], array $other = [], $data_field = 'data', $output = "") {
        $data = [
            'status' => $sta,
            'info' => $msg,
            $data_field => !!$data ? $data : new \stdClass(),
        ];
        if (count($other) > 0) {
            $data = array_merge($data, $other);
        }
        if ($output != "") {
            $data["output"] = $output;
        }
        header('content-type:application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    }

}
if (!function_exists('createPhoneStr')) {

    /**
     * 生成手机验证码
     * @param int $length 生成长度
     * @return string
     */
    function createPhoneStr($length) {
        $str = '123456789'; //62个字符 
        $strlen = 62;
        while ($length > $strlen) {
            $str .= $str;
            $strlen += 62;
        }
        $str = str_shuffle($str);
        return substr($str, 0, $length);
    }

}
if (!function_exists("toArr")) {

    /**
     * json转数组
     */
    function toArr($json) {
        return json_decode($json, true);
    }

}
if (!function_exists('toJson')) {

    /**
     * 数组转json
     */
    function toJson($arr) {
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }

}
if (!function_exists("is_weixin_visit")) {

    /**
     * 判断是否微信访问
     * @return bool
     */
    function is_weixin_visit() {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists("js_alert")) {

    /**
     * js弹窗
     * @return bool
     */
    function js_alert($text) {
        return "<script>alert('{$text}');window.history.go(-1);</script>";
    }

}
if (!function_exists("out_trade_no")) {

    /**
     * 生成订单
     * @return type
     */
    function out_trade_no() {
        return date('YmdHis') . mt_rand(111111, 999999) . mt_rand(111111, 999999);
    }

}
if (!function_exists('arrResponse')) {

    /**
     * 公用ARR响应 arr
     * @param int $sta 状态码 ， 1 = 成功，0 = 失败
     * @param string $msg 信息内容
     * @param array $data 数据内容
     * @param array $other 其它字段
     * @param string $custom 定义数据键名
     * @return \Illuminate\Http\JsonResponse
     */
    function arrResponse($sta = 0, $msg = 'success', $data = [], array $other = [], $data_field = 'result') {
        $data = [
            'sta' => $sta,
            'msg' => $msg,
            $data_field => !!$data ? $data : new \stdClass(),
        ];
        if (count($other) > 0) {
            $data = array_merge($data, $other);
        }
        return $data;
    }

}
if (!function_exists('phone_str_ireplace')) {

    /**
     * 手机号码替换 ****
     * @param type $phone
     * @return type
     */
    function phone_str_ireplace($phone) {
        if (preg_match("/^1[345678]{1}\d{9}$/", $phone)) {
            $pattern = "/(\d{3})\d\d(\d{2})/";
            $replacement = "\$1****\$3";
            $phone = preg_replace($pattern, $replacement, $phone);
        }
        return $phone;
    }

}
if (!function_exists('jdump')) {

    /**
     * 打印
     */
    function jdump() {
        $param = func_get_args();
        foreach ($param as $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
    }

}
if (!function_exists('dd')) {

    /**
     * 打印结束
     */
    function dd() {
        $param = func_get_args();
        foreach ($param as $value) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
        }
        die;
    }

}
if (!function_exists('noDebugInfo')) {

    /**
     * 关闭debug
     * @param type $arr
     * @return type
     */
    function noDebugInfo() {
        C('SHOW_RUN_TIME', false);
        C('SHOW_PAGE_TRACE', false);
        C('APP_STATUS', "");
        C('TMPL_CACHE_ON', true);
        C('TMPL_CACHE_TIME', 0);
    }

}
if (!function_exists('yesDebugInfo')) {

    /**
     * 开启debug
     * @param type $arr
     * @return type
     */
    function yesDebugInfo() {
        C('SHOW_RUN_TIME', true);
        C('SHOW_PAGE_TRACE', true);
        C('APP_STATUS', "debug");
        C('TMPL_CACHE_ON', false);
        C('TMPL_CACHE_TIME', 10);
    }

}
if (!function_exists('where_str')) {

    /**
     * 查询数组转字符串
     * @param type $arr
     * @return type
     */
    function where_str($arr, $str = "") {
        $where = [];
        foreach ($arr as $key => $value) {
            $where[] = "{$key}={$value}";
        }
        $where_str = implode(' AND ', $where);
        if ($str != "") {
            return $where_str . ' AND ' . $str;
        } else {
            return $where_str;
        }
    }

}
if (!function_exists('check_login')) {

    /**
     * 检查登录
     * @param array $user
     * @return json|int
     */
    function check_login($user) {
        if (!isset($user["id"])) {
            return ajaxResponse(401, "请登录");
        }
        return $user["id"];
    }

}
if (!function_exists('check_vip')) {

    /**
     * 检查是否vip
     * @param array $user
     * @return int
     */
    function check_vip($user) {
        if (isset($user["user_type"]) && $user["user_type"] == 2) {
            return 1;
        }
        return 0;
    }

}
if (!function_exists('getIp')) {

    /**
     * 获取用户真实ip
     * @return type
     */
    function getIp() {
        $onlineip = '';
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $onlineip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $onlineip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $onlineip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }

}
if (!function_exists('get_config')) {

    /**
     * 获取数据库SiteInfo数据
     * @return type
     */
    function get_config($name = "") {
        $base = new \Common\Controller\BaseController();
        $conf = $base->ClassData('SiteInfo');
        if ($name == "") {
            return $conf;
        } else {
            $_name = explode('.', $name);
            foreach ($_name as $value) {
                if ($conf != "") {
                    $conf = isset($conf[$value]) ? $conf[$value] : "";
                }
            }
            return $conf;
        }
    }

}
if (!function_exists('isset_and_noempty')) {

    /**
     * 存在而且不为空
     * @return type
     */
    function isset_and_noempty($key) {
        if (isset($key) && !empty(trim($key)) && ($key != "null") && ($key != null)) {
            return 1;
        }
        if ($key === 0 || $key === "0") {
            return 1;
        }
        return 0;
    }

}
if (!function_exists('check_isset_and_noempty')) {

    /**
     * 检查存在而且不为空
     * @return type
     */
    function check_isset_and_noempty($key, $msg = "") {
        if (isset_and_noempty($key) == 0) {
            return ajaxResponse(0, $msg);
        }
        return trim($key);
    }

}

if (!function_exists('is_phone')) {

    /**
     * 验证手机
     * @param type $phone
     * @return type
     */
    function is_phone($phone) {
        if (preg_match("/^1[345678]{1}\d{9}$/", $phone)) {
            return 1;
        }
        return 0;
    }

}
if (!function_exists('check_is_phone')) {

    /**
     * 检查验证手机
     * @return type
     */
    function check_is_phone($key, $msg = "") {
        if (is_phone($key) == 0) {
            return ajaxResponse(0, $msg);
        }
        return trim($key);
    }

}
if (!function_exists('del_null_arr')) {

    /**
     * 去除空数组
     * @param type $data_array
     * @return type
     */
    function del_null_arr($data_array) {

        foreach ($data_array as $key => $value) {
            if (empty($value) && $value != '0') {
                unset($data_array[$key]);
            }
        }

        return $data_array;
    }

}
if (!function_exists('createToken')) {

    /**
     * 生成token
     * @param array $data
     * @return type
     */
    function createToken($data) {
        $payload = [
            'iss' => $_SERVER['HTTP_HOST'], //签发者
            'aud' => $_SERVER['HTTP_HOST'], //jwt所面向的用户
            "iat" => time(), //签发时间
            "nbf" => time(), //在什么时间之后该jwt才可用
            "exp" => time() + C('JWT.exp'), //有效期
            "data" => $data
        ];
        $token = \Firebase\JWT\JWT::encode($payload, C('JWT.key')); //生成token
        return $token;
    }

}
if (!function_exists('carbon')) {

    /**
     * carbon class
     * @return type
     */
    function carbon() {
        $Carbon = new \Carbon\Carbon();
        return $Carbon;
    }

}
if (!function_exists('now')) {

    /**
     * 当前时间
     * @return type
     */
    function now() {
        return carbon()->now();
    }

}
if (!function_exists('strF')) {

    /**
     * 用某个符号隔开的字符串
     * @return type
     */
    function strF($string = "", $F = ",") {
        $str = trim($string, ",");
        return explode($F, $str);
    }

}
if (!function_exists('createNoncestr')) {

    /**
     * 产生随机字符串，不长于32位
     * @return type
     */
    function createNoncestr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

}
if (!function_exists('arrayToXml')) {

    /**
     * 数组转xml
     * @return type
     */
    function arrayToXml($arr) {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

}
if (!function_exists('postXmlCurl')) {

    /**
     * 作用：以post方式提交xml到对应的接口url
     */
    function postXmlCurl($xml, $url, $second = 30) {
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error" . "<br>";
            curl_close($ch);
            return false;
        }
    }

}
if (!function_exists('xmlToArray')) {

    /**
     * 作用：将xml转为array
     */
    function xmlToArray($xml) {
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

}
if (!function_exists('getSign')) {

    /**
     * 作用：格式化参数，签名过程需要使用
     */
    function formatBizQueryParaMap($paraMap, $urlencode) {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode)
                $v = urlencode($v);
            $buff .= $k . "=" . $v . "&";
        }
        if (strlen($buff) > 0)
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        return $reqPar;
    }

}
if (!function_exists('getSign')) {

    /**
     * 生成签名
     */
    function getSign($Obj, $config) {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = formatBizQueryParaMap($Parameters, false);
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $config['api_key'];
        //签名步骤三：MD5加密
        $String = md5($String);
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        return $result_;
    }

}
if (!function_exists('xml_to_data')) {

    /**
     * xml实体
     */
    function xml_to_data($xml) {
        if (!$xml)
            return false;
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $data;
    }

}
if (!function_exists('getTree')) {

    function getTree($array, $pid = 0) {
        $tree = array();
        foreach ($array as $key => $value) {
            if ($value['pid'] == $pid) {
                $value['children'] = getTree($array, $value['id']);
                $tree[] = $value;
            }
        }
        return $tree;
    }

}
if (!function_exists('fuText')) {

    /**
     * 富文本文字处理
     * @param type $str
     * @return type
     */
    function fuText($str) {
        $str = stripslashes($str);
        $str = preg_replace("/&amp;/", "&", $str);
        $str = preg_replace("/&quot;/", "\"", $str);
        $str = preg_replace("/&lt;/", "<", $str);
        $str = preg_replace("/&gt;/", ">", $str);
        return $str;
    }

}
if (!function_exists('stringSign')) {

    /**
     * 字典排序字符串签名
     * @param Array $data 排序数组
     * @return String 签名
     */
    function stringSign($data, $key) {
        $tmp = [];
        foreach ($data as $k => $v) {
            $tmp[$k] = "{$k}={$v}";
        }
        ksort($tmp);
        $stringA = implode("&", $tmp);
        $stringSignTemp = $stringA . '&key=' . $key;
        $sign = strtoupper(md5($stringSignTemp));
        return $sign;
    }

}
if (!function_exists('cors')) {

    /**
     * 跨域
     * @return type
     */
    function cors() {
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:*'); //表示只允许POST请求
        header("Access-Control-Allow-Headers: Referer,Origin, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie,Token");
    }

}
if (!function_exists('unlinks')) {

    /**
     * 删除文件夹下文件
     * @param type $dir 文件夹路径
     * @param type $remain 保留最新多少文件
     * @return int 删除文件数量
     */
    function unlinks($dir, $remain = 3) {
        $handler = opendir($dir);
        $file = [];
        while (($filename = readdir($handler)) !== false) {
            //略过linux目录的名字为'.'和‘..'的文件
            if ($filename != "." && $filename != "..") {
                //输出文件名
                $filename_file = $dir . "/" . $filename;
                $time = filectime($filename_file);
                $file[$time] = $filename_file;
            }
        }
        closedir($handler);
        krsort($file); //按照文件创建时间倒序
        $re = 0;
        if (count($file) > $remain) {
            $file = array_values($file);
            foreach ($file as $k => $value) {
                $index = $k + 1;
                if ($index > $remain) {
                    $r = unlink($value);
                    $re = !!$r ? $re + 1 : $re;
                }
            }
        }
        return $re;
    }

}
if (!function_exists('jahem_log')) {

    /**
     * 日志
     * @param type $msg
     * @param type $type
     * @param string $filename
     * @param string $files
     */
    function jahem_log($msg, $type = "info", $filename = '', $files = "") {

        $type_text = [
            "info" => "【INFO】",
            "debug" => "【DEBUG】",
            "error" => "【ERROR】",
        ];
        if ($filename == "") {
            $filename = "log_" . date("Ymd") . ".log";
        }
        if ($files == "") {
            $files = __DIR__ . "/log";
        }
//        unlinks($files, 30);
        if (!file_exists($files . "/" . $filename)) {
            mkdir(iconv('UTF-8', 'GBK', $files), 0777, true);
        } else {
            $byte = filesize($files . "/" . $filename);
            if ($byte > (1024 * 1024 * 5)) {
                $filename = "log_" . date("YmdH") . ".log";
                return jahem_log($msg, $type, $filename, $files);
            }
        }
        if (!is_string($msg)) {
            $msg = json_encode($msg, JSON_UNESCAPED_UNICODE);
        }
        $_type = isset($type_text[$type]) ? $type_text[$type] : $type_text["info"];
        $_date = "[" . date("H:i:s", time()) . "]";
        $fp = fopen($files . '/' . $filename, 'a+');
        flock($fp, LOCK_EX + LOCK_NB);
        fwrite($fp, $_type . $_date . $msg . PHP_EOL);
        flock($fp, LOCK_UN);
        fclose($fp);
    }

}
if (!function_exists('get_default')) {

    /**
     * 获取默认
     * @return type
     */
    function get_default($field, $default) {
        $re = [];
        foreach ($field as $k => $value) {
            $re[$value] = isset($default[$k]) ? $default[$k] : "";
        }
        return $re;
    }

}
if (!function_exists('look_f_posts_time')) {

    /**
     * 获取查看朋友动态时间
     * @return type
     */
    function look_f_posts_time($uid, $edit = 1) {
        $time = D("look_f_posts_time")->where(["uid" => $uid])->getField("time");
        if ($edit == 0) {
            if (!!$time) {
                D("look_f_posts_time")->where(["uid" => $uid])->save(["time" => time()]);
            } else {
                D("look_f_posts_time")->add(["time" => time(), "uid" => $uid]);
            }
        }
        if (!$time) {
            $time = now()->subYears(10)->timestamp;
        }
        return $time;
    }

}
if (!function_exists('user')) {

    /**
     * 获取用户
     * @return type
     */
    function user($uid) {
        return D("member")->find($uid);
    }

}
if (!function_exists('page')) {

    /**
     * 分页
     * @param type $p
     * @param type $row
     * @return type
     */
    function page($p = 1, $row = 50) {
        return (($p - 1) * $row) . "," . $row;
    }

}
if (!function_exists('total_page')) {

    /**
     * 总页数
     * @param type $count
     * @param type $row
     * @return type
     */
    function total_page($count, $row = 50) {
        return ceil($count / $row);
    }

}
if (!function_exists('number_chinese')) {

    /**
     * 金额转换
     * @param type $number
     * @return string
     */
    function number_chinese($number) {
        $length = strlen($number);  //数字长度
        if ($length > 8) { //亿单位
            $str = substr_replace(floor($number * 0.0000001), '.', -1, 0) . "亿";
        } elseif ($length > 4) { //万单位
            //截取前俩为
            $str = floor($number * 0.001) * 0.1 . "万";
        } else {
            return $number;
        }
        return $str;
    }

}
if (!function_exists('check_isset_and_noempty_mistake')) {

    /**
     * 检查存在而且不为空,空返回空
     * @return type
     */
    function check_isset_and_noempty_mistake($key, $msg = "") {
        if (isset_and_noempty($key) == 0) {
            return "";
        }
        return trim($key);
    }

}
if (!function_exists('arraySort')) {

    /**
     * 二维数组排序
     * @param type $array
     * @param type $keys
     * @param type $sort
     * @return type
     */
    function arraySort($array, $keys, $sort = 'asc') {
        $newArr = $valArr = array();
        foreach ($array as $key => $value) {
            $valArr[$key] = $value[$keys];
        }
        ($sort == 'asc') ? asort($valArr) : arsort($valArr);
        reset($valArr);
        foreach ($valArr as $key => $value) {
            $newArr[$key] = $array[$key];
        }
        return $newArr;
    }

}
if (!function_exists('jcreate_folders')) {

    function jcreate_folders($dir) {
        return is_dir($dir) or ( jcreate_folders(dirname($dir)) and mkdir(iconv("UTF-8", "GBK", $dir), 0777, true));
    }

}
if (!function_exists('importExecl')) {

    function importExecl($file = '', $sheet = 0) {
        $file = iconv("utf-8", "gb2312", $file);   //转码
        if (empty($file) OR ! file_exists($file)) {
            die('file not exists!');
        }
        import('Common.Library.PHPExcel', '', '.php');
        $objRead = new \PHPExcel_Reader_Excel2007();   //建立reader对象
        if (!$objRead->canRead($file)) {
            $objRead = new \PHPExcel_Reader_Excel5();
            if (!$objRead->canRead($file)) {
                die('No Excel!');
            }
        }

        $cellName = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV',
            'AW', 'AX', 'AY', 'AZ'
        );

        $obj = $objRead->load($file);  //建立excel对象
        $currSheet = $obj->getSheet($sheet);   //获取指定的sheet表
        $columnH = $currSheet->getHighestColumn();   //取得最大的列号
        $columnCnt = array_search($columnH, $cellName);
        $rowCnt = $currSheet->getHighestRow();   //获取总行数

        $data = array();
        for ($_row = 1; $_row <= $rowCnt; $_row++) {  //读取内容
            for ($_column = 0; $_column <= $columnCnt; $_column++) {
                $cellId = $cellName[$_column] . $_row;
                $cellValue = $currSheet->getCell($cellId)->getValue();
                //$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值
                if (is_object($cellValue))
                    $cellValue = $cellValue->__toString();
//                if ($cellValue instanceof PHPExcel_RichText) {
//                    $cellValue = $cellValue->__toString();
//                }
                $data[$_row][$cellName[$_column]] = $cellValue;
            }
//            break;
        }

        return $data;
    }

}
if (!function_exists('jfile_copy')) {

    function jfile_copy($file) {
        //判断是否存在日期文件
        $filename = "/Uploads/imgs/" . date("Ymd");
        if (!file_exists("." . $filename)) {
            jcreate_folders("." . $filename);
        }
        //获取后缀
        $ary = explode('.', $file['name']);
        $su = end($ary);
        //文件名
        $filenames = $filename . "/" . time() . rand(1, 10000) . "." . $su;
        move_uploaded_file($file['tmp_name'], "." . $filenames);

        return $filenames;
    }

}
if (!function_exists('platform_id')) {

    /**
     * 独立平台id
     * @param type $uid
     * @return int
     */
    function platform_id($uid) {
        $user = D("member")->where(["id" => $uid])->find();
        if (!$user) {
            //用户不存在
            return 0;
        }
        if (!$user["platform_id"]) {
            //没有属任何平台
            return 0;
        } else {
            $is_private = D("platform")->where(["id" => $user["platform_id"]])->getField("is_private");
            return !!$is_private ? $user["platform_id"] : 0;
        }
    }

}
if (!function_exists('jahem_where')) {

    /**
     * where条件处理
     * @param type $where
     * @param type $platform_where
     */
    function jahem_where($where,$platform_where = [],$prefix = "") {
        if(!empty($platform_where)){
            $type = gettype($where);
            if($type == "string"){
                $key = key($platform_where);
                $value = $platform_where[$key];
                $where = $where . " AND ({$prefix}{$key} = {$value})";
            }else{
                $where = array_merge($where,$platform_where);
            }
        }
        return $where;
    }

}
