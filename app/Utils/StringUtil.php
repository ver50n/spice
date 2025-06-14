<?php

namespace App\Utils;

class StringUtil
{

    public static function convertCamelToSnakeCase($str)
    {
        return strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $str));
    }
    
    public static function convertSnakeToCamelCase($str)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
    }
    
    public static function replaceTemplateVariable($string, $params, $wrapper = '%')
    {
        foreach($params as $param => $value) {
            if(!is_string($value))
                continue;
                
            $search = $wrapper.$param.$wrapper;
            $string = str_replace($search, $value, $string);
        }
        return $string;
    }

    public static function replacePhpFunction($string)
    {
        preg_match_all("/\[([^\]]*)\]/", $string, $matches);
        
        $funcRes = date($matches[1][0]);
        $string = str_replace($matches[0][0], $funcRes, $string);

        return $string;
    }

    public static function uniqueSlug($value = null)
    {
        $value = ($value) ? $value : env('HASH_KEY');
        $conversion = unpack('H*', $value);
        return round(microtime(true) * 1000).$conversion[1];
    }

    public static function encrypt($value)
    {
        return \Crypt::encrypt($value);
    }

    public static function decrypt($value)
    {
        return \Crypt::decrypt($value);
    }

    public static function getKojinTozanUrl()
    {
        $url = env('KOJIN_TOZAN_BASE_URL');
        $locale = \Session::get('locale');
        $organization = \Auth::guard('web')->user()->place->organization;

        switch($locale) {
            case 'en':
                $url .= env('KOJIN_TOZAN_EN_LANG_PATH').'/';
                break;
            case 'id':
                $url .= env('KOJIN_TOZAN_ID_LANG_PATH').'/';
                break;
        }

        switch($organization) {
            case 'BDI':
                $url .= env('KOJIN_TOZAN_BDI_PATH');
                break;
            case 'VISISTACARITRA':
                $url .= env('KOJIN_TOZAN_VISISTA_PATH');
                break;
            case 'PERMATA':
                $url .= env('KOJIN_TOZAN_PERMATA_PATH');
                break;
        }
        
        return $url;
    }
}