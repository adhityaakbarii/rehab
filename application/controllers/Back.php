<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back extends CI_Controller {

  var $tables =   "";		
	var $page		=		"home";
  var $pk     =   "";
  var $title  =   "Dashboard";
  var $bread	=   "<ol class='breadcrumb'>
										<li class='breadcrumb-item'><a href='#''>Home</a></li>										
									</ol>";				          

	public function __construct()
	{		
		parent::__construct();
		//---- cek session -------//		

		//===== Load Database =====
		$this->load->database();
		$this->load->helper('url');
		//===== Load Model =====
		$this->load->model('m_admin');		
		//===== Load Library =====
		$this->load->library('upload');
	}
	protected function template($data)
	{
		$name = $this->session->userdata('nama');
		if($name=="")
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."back?denied'>";
		}else{								
			$this->load->view('back_template/header',$data);
			$this->load->view('back_template/aside');			
			$this->load->view('master/'.$this->page);		
			$this->load->view('back_template/footer');
		}
	}
	public function index()
	{				
		$config_captcha = array(
			'img_path'  => './captcha/',
			'img_url'  => base_url() . 'captcha/',
			'img_width'  => '130',
			'img_height' => 30,
			'border' => 0,
			'expiration' => 7200
		);

		// create captcha image
		$cap = create_captcha($config_captcha);

		// store image html code in a variable
		$data['captchaImg'] = $cap['image'];

		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);
		
		$data['isi']    = $this->page;		
		$data['title']	= $this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "view";				
		$this->load->view("index",$data);
	}
	public function home()
	{				
		$data['isi']    = $this->page;		
		$data['title']	= $this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "view";		
		$cari = $this->input->post('cari');
		$data['id_tipe_kamar'] = "";
		if(isset($cari)){
			$data['id_tipe_kamar'] = $this->input->post("id_tipe_kamar");
		}
		$this->template($data);			
	}	
	public function login()
	{
		$username =	$this->input->post('username');
		$password = md5($this->input->post('password'));				
		$tgl 			= gmdate("Y-m-d h:i:s", time() + 60 * 60 * 7);
		$kode = $this->input->post('kode');
		$mycaptcha 	= $this->session->userdata('mycaptcha');
		if($kode == $mycaptcha) {				
			$rs_login = $this->m_admin->login($username, $password);				
			if ($rs_login->num_rows() == 1) {
				$row = $rs_login->row();										
				$cek = $this->m_admin->getByID("rh_staf","id_staf",$row->id_staf);
				$id_instansi = ($cek->num_rows() > 0) ? $cek->row()->id_instansi : "" ;
				$newdata = array(
	        'username'  => $row->username,
	        'nama'  => $row->username,
	        'id_instansi'  => $id_instansi,	        
	        'id_user' 	=> $row->id_user,
	        'level' 		=> $row->level
				);
				$nama = $row->username;
				$this->session->set_userdata($newdata);
				$_SESSION['pesan'] 	= "Selamat Datang, ".$nama."!";
				$_SESSION['tipe'] 	= "success";
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "back/home'>";						
			} else {
				$_SESSION['pesan'] 	= "Kombinasi Username dan Password salah!";
				$_SESSION['tipe'] 	= "danger";
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "back?usernametidakada'>";
			}		
		} else {
			$_SESSION['pesan'] 	= "Kode Captcha Salah!";
			$_SESSION['tipe'] 	= "danger";
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "back'>";
		}		
	}
	public function logout()
	{		
		session_destroy();
		session_unset();	
		echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "back'>";
	}
}