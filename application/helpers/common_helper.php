<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('print_r_die'))
{
    function print_r_die($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die();
    }   
}

if( ! function_exists('create_index_html')){
    
    function create_index_html($folder) {
        $content = "<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>";
        $folder = $folder.'/index.html';
        $fp = fopen($folder , 'w');
        fwrite($fp , $content);
        fclose($fp);
    }
}

if( ! function_exists('convert_gender')){
    
    function convert_gender($gender) {
        if($gender){
            if($gender == "M"){
                return "Male";
            }else{
                return "Female";
            }
        }

        return false;
    }
}


if( ! function_exists('date_of_birth')){
    
    function date_of_birth($d , $m , $y) {
        if($d AND $m AND $y){
            return $d.' '.DateTime::createFromFormat('!m', $m)->format("F").' '.$y;
        }else{
            return false;
        }
    }
}

if( ! function_exists('register_details')){
    
    function register_details($data) {
        $tmp = "<ul class='register_details_ul'>";
        $time = uniqid();

        if($data->select_user_for_next_sale){
            $tmp .= "<li>Select user for next sale</li>";
        }else{
            $tmp .= "<li>Don't select user for next sale</li>";
        }

        if($data->email_receipt){
            $tmp .= '<div class="collapse" id="_'.$time.'"><li>Email Receipt</li>';
        }else{
            $tmp .= '<div class="collapse" id="_'.$time.'"><li>Dont Email Receipt</li>';
        }

        if($data->print_receipt){
            $tmp .= "<li>Print Receipt</li>";
        }else{
            $tmp .= "<li>Don't Print Receipt</li>";
        }

        if($data->ask_for_a_note == 0){
            $tmp .= "<li>Never ask for note</li>";
        }else if($data->ask_for_a_note == 1){
            $tmp .= "<li>Ask for note on save/Layby/Account/Return</li>";
        }else if($data->ask_for_a_note == 2){
            $tmp .= "<li>Ask for note on all sales</li>";
        }

        if($data->print_note_on_receipt){
            $tmp .= "<li>Print note on Receipt</li>";
        }else{
            $tmp .= "<li>Don't Print note on Receipt</li>";
        }

        if($data->show_discount_on_receipt){
            $tmp .= "<li>Show discount on Receipt</li></div>";
        }else{
            $tmp .= "<li>Don't show discount on Receipt</li></div>";
        }
         $tmp .= '<li><a class="link-style read-more" role="button" data-toggle="collapse" href="#_'.$time.'" aria-expanded="false" aria-controls="collapseExample">More Details</a></li>';
        $tmp .= "</ul>";
       

        return $tmp;
    }
}


if ( ! function_exists('convert_timezone'))
{
    function convert_timezone($time , $with_hours = false , $with_timezone = true , $hour_only = false , $custom_format_date_with_hour = "M d Y h:i:s A" , $custom_format_date = "M d Y" , $custom_format_hour = "h:i:s A")
    {

        if(!$time OR $time == 0){
            return "NA";
        }

        if($with_timezone){
            //$timezone = get_timezone();
            $timezone = "Europe/London";

            if($with_hours){
                $date_format = $custom_format_date_with_hour;
            }else if($hour_only){
                $date_format = $custom_format_hour;
            }else{
                $date_format = $custom_format_date;
            }
            
            $triggerOn = date($date_format , $time);

            $tz = new DateTimeZone($timezone);
            $datetime = new DateTime($triggerOn);
            $datetime->setTimezone($tz);

            return $datetime->format( $date_format );
        }else{
            if($with_hours){
                $date_format = $custom_format_date_with_hour;
            }else if($hour_only){
                $date_format = $custom_format_hour;
            }else{
                $date_format = $custom_format_date;
            }

            return date($date_format , $time);
        }
    }   
}

if(!function_exists("fromNow")){

    function fromNow($time) {
        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
        }
    }
}


if ( ! function_exists('custom_money_format'))
{
    function custom_money_format($money)
    {
        $obj =& get_instance();

        if(!$money){
            $money = "0.00";
        }
   
        $formatted = $obj->session->userdata("user")->currency_symbol;

        $formatted .= number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $money)), 2);
        return $money < 0 ? "({$formatted})" : "{$formatted}";
    }   
}
