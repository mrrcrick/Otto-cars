<?php
/**
 * Plugin Name: clean_air_plan
 * Plugin URI:
 * Description: Plugin that calculates discount generated on rental car by uber clean air found.
 * Version: 1.0
 * Author: Richard Crick
 * Author URI:
 */

 add_shortcode( 'clean_air_plan', 'clean_air_plan' );
function load_scripts() {
    wp_enqueue_style( 'my_pluggin_style', plugin_dir_url( __FILE__ ) . 'assets/css/my_pluggin_style.css',false,'1.1','all');
    wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css',false,'1.1','all');
    // script
    //wp_enqueue_script( 'jquery', plugin_dir_url( __FILE__ ) . 'assets/js/jquery-3.4.1.min.js', array(), '', true);
    wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.min.js', array(), '', true);
    wp_enqueue_script( 'my_plugin_js', plugin_dir_url( __FILE__ ) . 'assets/js/my_plugin.js', array('jquery'), '', true);
}

add_action( 'wp_enqueue_scripts', 'load_scripts' );
$agreements = array();

function setup($agreementsfile) {
    global $agreements;
    // see if file exists
    $string = file_get_contents(plugin_dir_url( __FILE__ )."/".$agreementsfile);
    $agreements = json_decode($string, true);

    // set all field keys are present

}


function my_thank_you_text ( $content ) {
    return $content .= '<p>Thank you for reading!</p>';
}

/*function first_short_code(){
    return "Hello";
}
*/
function clean_air_plan()
{
    global $agreements;

    setup('agreements.json');
    return car_panel($agreements);
}
// panel to display car and rate_calculater
function car_panel($agreements) {
    //print_r($agreements);
    $panel = '';
    // get car information
    $ids = array_keys($agreements);
    $index = 0;
    foreach($agreements as $agreement) {
        $panel .= car_info($ids[$index],$agreement);
        $index ++;
    }
    return "<div style class='car_panel'>".$panel."</div>";

}

function car_info($id,$carinfo) {
    $HTML = '';
    $baseUrl = plugin_dir_url( __FILE__ )."assets/images/";
    $HTML = "<div class='".$id." carcard'>".
    "<div class='carimage' style ='background-image: url(".'"'.$baseUrl.$id.'.png"'.");background-size: 100% 100%;'> </div>".
    "<div class='vechicle'>".$carinfo['vehicle']."</div>".
    "<div class='agreementlength'>agreement length: ".$carinfo['agreement_length']."</div>".
    "<div class='weekly_rental'>weekly rental: ".$carinfo['weekly_rental']."</div>".
    rate_calculater($id)."</div>";
    // add the rate_calculater
    return $HTML;
}
function rate_calculater($id) {
    $html = "<div class='rate_calculater'><b>Enter Green Miles : </b><input type='text'>
    <button type='button' class='".$id."'><b class='".$id."'>Calculate Discount</b></button>
    </div>";
    return $html;

}
