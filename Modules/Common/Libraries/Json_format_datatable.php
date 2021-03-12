<?php
namespace Modules\Common\Libraries;
class Json_format_datatable{
    public $btn = '';
    public $properties = array();

    function json_format($data,$fields){
        $json = '{"data":';
        $json .= '[';
        for( $i = 0; $i < count($data); $i++ ){
            if($i>=1){
                $json .= ',';
            }
            $json .=  "[";
            for( $e = 0; $e < count($fields); $e++ ){
                if($e>=1){
                    $json .= ',';
                }
                if( count($this->getTextStyle()) != 0 && array_key_exists($fields[$e],$this->properties)):
                    $json .=$this->Textstyle($this->properties[$fields[$e]],$data[$i][$fields[$e]]);
                else:
                    $json .= '"'.$data[$i][$fields[$e]].'"';
                endif;
            }
            $json .= $this->getButton() != ''?','.$this->getButton():'';
            // $json .= (($TEMP[$i]->ta_received_date == '' or $TEMP[$i]->ta_received_date == "0000-00-00")?'"<a class=\"sign\" href=\"\">Click to Sign</a>"':'"Signed"');
            $json .=  "]";
        }
        $json .=  "]";
        $json .=  '}';
        return $json;
    }

    function Textstyle($style,$text){
        return '"<span class=\"'.$style.'\">'.$text.'</span>"' ;
    }

    function getButton(){
        return $this->btn;
    }

    function setButton($btn){
        $this->btn = $btn;
    }

    function getTextStyle(){
        return $this->properties;
    }

    function setTextStyle($properties){
        $this->properties = $properties;
    }
}
