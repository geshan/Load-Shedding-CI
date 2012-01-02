<?php
/**
 * this function converts the array into xml format
 * @param $array is array to convert
 * @param $level
 * @return xml
 * 
 * e.g.
 * array('file'=>array(0=>'myfile'),
     	 'user'=>array(0=>array('name'=>'Foo'),
                    1=>array('name'=>'Bar'))
		);
output:
<?xml version="1.0" encoding="ISO-8859-1"?>
<array>
  <file>
    myfile
  </file>
  <user>
    <name>
      Foo
    </name>
  </user>
  <user>
    <name>
      Bar
    </name>
  </user>
</array>  

 */
function array_to_xml($array, $level=1,$heading) {
    $xml = '';
    if ($level==1) {
        $xml .= '<?xml version="1.0" encoding="ISO-8859-1"?>'.
                "\n<".$heading.">\n";
    }
    foreach ($array as $key=>$value) {
        $key = strtolower($key);
        if (is_array($value)) {
            $multi_tags = false;
            foreach($value as $key2=>$value2) {
                if (is_array($value2)) {
                    $xml .= str_repeat("\t",$level)."<$key>\n";
                    $xml .= array_to_xml($value2, $level+1,$heading);
                    $xml .= str_repeat("\t",$level)."</$key>\n";
                    $multi_tags = true;
                } else {
                    if (trim($value2)!='') {
                        if (htmlspecialchars($value2)!=$value2) {
                            $xml .= str_repeat("\t",$level).
                                    "<$key><![CDATA[$value2]]>".
                                    "</$key>\n";
                        } else {
                            $xml .= str_repeat("\t",$level).
                                    "<$key>$value2</$key>\n";
                        }
                    }
                    $multi_tags = true;
                }
            }
            if (!$multi_tags and count($value)>0) {
                $xml .= str_repeat("\t",$level)."<$key>\n";
                $xml .= array_to_xml($value, $level+1,$heading);
                $xml .= str_repeat("\t",$level)."</$key>\n";
            }
        } else {
            if (trim($value)!='') {
                if (htmlspecialchars($value)!=$value) {
                    $xml .= str_repeat("\t",$level)."<$key>".
                            "<![CDATA[$value]]></$key>\n";
                } else {
                    $xml .= str_repeat("\t",$level).
                            "<$key>$value</$key>\n";
                }
            }
        }
    }
    if ($level==1) {
        $xml .= "</$heading>\n";
    }
    return $xml;
}

/**
 * It converts array to json code
 * 
 * E.g.
 * $data = array(
    'success'    =>    "Sweet",
    'array'      =>    array(),
    'numbers'    =>    array(1,2,3),
    'info'       =>    array(
                        'name'    =>    'Binny',
                        'site'    =>    'http://www.openjs.com/'
                 )
);

Output :
{
	"success":"Sweet",
	"empty_array":{},
	"numbers":[1,2,3],
	"info":{
		"name":"Binny",
		"site":"http://www.openjs.com/"
	}
}
 * @param $arr is array
 * @return json code
 */
function array2json($arr) {
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array();
    $is_list = false;

    //Find out if the given array is a numerical array
    $keys = array_keys($arr);
    $max_length = count($arr)-1;
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true;
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
            if($i != $keys[$i]) { //A key fails at position check.
                $is_list = false; //It is an associative array.
                break;
            }
        }
    }

    foreach($arr as $key=>$value) {
        if(is_array($value)) { //Custom handling for arrays
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
        } else {
            $str = '';
            if(!$is_list) $str = '"' . $key . '":';

            //Custom handling for multiple data types
            if(is_numeric($value)) $str .= $value; //Numbers
            elseif($value === false) $str .= 'false'; //The booleans
            elseif($value === true) $str .= 'true';
            else $str .= '"' . addslashes($value) . '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

            $parts[] = $str;
        }
    }
    $json = implode(',',$parts);
    
    if($is_list) return '[' . $json . ']';//Return numerical JSON
    return '{' . $json . '}';//Return associative JSON
} 
?>