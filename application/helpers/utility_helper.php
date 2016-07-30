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

   function sendmail($array_data)
  {
    $obj =& get_instance();
    //set email library configuration
     $config = Array(
     'protocol' => 'smtp',
     'smtp_host' => 'ssl://smtp.googlemail.com',
     'smtp_port' => 465,
     'smtp_user' => 'robotcontractors@gmail.com',
     'smtp_pass' => '123!@#qweem0np45s',
     );
     
     //load email library
     $obj->load->library('email', $config);
     $obj->email->set_newline("\r\n");
     $obj->email->set_mailtype("html");
     //set email information and content
     $obj->email->from('robotcontractors@googlemail.com', 'Pondok Traveller');
     $obj->email->to($array_data['email'],$array_data['nama']);
     $data['data'] = $array_data['data'];
     $message = $obj->load->view($array_data['view'],$data,TRUE);
     $obj->email->subject($array_data['subject']);
     $obj->email->message($message);
     
     if($obj->email->send())
     {
     // echo 'Your email was sent, fool.';
      return TRUE;
     }
     
     else
     {
      return FALSE;
      // show_error($this->email->print_debugger());
     }
  }

