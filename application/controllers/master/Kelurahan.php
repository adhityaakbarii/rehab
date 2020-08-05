<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan extends CI_Controller {

	var $tables =   "tk_kelurahan";		
	var $page		=		"master/kelurahan";
	var $pk     =   "id_kelurahan";
	var $title  =   "Kelurahan";
	var $bread	=   "<ol class='breadcrumb'>
	<li class='breadcrumb-item'><a>Master</a></li>										
	<li class='breadcrumb-item active'><a href='master/kelurahan'>Kelurahan</a></li>										
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
		$this->load->model('m_kelurahan');			
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
			$this->load->view('back_template/footer',$data);
		}
	}
	
	public function index()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= $this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "view_fix";		
		$data['mode']		= "view";		
		$data['dt_kelurahan'] = $this->db->query("SELECT tk_kelurahan.*,tk_kecamatan.kecamatan FROM tk_kelurahan 
			LEFT JOIN tk_kecamatan ON tk_kelurahan.id_kecamatan = tk_kecamatan.id_kecamatan			
			ORDER BY id_kelurahan DESC");
		$this->template($data);	
	}
	public function add()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Tambah ".$this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "insert";	
		$data['mode']		= "insert";									
		$data['dt_kecamatan'] = $this->m_admin->getAll("tk_kecamatan");
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/kelurahan'>";
	}	
	public function ajax_1()
	{
		for ($i=0; $i < 100; $i++) { 
			$row = array();
			$row[] = $i;
			$row[] = $i;			
			$data[] = $row;				
		}
		$output = array(
			"data" => $data
			);
		echo json_encode($output);
	}
	public function ajax_list()
	{
		$list = $this->m_kelurahan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $isi) {
			$r = $this->m_admin->getByID("tk_kecamatan","id_kecamatan",$isi->id_kecamatan)->row();
			$no++;			

			$row = array();
			$row[] = $no;
			$row[] = $isi->id_kelurahan;
			$row[] = $isi->kelurahan;			
			$row[] = $r->kecamatan;
			$row[] = "<a class=\"btn btn-info btn-sm\" href=\"master/kelurahan/edit?id=$isi->id_kelurahan\"><i class=\"fa fa-edit\"></i></a>
								<a class=\"btn btn-danger btn-sm\" onclick=\"return confirm('Anda yakin?')\" href=\"master/kelurahan/delete?id=$isi->id_kelurahan\"><i class=\"fa fa-trash\"></i></a>";

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_kelurahan->count_all(),
						"recordsFiltered" => $this->m_kelurahan->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function save()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$data['kelurahan'] 			= $this->input->post('kelurahan');		
		$data['id_kecamatan'] 			= $this->input->post('id_kecamatan');				
		$data['created_at'] 			= $waktu;
		
		$this->m_admin->insert($tabel,$data);					
		$_SESSION['pesan'] 		= "Data berhasil disimpan";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/kelurahan'>";					
	}	
	public function update()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$id 	= $this->input->post('id');				
		$data['kelurahan'] 			= $this->input->post('kelurahan');		
		$data['id_kecamatan'] 			= $this->input->post('id_kecamatan');		
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/kelurahan'>";					
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
		$data['dt_kelurahan'] = $this->m_admin->getByID($tabel,$pk,$id);		
		$data['dt_kecamatan'] = $this->m_admin->getAll("tk_kecamatan");
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
		$data['dt_kelurahan'] = $this->m_admin->getByID($tabel,$pk,$id);		
		$data['dt_kecamatan'] = $this->m_admin->getAll("tk_kecamatan");
		$data['mode']		= "detail";				
		$this->template($data);	
	}
}
