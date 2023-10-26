<?php

use App\Models\InvoiceItemMeta;
use App\Models\InvoicePricing;
use App\Models\Product;
use App\Models\ProductMeta;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Modules\Admin\Facades\Voyager::setting($key, $default);
    }
}

if (!function_exists('menu')) {
    function menu($menuName, $type = null, array $options = [])
    {
        return Modules\Admin\Facades\Voyager::model('Menu')->display($menuName, $type, $options);
    }
}

if (!function_exists('voyager_asset')) {
    function voyager_asset($path, $secure = null)
    {
        return route('voyager.voyager_assets') . '?path=' . urlencode($path);
    }
}

if (!function_exists('get_file_name')) {
    function get_file_name($name)
    {
        preg_match('/(_)([0-9])+$/', $name, $matches);
        if (count($matches) == 3) {
            return Illuminate\Support\Str::replaceLast($matches[0], '', $name) . '_' . (intval($matches[2]) + 1);
        } else {
            return $name . '_1';
        }
    }
}


if (!function_exists('evaluate_formular')) {
    function evaluate_formular($formular, $model)
    {
       


        // sanitize imput
        $formular = preg_replace("/[^a-zA-Z0-9+\-.*\/()%]/","",$formular);
        

        // convert alphabet to $variabel 
        $formular = preg_replace("/([a-z])+/i", "\$0", $formular); 


        // $pattern = '/(\$[a-zA-Z_][a-zA-Z0-9_]*|\+|-|\*|\/|%)/';
        $pattern = '/\b(?:[a-zA-Z_][a-zA-Z0-9_]*|\+|-|\*|\/|%)\b/';


        preg_match_all($pattern, $formular, $matches); 

        // dd($formular, $matches[0]);

        $evaluation = [];
        
        if($model == 'InvoicePricing'){
            foreach ($matches[0] as $val ) {
                if($pricing = InvoicePricing::where('identifier', $val)->first()) {
                        preg_match('/\d+(\.\d+)?/', $pricing->value, $match); // this prevents dangerious eval statements in value expressions
                        array_push($evaluation, $match[0]);
                }else{
                        array_push($evaluation, $val);
                } 
            }
        }

        if($model == 'InvoiceItemMeta'){
            foreach ($matches[0] as $val ) {
                if($pricing = InvoiceItemMeta::where('identifier', $val)->first()) {
                        preg_match('/\d+(\.\d+)?/', $pricing->value, $match); // this prevents dangerious eval statements in value expressions
                        array_push($evaluation, $match[0]);
                }else{
                        array_push($evaluation, $val);
                } 
            }
        }

        if($model == 'Product'){
            foreach ($matches[0] as $val ) {
                if($product = ProductMeta::where('identifier', $val)->first()) {
                        preg_match('/\d+(\.\d+)?/', $product->value, $match); // this prevents dangerious eval statements in value expressions
                        array_push($evaluation, $match[0]);
                }else{
                        array_push($evaluation, $val);
                } 
            }
        }

        $stringEval = implode("", $evaluation);
        // dd($stringEval);
        $result =  @eval("return " . $stringEval . ";" );

        return $result;
        // dd(['formular' => $formular, 'evaluation' => $evaluation, 'stringEval' => $stringEval, 'result'=> $result]);


    }
}
