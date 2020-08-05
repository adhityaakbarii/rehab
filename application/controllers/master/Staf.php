<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staf extends CI_Controller {

	var $tables =   "rh_staf";		
	var $page		=		"master/staf";
	var $pk     =   "id_staf";
	var $title  =   "Staf";
	var $bread	=   "<ol class='breadcrumb'>
	<li class='breadcrumb-item'><a>Master</a></li>										
	<li class='breadcrumb-item active'><a href='master/staf'>Staf</a></li>										
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
		$data['dt_staf'] = $this->db->query("SELECT rh_staf.*,rh_departemen.departemen,rh_jabatan.jabatan,rh_instansi.instansi FROM rh_staf 
			LEFT JOIN rh_departemen ON rh_staf.id_departemen = rh_departemen.id_departemen			
			LEFT JOIN rh_jabatan ON rh_staf.id_jabatan = rh_jabatan.id_jabatan
			LEFT JOIN rh_instansi ON rh_staf.id_instansi = rh_instansi.id_instansi
			ORDER BY id_staf DESC");
		$this->template($data);	
	}
	public function add()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Tambah ".$this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "insert";	
		$data['mode']		= "insert";									
		$data['dt_departemen'] = $this->m_admin->getAll("rh_departemen");
		$data['dt_instansi'] = $this->m_admin->getAll("rh_instansi");
		$data['dt_jabatan'] = $this->m_admin->getAll("rh_jabatan");				
		$data['dt_provinsi'] = $this->m_admin->getAll("rh_provinsi");	
		$data['dt_kabupaten'] = $this->m_admin->getAll("rh_kabupaten");			
		$data['dt_kecataman'] = $this->m_admin->getAll("rh_kecamatan");			
		$data['dt_kelurahan'] = $this->m_admin->getAll("rh_kelurahan");			
		$this->template($data);	
	}
	public function delete()
	{		
		$tabel			= $this->tables;
		$pk 				= $this->pk;
		$id 				= $this->input->get('id');		
		$this->m_admin->delete($tabel,$pk,$id);
		$_SESSION['pesan'] 	= "Data berhasil dihapus";
		$_SESSION['tipe'] 	= "success";
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/staf'>";
	}	
	public function save()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		

		$data['nik'] 			= $this->input->post('nik');		
		$data['nama_lengkap'] 			= $this->input->post('nama_lengkap');		
		$data['id_jabatan'] 			= $this->input->post('id_jabatan');		
		$data['id_departemen'] 			= $this->input->post('id_departemen');		
		$data['id_instansi'] 			= $this->input->post('id_instansi');		
		$data['keterangan'] 			= $nik = $this->input->post('keterangan');		
		$data['alamat'] 			= $nik = $this->input->post('alamat');				
		$data['pendidikan'] 			= $nik = $this->input->post('pendidikan');				
		$data['id_provinsi'] 			= $nik = $this->input->post('id_provinsi');		
		$data['id_kabupaten'] 			= $nik = $this->input->post('id_kabupaten');		
		$data['id_kecamatan'] 			= $nik = $this->input->post('id_kecamatan');		
		$data['id_kelurahan'] 			= $nik = $this->input->post('id_kelurahan');		
		$data['created_at'] 			= $waktu;
		
		$this->m_admin->insert($tabel,$data);					
		$_SESSION['pesan'] 		= "Data berhasil disimpan";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/staf'>";					
	}	
	public function update()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
				
		$id 			= $this->input->post('id');		
		$data['nik'] 			= $id2 = $this->input->post('nik');		
		$data['nama_lengkap'] 			= $this->input->post('nama_lengkap');		
		$data['id_jabatan'] 			= $this->input->post('id_jabatan');		
		$data['id_departemen'] 			= $this->input->post('id_departemen');		
		$data['id_instansi'] 			= $this->input->post('id_instansi');		
		$data['keterangan'] 			= $nik = $this->input->post('keterangan');		
		$data['alamat'] 			= $nik = $this->input->post('alamat');				
		$data['pendidikan'] 			= $nik = $this->input->post('pendidikan');				
		$data['id_provinsi'] 			= $nik = $this->input->post('id_provinsi');		
		$data['id_kabupaten'] 			= $nik = $this->input->post('id_kabupaten');		
		$data['id_kecamatan'] 			= $nik = $this->input->post('id_kecamatan');		
		$data['id_kelurahan'] 			= $nik = $this->input->post('id_kelurahan');		
		$data['updated_at'] 			= $waktu;

		$cek 				= $this->m_admin->getByID($tabel,$pk,$id2)->num_rows();
		if($cek == 0 or $id == $id2){
			$this->m_admin->update($tabel,$data,$pk,$id);					
			$_SESSION['pesan'] 		= "Data berhasil diubah";
			$_SESSION['tipe'] 		= "success";						
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/staf'>";					
		}else{
			$_SESSION['pesan'] 	= "ID Staf Duplikat";
			$_SESSION['tipe'] 	= "danger";
			echo "<script>history.go(-1)</script>";
		}
	}	
	public function ambil_kab()
	{
		$id_provinsi	= $this->input->post('id_provinsi');		
		$dt_kab = $this->db->query("SELECT id_kabupaten,kabupaten from rh_kabupaten WHERE id_provinsi='$id_provinsi' ORDER BY kabupaten ASC");
		foreach ($dt_kab->result() as $res) {			
			echo "<option value='$res->id_kabupaten'>$res->kabupaten</option>";
		}
		echo $data;				
	}
	public function ambil_kec()
	{
		$id_kabupaten	= $this->input->post('id_kabupaten');		
		$dt_kec = $this->db->query("SELECT id_kecamatan,kecamatan from rh_kecamatan WHERE id_kabupaten='$id_kabupaten' ORDER BY kecamatan ASC");
		foreach ($dt_kec->result() as $res) {			
			echo "<option value='$res->id_kecamatan'>$res->kecamatan</option>";
		}
		echo $data;				
	}	
	public function ambil_kel()
	{
		$id_kecamatan	= $this->input->post('id_kecamatan');		
		$dt_kel = $this->db->query("SELECT id_kelurahan,kelurahan from rh_kelurahan WHERE id_kecamatan='$id_kecamatan' ORDER BY kelurahan ASC");
		foreach ($dt_kel->result() as $res) {			
			echo "<option value='$res->id_kelurahan'>$res->kelurahan</option>";
		}
		echo $data;				
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
		$data['dt_staf'] = $this->m_admin->getByID($tabel,$pk,$id);		
		$data['dt_departemen'] = $this->m_admin->getAll("rh_departemen");
		$data['dt_instansi'] = $this->m_admin->getAll("rh_instansi");
		$data['dt_jabatan'] = $this->m_admin->getAll("rh_jabatan");				
		$data['dt_provinsi'] = $this->m_admin->getAll("rh_provinsi");	
		$data['dt_kabupaten'] = $this->m_admin->getAll("rh_kabupaten");			
		$data['dt_kecataman'] = $this->m_admin->getAll("rh_kecamatan");			
		$data['dt_kelurahan'] = $this->m_admin->getAll("rh_kelurahan");			
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
		$data['dt_staf'] = $this->m_admin->getByID($tabel,$pk,$id);
		$data['dt_departemen'] = $this->m_admin->getAll("rh_departemen");
		$data['dt_instansi'] = $this->m_admin->getAll("rh_instansi");
		$data['dt_jabatan'] = $this->m_admin->getAll("rh_jabatan");				
		$data['dt_provinsi'] = $this->m_admin->getAll("rh_provinsi");	
		$data['dt_kabupaten'] = $this->m_admin->getAll("rh_kabupaten");			
		$data['dt_kecataman'] = $this->m_admin->getAll("rh_kecamatan");			
		$data['dt_kelurahan'] = $this->m_admin->getAll("rh_kelurahan");			
		$data['mode']		= "detail";				
		$this->template($data);	
	}
}
