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
    
    function evaluate_formular($formular, $entity, $entity_id = null, $modifier = null)
    {

        // dd(evaluate_formular('area18/unitarea17', ));

       
        $modifierArray = [];
        if($modifier){
            
            $modifierArray = explode(',', $modifier);
           
        }

        // sanitize imput - leave number constants
        // $formular = preg_replace("/[^a-zA-Z0-9+\-.*\/%]/","",$formular);
        

        // convert alphabet to $variabel 
        $formular = preg_replace("/([a-z])+/i", "\$0", $formular); 


        // dd($formular);

        // $pattern = '/\b(?:[a-zA-Z_][a-zA-Z0-9_]*|\+|-|\*|\/|%)\b/';
        // $pattern = '/\b(?:[a-zA-Z_][a-zA-Z0-9_]*|\+|-|\*|\/|%)\b/';
        
        //  also match parenthesis
        // Define the expression pattern with support for parentheses
        $pattern = '/([A-Za-z0-9]+|\d+(\.\d+)?+|[^\w\s])/';


        preg_match_all($pattern, $formular, $matches); 

        // dd($formular, $matches[0]);

        $evaluation = [];
        
        if($entity == 'InvoicePricing'){
            foreach ($matches[0] as $val ) {
                if($pricing = InvoicePricing::where('identifier', $val)->first()) {
                        // preg_match('/\d+(\.\d+)?/', $pricing->value, $match); // this prevents dangerious eval statements in value expressions
                        // array_push($evaluation, $match[0]);
                        // dd($meta);
                    // pick corresponding value from identifier
                    // But here we check if type is formual and evalute it lol - hmmm

                    if($pricing->type == 'formular'){
                        $vall = evaluate_formular($pricing->value, $entity, $entity_id, $modifier );
                        array_push($evaluation, $vall);
                    }else{
                        preg_match('/\d+(\.\d+)?/', $pricing->value, $match); // this prevents dangerious eval statements in value expressions
                        array_push($evaluation, $match[0]);
                    }
                   

                }else{
                        array_push($evaluation, $val);
                } 
            }
        }

        if($entity == 'InvoiceItemMeta'){

            // dd(InvoiceItemMeta::where('identifier', 'PM16')->where('invoice_item_id', $entity_id)->first());
            foreach ($matches[0] as $val ) {
               
                $meta = InvoiceItemMeta::where('identifier', $val)->where('invoice_item_id', $entity_id)->first();

                if($meta = InvoiceItemMeta::where('identifier', $val)->where('invoice_item_id', $entity_id)->first() ) {
                    // dd($meta);
                    // pick corresponding value from identifier
                    // But here we check if type is formual and evalute it lol - hmmm

                    if($meta->type == 'formular'){
                        $vall = evaluate_formular($meta->value, $entity, $entity_id, $meta->modifier );
                        array_push($evaluation, $vall);
                    }else{
                        preg_match('/\d+(\.\d+)?/', $meta->value, $match); // this prevents dangerious eval statements in value expressions
                        array_push($evaluation, $match[0]);
                    }
                   
                }else{
                    // push value to evaluation
                    array_push($evaluation, $val);
                } 
            }
        }

       

        $stringEval = implode("", $evaluation);
       
        // dd($stringEval);
        try {
            $result =  @eval("return " . $stringEval . ";" );
        } catch (\Throwable $th) {
            throw $th;
        }
        
        // dd($result);

        if(in_array('0dp', $modifierArray)){
            // $result = round($result, 0);
        }

        if(in_array('1dp', $modifierArray)){
            // $result = round($result, 1);
        }
        if(in_array('2dp', $modifierArray)){
            // $result = round($result, 2);
        }

        if(in_array('ceil', $modifierArray)){
            $result = ceil($result);
        }

       
        return $result;
        // dd(['formular' => $formular, 'evaluation' => $evaluation, 'stringEval' => $stringEval, 'result'=> $result]);
        

    }
}
