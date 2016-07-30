<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 if ( ! function_exists('asset_url()'))
 {
   function asset_url()
   {
      return base_url().'assets/';
   }
 }

   function convert_config($config_name,$id)
   {
   		$obj =& get_instance();
        foreach ($obj->config->item($config_name) as $key => $value) {
        	if ($key == $id) {
        		return $value;
        	}
        }
   }
