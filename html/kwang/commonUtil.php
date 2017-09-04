<?php

function couchDB_Get($path)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:5984/' . $path);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
            'Accept: */*'
    ));
    $response = curl_exec($ch);
    $doc = json_decode($response);
    return $doc;
}

/*
    Simple json to template render using Mustache syntax
    - json dot notation
*/
function json_render($template,$data)
{
    $m = new Mustache_Engine;
    return $m->render($template,$data);
}

class StudioRenderPrefixHandler 
{
    var $prefixMapper = array(
            "URL" => "##SRC URL=\"http://s3.com/xxxx/yyyy/{{value}}.html\" ##",
    );
    
    function __construct($prefixMapper = NULL)
    {		
        if(is_null($prefixMapper) == false){
            $this->prefixMapper = $prefixMapper;
        }
    }		
    
    function onRenderPrefix($prefix,$value)
    {
        //wPrint("prefix=$prefix\n");
        $valueResult = $this->valueFilter($value);
        $mapResult = $this->prefixMapper[$prefix];
        $mapResult = str_replace("{{value}}", "$valueResult", $mapResult);
        //wPrint("$mapResult\n");
        return $mapResult;
    }
    
    function valueFilter($value)
    {
        return $value;
    }
}


/*
    Support
    - {{jsonDotNotation}}
    - {{PREFIX-jsonDotNotation}} with StudioRenderPrefixHandler
*/
function studio_render($template,$data,$handler)
{
    // pre render URL case
    preg_match_all('/\{{([^-\}]+)-(.*?)\}}/', $template, $matches, PREG_PATTERN_ORDER);
    for($i = 0;$i<count($matches[0]);$i++){
        $value0 = $matches[0][$i];
        $value1 = $matches[1][$i];
        $value2 = $matches[2][$i];
        $result = $handler->onRenderPrefix($value1,$value2);
        $template = str_replace("$value0", "$result", $template);
    }
    //wPrint("$template\n");
    return json_render($template,$data);
}

function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

//$func = function($name,$value)
//{
//    print "$name => $value<br>";
//};
//
//IterateObject($obj,"obj",$func);
function IterateObject($obj,$parent,$func)
{
    if (is_array($obj) || is_object($obj))
    {
        if(isAssoc($obj)){
            foreach($obj as $key => $value) {
                if(is_array($value)){
                    if(isAssoc($value)){
                        $prefix = ".$key";
                        IterateObject($value,"$parent$prefix",$func);
                    }else{
                        for($i=0;$i<count($value);$i++){
                            $prefix = ".$key"."[".$i."]";
                            IterateObject($value[$i],"$parent$prefix",$func);
                        }
                    }
                }else{
                     $func("$parent.$key",$value);
                }
            }
        }else{
            for($i=0;$i<count($value);$i++){
                $prefix = "[".$i."]";
                IterateObject($value[$i],"$parent$prefix",$func);
            }
        }
    }else{
        $func("$parent",$obj);    
    }
};

function wPrint($data)
{
    echo nl2br($data);
}

function wPrintLine($data)
{
    echo nl2br($data . "\n");
}


?>