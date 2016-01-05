<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
  	Auth library
**/
class Auth{
	var $CI = NULL;
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();
	}

	function cek_session_login()
	{
		if($this->CI->session->userdata('namauser') == '' AND $this->CI->session->userdata('password') == '')
		{
			return false;
		}
		return true;
	}

	function cek_login()
	{
		if($this->cek_session_login() == false)
		{
            redirect('');
		}
	}

	function cek_session_admin()
	{	
		//Sesuikan dengan database anda
		if($this->CI->session->userdata('namauser') == '' 
			AND $this->CI->session->userdata('password') == '' 
			AND $this->CI->session->userdata('level') != 'admin' )
		{
			return false;
		}
		return true;
	}

	function is_admin()
	{	
		//echo $this->cek_session_admin().",".$this->CI->session->userdata('level').",".$this->CI->session->userdata('password');
		if($this->cek_session_admin() == false)
		{	
            redirect('');
		}
	}

	function admin_login()
	{
		if($this->cek_session_admin() == true)
		{	
            redirect($this->CI->config->item('admin_folder').'dashboard1');
		}
	}

	function hapus_session()
	{
		$this->CI->session->sess_destroy();
	}
}