<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $tables =   "rh_user";		
	var $page		=		"master/user";
	var $pk     =   "id_user";
	var $title  =   "User";
	var $bread	=   "<ol class='breadcrumb'>
	<li class='breadcrumb-item'><a>Master</a></li>										
	<li class='breadcrumb-item active'><a href='master/user'>User</a></li>										
	</ol>";				          


	public function __construct()
	{		
		parent::__construct();
		//---- cek session -------//		

		//===== Load Database =====
		$this->load->database();
		$this->load->helper('url', 'string');
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
			$this->load->view($this->page);		
			$this->load->view('back_template/footer');
		}
	}
	
	public function index()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= $this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "view";		
		$data['mode']		= "view";		
		$data['dt_user'] = $this->db->query("SELECT rh_user.*,rh_staf.nama_lengkap,rh_instansi.instansi,rh_jabatan.jabatan,rh_departemen.departemen FROM rh_user 
			LEFT JOIN rh_staf ON rh_user.id_staf = rh_staf.id_staf
			LEFT JOIN rh_instansi ON rh_staf.id_instansi = rh_instansi.id_instansi
			LEFT JOIN rh_jabatan ON rh_staf.id_jabatan = rh_jabatan.id_jabatan
			LEFT JOIN rh_departemen ON rh_staf.id_departemen = rh_departemen.id_departemen
			ORDER BY id_user DESC");
		$this->template($data);	
	}	
	public function add()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Tambah ".$this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "insert";	
		$data['mode']		= "insert";											
		$data['dt_staf'] = $this->m_admin->getAll("rh_staf");
		$this->template($data);	
	}
	public function ambil_staf()
	{
		$id_staf	= $this->input->post('id_staf');		
		$dt = $this->db->query("SELECT rh_jabatan.jabatan,rh_departemen.departemen,rh_instansi.instansi FROM rh_staf
			LEFT JOIN rh_jabatan ON rh_staf.id_jabatan = rh_jabatan.id_jabatan
			LEFT JOIN rh_departemen ON rh_staf.id_departemen = rh_departemen.id_departemen
			LEFT JOIN rh_instansi ON rh_staf.id_instansi = rh_instansi.id_instansi
			WHERE rh_staf.id_staf = '$id_staf'");
		if($dt->num_rows() > 0){
			echo "nihil|".$dt->row()->jabatan."|".$dt->row()->departemen."|".$dt->row()->instansi;				
		}else{
			echo "none";
		}
	}
	public function delete()
	{		
		$tabel			= $this->tables;
		$pk 				= $this->pk;
		$id 				= $this->input->get('id');		
		$this->m_admin->delete($tabel,$pk,$id);
		$_SESSION['pesan'] 	= "Data berhasil dihapus";
		$_SESSION['tipe'] 	= "success";
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/user'>";
	}	
	public function save()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		

		$data['username'] 			= $this->input->post('username');		
		$data['password'] 			= md5($this->input->post('password'));		
		$data['level'] 			= $this->input->post('level');		
		$data['status'] 			= $this->input->post('status');		
		$data['id_staf'] 			= $this->input->post('id_staf');		
		$data['created_at'] 			= $waktu;
		
		$this->m_admin->insert($tabel,$data);					
		$_SESSION['pesan'] 		= "Data berhasil disimpan";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/user'>";					
	}	
	public function update()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$id 	= $this->input->post('id');		
		$data['username'] 			= $this->input->post('username');		
		$password 							= $this->input->post('password');		
		if($password!=""){
			$data['password'] = md5($password);
		}		
		$data['status'] 			= $this->input->post('status');		
		$data['id_staf'] 			= $this->input->post('id_staf');				
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/user'>";					
	}	
	public function edit()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Ubah ".$this->title;	
		$data['bread']	= $this->bread;
		$tabel	= $this->tables;
		$pk			= $this->pk;
		$id 		= $this->input->get('id');																															
		$data['set']		= "insert";		
		$data['mode']		= "edit";		
		$data['dt_user'] = $this->m_admin->getByID($tabel,$pk,$id);				
		$data['dt_staf'] = $this->m_admin->getAll("rh_staf");
		$this->template($data);	
	}
	public function detail()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Detail ".$this->title;	
		$data['bread']	= $this->bread;
		$tabel	= $this->tables;
		$pk			= $this->pk;
		$id 		= $this->input->get('id');																															
		$data['set']		= "insert";		
		$data['dt_user'] = $this->m_admin->getByID($tabel,$pk,$id);
		$data['dt_staf'] = $this->m_admin->getAll("rh_staf");		
		$data['mode']		= "detail";				
		$this->template($data);	
	}
}
