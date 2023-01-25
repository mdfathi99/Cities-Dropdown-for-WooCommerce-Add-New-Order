<?php
/*
* Plugin Name: Cities Dropdown for WooCommerce Add New Order
* Plugin URI: https://github.com/mdfathi99
* Description: Adds a dropdown of cities to the WooCommerce admin "Add new order" page based on the selected country and state.
* Version: 1.0.2
* Author: Mohammad Fathi Rahman
* Author URI: https://github.com/mdfathi99
**/

// add_filter( 'woocommerce_admin_billing_fields', 'admin_billing_city_select_field' );
// function admin_billing_city_select_field( $fields ) {
//     global $pagenow, $places;

//     // Only for new order creation
//     if( $pagenow != 'post-new.php' ) return $fields;

//     $options = array('' => __( 'Select a city&hellip;', 'woocommerce' ));
//     if(isset($places['BD'])){
//         foreach($places['BD'] as $key => $value){
//             $options[$key] = $value[0];
//         }
//     }
//     $fields['city'] = array(
//         'label'   => __( 'City', 'woocommerce' ),
//         'show'    => false,
//         'class'   => 'js_field-city select short',
//         'type'    => 'select',
//         'options' => $options,
//     );

//     return $fields;
// }

require_once('places/BD.php');

function enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
    wp_enqueue_script('place-select-js', plugin_dir_url(__FILE__) . 'js/place-select.js', array('jquery', 'select2'), '0.1', true);
}
add_action('admin_enqueue_scripts', 'enqueue_scripts');


add_filter('woocommerce_admin_billing_fields', 'admin_billing_city_select_field');
function admin_billing_city_select_field($fields)
{
    global $pagenow, $places;

    // Only for new order creation
    if ($pagenow != 'post-new.php') return $fields;

    $options = array('' => __('Select a city&hellip;', 'woocommerce'));
    if (isset($places)) {
        foreach ($places as $state => $cities) {
            foreach ($cities as $city => $city_name) {
                $options[$city] = $city_name[0];
            }
        }
    }

    $fields['city'] = array(
        'label'   => __('City', 'woocommerce'),
        'show'    => false,
        'class'   => 'js_field-city select short',
        'type'    => 'select',
        'options' => $options,
    );
    return $fields;
}
