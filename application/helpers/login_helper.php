<?php
	function internal_errors() {
		$ci =& get_instance();
		if (isset($ci->error_log))
			return "<div class='error'>".$ci->error_log."</div>";
		return '';
	}
	function validation_errors($prefix = '<li>', $suffix = '</li>')
	{
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}
		$str = $OBJ->error_string($prefix, $suffix);
		if ($str)
			return '<div class="error"><ul>'.$OBJ->error_string($prefix, $suffix).'</ul></div>';
		return internal_errors();
	}
	function succes_errors() {
		//trying to get the succes erros and display;
		$ci =& get_instance();
		if (isset($ci->success_log))
			return "<div class='success'>".$ci->success_log."</div>";
		return '';
	}
	function __logged_in() {
		$CI =& get_instance();
		if (isset($_SESSION['logged_in']) && $CI->session->userdata['logged_in']) {
	    	$data['email'] = $CI->session->userdata('email');
	    	$data['password_enc'] = $CI->session->userdata('password');
	 		$stat = $CI->customers_model->check_customer_login($data);
	 		if ($stat) {
	 			$CI->current_user = $stat;
		 		return true;
	 		} 
	 	}
	 	return false;
	}
	function on_invalid_session($redirect='/customers/login') {
		$CI =& get_instance();
		$stat = false;
	 	if (!__logged_in()) {
			$CI->session->sess_destroy();
	 		redirect($redirect);
	 		return false;
	 	}
	 	return true;
	}
	function on_success_session($redirect='/customers/customer_panel') {
		$stat = false;

	 	if (__logged_in()) {
	 		redirect($redirect);
	 		return true;
	 	}
	 	return false;
	}

	function _t($key){
		$CI =& get_instance();
		return $CI->lang->line($key);
	}


?>