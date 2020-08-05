<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

	var $tables =   "tk_kecamatan";		
	var $page		=		"master/kecamatan";
	var $pk     =   "id_kecamatan";
	var $title  =   "Kecamatan";
	var $bread	=   "<ol class='breadcrumb'>
	<li class='breadcrumb-item'><a>Master</a></li>										
	<li class='breadcrumb-item active'><a href='master/kecamatan'>Kecamatan</a></li>										
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
		$this->load->model('m_kecamatan');			
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
		$data['dt_kecamatan'] = $this->db->query("SELECT tk_kecamatan.*,tk_kabupaten.kabupaten FROM tk_kecamatan 
			LEFT JOIN tk_kabupaten ON tk_kecamatan.id_kabupaten = tk_kabupaten.id_kabupaten			
			ORDER BY id_kecamatan DESC");
		$this->template($data);	
	}
	public function add()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Tambah ".$this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "insert";	
		$data['mode']		= "insert";									
		$data['dt_kabupaten'] = $this->m_admin->getAll("tk_kabupaten");
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/kecamatan'>";
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
		$list = $this->m_kecamatan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $isi) {
			$r = $this->m_admin->getByID("tk_kabupaten","id_kabupaten",$isi->id_kabupaten)->row();
			$no++;			

			$row = array();
			$row[] = $no;
			$row[] = $isi->id_kecamatan;
			$row[] = $isi->kecamatan;			
			$row[] = $r->kabupaten;
			$row[] = "<a class=\"btn btn-info btn-sm\" href=\"master/kecamatan/edit?id=$isi->id_kecamatan\"><i class=\"fa fa-edit\"></i></a>
								<a class=\"btn btn-danger btn-sm\" onclick=\"return confirm('Anda yakin?')\" href=\"master/kecamatan/delete?id=$isi->id_kecamatan\"><i class=\"fa fa-trash\"></i></a>";

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_kecamatan->count_all(),
						"recordsFiltered" => $this->m_kecamatan->count_filtered(),
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
		
		$data['kecamatan'] 			= $this->input->post('kecamatan');		
		$data['id_kabupaten'] 			= $this->input->post('id_kabupaten');				
		$data['created_at'] 			= $waktu;
		
		$this->m_admin->insert($tabel,$data);					
		$_SESSION['pesan'] 		= "Data berhasil disimpan";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/kecamatan'>";					
	}	
	public function update()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$id 	= $this->input->post('id');				
		$data['kecamatan'] 			= $this->input->post('kecamatan');		
		$data['id_kabupaten'] 			= $this->input->post('id_kabupaten');		
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."master/kecamatan'>";					
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
		$data['dt_kecamatan'] = $this->m_admin->getByID($tabel,$pk,$id);		
		$data['dt_kabupaten'] = $this->m_admin->getAll("tk_kabupaten");
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
		$data['dt_kecamatan'] = $this->m_admin->getByID($tabel,$pk,$id);		
		$data['dt_kabupaten'] = $this->m_admin->getAll("tk_kabupaten");
		$data['mode']		= "detail";				
		$this->template($data);	
	}
}
