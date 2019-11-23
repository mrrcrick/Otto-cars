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
// load scripts
function load_scripts() {
    wp_enqueue_style( 'my_pluggin_style', plugin_dir_url( __FILE__ ) . 'assets/css/my_pluggin_style.css',false,'1.1','all');
    wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css',false,'1.1','all');
    wp_enqueue_script( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.min.js', array(), '', true);
    wp_enqueue_script( 'my_plugin_js', plugin_dir_url( __FILE__ ) . 'assets/js/my_plugin.js', array('jquery'), '', true);
}

add_action( 'wp_enqueue_scripts', 'load_scripts' );
$agreements = array();

// set up list of cars
function setup($agreementsfile) {
    $listOfExpectedKeys = ['vehicle','agreement_length','weekly_rental'];
    global $agreements;
    // see if file exists
    if(file_exists(plugin_dir_path( __FILE__ ).$agreementsfile)){
        $string = file_get_contents(plugin_dir_path( __FILE__ )."/".$agreementsfile);
        $agreements = json_decode($string, true);
    }
    else {
        return ("couldn't find file ".plugin_dir_path( __FILE__ ).$agreementsfile);
    }
    // check all field keys are present
    foreach  ($agreements as $agreement){
        foreach ($listOfExpectedKeys as $expectedKey) {
            if (!array_key_exists ($expectedKey,$agreement))
            {
                return ($expectedKey." field is missing");
            }
        }

    }

    return "Success";

}
// diplay cars
function clean_air_plan()
{
    global $agreements;
    $result = setup('agreements.json');
    if ( $result == "Success"){
        return car_panel($agreements);
    }
    else {
        return $result;
    }
}
// panel to display car and rate_calculater
function car_panel($agreements) {
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
// card to display car information
function car_info($id,$carinfo) {
    $HTML = '';
    $baseUrl = plugin_dir_url( __FILE__ )."assets/images/";
    $HTML = "<div class='".$id." carcard'>".
    "<div class='carimage' style ='background-image: url(".'"'.$baseUrl.$id.'.png"'.");background-size: 100% 100%;'><span class='error-msg'></span></div>".
    "<div class='vehicle'>".$carinfo['vehicle']."</div>".
    "<div class='agreementlength'>agreement length: <span class='info'>".$carinfo['agreement_length']."</span> years</div>".
    "<div class='weekly_rental'>weekly rental: <span class='discount'>£<span class='info'>".$carinfo['weekly_rental'].
    "</span></span><span class='newprice'>0</span></div>".
    rate_calculater($id)."</div>";
    return $HTML;
}
// rate calculator
function rate_calculater($id) {
    $html = "<div class='rate_calculater'><b>Uber Clean Air fund : £</b><input type='text'>
    <button type='button' class='".$id."'><b class='".$id."'>Calculate Discount</b></button>
    </div>";
    return $html;

}
