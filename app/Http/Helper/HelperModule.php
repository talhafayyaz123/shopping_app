<?php

namespace App\Http\Helper;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
/* @author <abdullah@redsignal.biz> */
class HelperModule
{
    /**
     * @param $type
     * @param $message
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    public static function jsonResponse($type, $message = false, $data = null)
    {
        $response['status'] = $type;
        $response['message'] = $message;
        $response['data'] = $data;

        return collect($response);
    }

    public static function jsonDataTableResponse($type, $message=false, $data =null , $draw, $recordsTotal, $recordsFiltered)
    {
        $response['isResponse'] = $type;
        if($message)
            $response['message'] = $message;
        $response['draw'] = $draw;
        $response['recordsTotal'] = $recordsTotal;
        $response['recordsFiltered'] = $recordsFiltered;
        $response['data'] = $data;

        return collect( $response );
    }

    /**
     * @param $type
     * @param $message
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    public static function jsonApiResponse($type, $message = null, $data = null)
    {
        $response['status'] = $type;
        $response['message'] = $message;
        $response['data'] = $data;

        return collect($response);
    }

    /**
     * Determine if the value is a social security number
     *
     * @param  $attribute
     * @param  $value
     * @param  $parameters
     *
     * @return bool
     */
    //public static function validateSsn($attribute, $value, $parameters)
    public static function validateSsn($value)
    {
        return strlen(preg_replace('/\D/', '', $value)) == 9;
    }
    /**
     * @return string
     */
    static public function generateToken()
    {
        return hash_hmac('sha256', str_random(10), config('app.key'));
    }

    /**
     * @return mixed
     */
    static public function PageTitle()
    {
        $path = \Request::path();
        $path = str_replace('/','.',$path);

        if(config('titles.'.$path))
            return config('titles.'.$path);

        return config('titles.default');
    }

    /**
     * @param $data
     * @return string
     */
    static public function HashMd5($data)
    {
        $params = [];
        foreach ($data as $key => $val){
            $params[$key] = md5($val);
        }
        return urlencode(http_build_query($params));
    }

    static public function HashMd5Salt($data)
    {
        $secKey = static::secretKey();
        $params = [];
        foreach ($data as $key => $val){
            $params[$key] = md5($secKey.$val);
        }
        //dd(http_build_query($params));
        //return urlencode(http_build_query($params));
        return http_build_query($params);
    }

    /**
     * @param $data
     * @return string
     */
    static public function QRCode($data)
    {
        $url = self::HashMd5($data);
        $image = "http://chart.apis.google.com/chart?cht=qr&chs=200x200&chld=H|0&chl=".$url;
        return '<img src='.$image.' alt="QR Code" />';
    }

    /**
     * @return string
     * Return Secret Key Being used in Salt for sms & E-mail link to ticket
     * Created by Abdullah Butt
     */
    static public function secretKey()
    {
        return "(*&JKHUKG(&*H";
    }

    /**
     * @param $input
     * @return string
     * Return Order and Ticket id with 6 digits code by adding leading zeroes to make length of Order or Ticket 6 digits.... e.g order id 6 will return 000006
     * Created by Abdullah Butt
     */
    static public function sixDigitCode($input)
    {
        return sprintf('%06d', $input);
        //$order = sprintf('%06d', $input);
        //$abc = str_pad($input, 6, '0', STR_PAD_LEFT);

    }


    /**
     * @param $input
     * @return float|string
     * Convert all Cart Values to 2 digit. 12.00 to 12 & 12.1 to 12.10 & 12.555 to 12.56
     * Created by Abdullah Butt
     */
    static public function roundToDecimal($input)
    {
        $input = round($input,2); // round converts 12.00 to 12 & 12.10 to 12.1 & 12.555 to 12.56
        //check if the number has decimal(.)
        if(strpos($input,".") !== false)
            $input = number_format($input,2); // number_format($input,2) converts 12.1 to 12.10 & 12.555 to 12.56 & I'm not passing 12 because it will convert it to 12.00
        $input = str_replace(',', '', $input); // If value has a comma like 1,999.98 , remove the comma

        return $input;
    }

    /**
     * @param $input
     * @return string
     */
    static public function makeSha256Hash($input)
    {
        $hash = hash('sha256', $input);
        return $hash;
    }


    /**
     * @param $string
     * @return mixed
     */
    public static function removeDashesAndLeadingZeroFromString($string)
    {
        $string = ltrim($string, '0');
        return str_replace("-","",$string);
    }

    /**
     * @param $attribute
     * @param $value
     * @return false|int
     */
    public static function latitudeLongitudePasses($attribute, $value)
    {
        return preg_match("/^[-]?((([0-8]?[0-9])(\.(\d{1,8}))?)|(90(\.0+)?)),\s?[-]?((((1[0-7][0-9])|([0-9]?[0-9]))(\.(\d{1,8}))?)|180(\.0+)?)$/", $value);
    }

    public static function convert_from_latin1_to_utf8_recursively($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        } elseif (is_array($dat)) {
            $ret = [];
            foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

            return $ret;
        } elseif (is_object($dat)) {
            foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);
            dd($dat);
            return $dat;
        } else {
            return $dat;
        }
    }

    public static function utf8ize( $mixed ) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }
}
