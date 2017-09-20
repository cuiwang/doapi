<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;

use App\Http\Requests;
use Faker;
use PhpParser\Node\Expr\Cast\Array_;

class TestController extends Controller
{
    static public $supper_type_arr = array(
        'randomFloat' => 3,
        'numberBetween' => 2,
        'longitude' => 2,
        'latitude' => 2,
        'imageUrl' => 2,
        'randomNumber' => 1,
        'paragraphs' => 1,
        'sentences' => 1,
        'paragraph' => 1,
        'sentence' => 1,
        'realText' => 1,
        'words' => 1,
        'text' => 1,
    );

    static public $type_arr = array(
        'randomFloat' => 3,
        'numberBetween' => 2,
        'longitude' => 2,
        'latitude' => 2,
        'imageUrl' => 2,
        'randomNumber' => 1,
        'paragraphs' => 1,
        'sentences' => 1,
        'paragraph' => 1,
        'sentence' => 1,
        'realText' => 1,
        'words' => 1,
        'text' => 1,
        'randomDigit' => 0,
        'randomDigitNotNull' => 0,
        'randomLetter' => 0,
        'word' => 0,
        'name' => 0,
        'state' => 0,
        'city' => 0,
        'streetName' => 0,
        'postcode' => 0,
        'address' => 0,
        'country' => 0,
        'phoneNumber' => 0,
        'catchPhrase' => 0,
        'company' => 0,
        'date' => 0,
        'time' => 0,
        'amPm' => 0,
        'dayOfMonth' => 0,
        'dayOfWeek' => 0,
        'month' => 0,
        'monthName' => 0,
        'year' => 0,
        'century' => 0,
        'email' => 0,
        'userName' => 0,
        'password' => 0,
        'domainName' => 0,
        'url' => 0,
        'slug' => 0,
        'ipv4' => 0,
        'ipv6' => 0,
        'macAddress' => 0,
        'localIpv4' => 0,
        'hexcolor' => 0,
        'rgbcolor' => 0,
        'colorName' => 0,
        'uuid' => 0,
        'boolean' => 0,
        'md5' => 0,
        'sha1' => 0,
        'sha256' => 0);

    //
    public function test503(Request $request, $id)
    {
        return \Response::json([
            'status' => 503,
            'errors' => '服务器503异常',
            'data' => '错误消息支持自定义',
        ]);
    }

    public function test500(Request $request, $id)
    {
        return \Response::json([
            'status' => 500,
            'errors' => '服务器500异常',
            'data' => '错误消息支持自定义',
        ]);
    }

    /**
     * 测试json
     * @param Request $request
     * @param $id
     * @return string
     */
    public function test(Request $request, $id)
    {
        $api = Api::findOrFail($id);

        $type = $api->type;

        if ($type == 'static') {//静态类型
            return $api->json;
        } else {//动态类型
            $back_params = $api->json;
            $back_param_array = explode('&', $back_params);//||||&||||
            $json_array = array();//
            foreach ($back_param_array as $item) {
                $first_part_array = explode('|', $item);
                $fp0 = $first_part_array[0];//类型
                $fp1 = $first_part_array[1];//参数名
                $fp2 = $first_part_array[2];//配置
                if (empty($fp2)) {//默认配置
                    $value = $this->getDataByBackType($fp0);
                    $json_array[$fp1] = $value;
                } else {
                    $value = $this->getCustomDataByUser($fp2);
                    $json_array[$fp1] = $value;
                }
            }
            //存储到数据库
            $api->json_data = json_encode($json_array);
            $api->save();

            return json_encode($json_array);
        }

    }

    public function getDataByBackType($origintype)
    {
        $type = explode(' ', trim($origintype))[0];
        $type = strtolower($type);
        $faker = Faker\Factory::create('zh_CN');
        switch ($type) {
            case 'string':
                return $faker->paragraph;
                break;
            case 'number':
                return $faker->randomDigit;
                break;
            case 'boolean':
                return $faker->boolean;
                break;
            case 'object':
                $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
                return json_decode($json);
                break;
            case 'stringarray':
                return $faker->sentences(10);
                break;
            case 'numberarray':
                return array(
                    $faker->randomNumber, $faker->randomNumber, $faker->randomNumber, $faker->randomNumber, $faker->randomNumber,
                    $faker->randomNumber, $faker->randomNumber, $faker->randomNumber, $faker->randomNumber, $faker->randomNumber,);
                break;
            case 'booleanarray':
                return array(
                    $faker->boolean, $faker->boolean, $faker->boolean, $faker->boolean, $faker->boolean,
                    $faker->boolean, $faker->boolean, $faker->boolean, $faker->boolean, $faker->boolean,);
                break;
            case 'objectarray':
                $json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
                $json_de = json_decode($json);
                return array(
                    $json_de, $json_de, $json_de, $json_de, $json_de, $json_de, $json_de, $json_de, $json_de, $json_de,
                );
                break;
            default:
                return "参数配置错误,请重新填写!";
                break;
        }

    }

    public function getCustomDataByUser($configData)
    {

        //1.判断配置的合法性
        //2.解析配置内容
        //3.生成数据
        // =DO#STRING
        // 1.用#分割,取前两个数组 (完成)
        // 2.第一个数组必须以=DO开头 (完成)
        // 3.普通数据  判断是否包含(),不包含就先匹配支持的类型(支持的类型放入一个数组,看是否在数组中,不在的返回null),再生成数据 (完成)
        // 4.带参数普通数据  去掉所有的空格和其他不合法字符,然后分割括号提取类型,判断是否是支持的类型,匹配括号内的参数,再生成数据 (完成)
        // 6.数组处理
        // 7.对象处理
        $qian = array(" ", "　", "\t", "\n", "\r");
        $conf = str_replace($qian, '', $configData);
        $conf_arr = explode('#', $conf);//=DO #  XXXX

        if (count($conf_arr) != 2 || $conf_arr[0] != "=DO") {//如果不是自定义就原样返回
            return $conf;
        } else {
            $confKey = $conf_arr[1]; // XXXX
            $tag = substr($confKey, 0, 6);
            if ($tag == 'Array[') {//是数组
                if (substr_count($confKey, '[') == 1 && substr_count($confKey, ']') == 1) {//带[]
                    $deal0_arr = explode('[', $confKey);//Array [ _xxx]10
                    $deal1_arr = $deal0_arr[1];//xxx]10
                    $deal_arr = explode(']', $deal1_arr);//_xxx ] 10
                    $target_str = $deal_arr[0];//_xxx
                    $target_num = $deal_arr[1];//10

                    if (is_int(intval($target_num))) {//是整数个
                        $param_array = array();

                        for ($i = 0; $i < $target_num; $i++) {
                            array_push($param_array, $this->dealBaseData($target_str));
                        }

                        return $param_array;

                    } else {
                        return "数组个数错误,请重新填写!";
                    }

                } else {
                    return "数组格式错误,请注意'['和']',暂不支持多嵌套,请重新填写!";
                }
            } else if ($tag == 'Object') {
                if (substr_count($confKey, '{') == 1 && substr_count($confKey, '}') == 1) {//带[]
                    $deal0_arr = explode('{', $confKey);//Object { _xxx}
                    $deal1_arr = $deal0_arr[1];//xxx}
                    $deal2_arr = explode('}', $deal1_arr);//_xxx }
                    $deal3_str = $deal2_arr[0];//_xxx:xxx,_xxx:xxx
                    $target_arr = explode(',', $deal3_str);
                    $param_array = array();
                    foreach ($target_arr as $item) {//xxx:xxx
                        $target = explode(':', $item);
                        $param_array[$target[0]] = $this->dealBaseData($target[1]);
                    }

                    return $param_array;


                } else {
                    return "对象格式错误,请注意'{'和'}',暂不支持多嵌套,请重新填写!";
                }
            } else {
                /*=========普通数据============*/
                $this->dealBaseData($confKey);
            }

        }

    }

    public function dealBaseData($confKey)
    {
        //包含括号
        if (strpos($confKey, '(') !== false && strpos($confKey, ')') !== false) {
            //带括号() 带配置,判断类型是否在可用里面,判断括号里面的内容,用,分割
            $supper_conf = explode('(', $confKey);//TEXT(1,2) TEXT (  1,2)
            $supper_confKey = $supper_conf[0];//TEXT
            if (array_key_exists($supper_confKey, self::$supper_type_arr)) {//存在带参匹配中
                $supper_param = explode(')', $supper_conf[1])[0]; //1,2
                $supper_params = explode(',', $supper_param);
                $supper_params_num = count($supper_params);
                $supper_type = self::$supper_type_arr[$supper_confKey];
                if ($supper_params_num == $supper_type) {//参数个数匹配,匹配数字
                    $faker = Faker\Factory::create('zh_CN');
                    if ($supper_params_num == 3) {
                        if (is_numeric($supper_params[0]) && is_numeric($supper_params[1]) && is_numeric($supper_params[2])) {
                            return $faker->$supper_confKey($supper_params[0], $supper_params[1], $supper_params[2]);
                        } else {
                            return "error2 只支持数字类型,请重新填写!";
                        }

                    } else if ($supper_params_num == 2) {
                        if (is_numeric($supper_params[0]) && is_numeric($supper_params[1])) {
                            return $faker->$supper_confKey($supper_params[0], $supper_params[1]);
                        } else {
                            return "error1 只支持数字类型,请重新填写!";
                        }

                    } else {
                        if (is_numeric($supper_params[0])) {
                            return $faker->$supper_confKey($supper_params[0]);
                        } else {
                            return "error0 只支持数字类型,请重新填写!";
                        }

                    }
                } else {
                    return "参数个数不匹配,请重新填写!";
                }
            } else {//不在匹配中,返回错误信息
                return "error3 您填写的类型不存在,请注意大小写,拼写等!";
            }
        } //不带括号() 不带配置,判断类型是否在可用里面,否则参数错误
        else if (strpos($confKey, '(') === false && strpos($confKey, ')') === false) {
            if (array_key_exists($confKey, self::$type_arr)) {//存在匹配中
                $faker = Faker\Factory::create('zh_CN');
                return $faker->$confKey;
            } else {//不在匹配中,返回错误信息
                return "error4 您填写的类型不存在,请注意大小写,拼写等!";
            }
        } //异常配置
        else {
            return "参数配置错误,请重新填写!";
        }
    }



}
