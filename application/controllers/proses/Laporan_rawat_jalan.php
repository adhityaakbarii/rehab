<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_rawat_jalan extends CI_Controller {

	var $tables =   "rh_client";		
	var $page		=		"proses/laporan_rawat_jalan";
	var $pk     =   "id_client";
	var $title  =   "Laporan rawat jalan";
	var $bread	=   "<ol class='breadcrumb'>
	<li class='breadcrumb-item'><a>Proses</a></li>										
	<li class='breadcrumb-item active'><a href='trans/booking'>Data Laporan Rawat Jalan</a></li>										
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
	
	function mata_uang($a){      
		if(is_numeric($a) AND $a != 0 AND $a != ""){
			return number_format($a, 0, ',', '.');
		}else{
			return $a;
		}
	}
	public function index()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= $this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "view";		
		$data['mode']		= "view";				
		$data['dt_laporan_rawat_jalan'] = $this->db->query("SELECT * FROM rh_instansi");
		$this->template($data);	
	}
	public function add()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= $this->title;	
		$data['bread']	= $this->bread;																													
		$data['set']		= "insert";	
		$data['dt_instansi'] = $this->m_admin->getAll("rh_instansi");
		$data['dt_staf'] = $this->m_admin->getAll("rh_staf");
		$data['dt_provinsi'] = $this->m_admin->getAll("rh_provinsi");	
		$data['dt_kabupaten'] = $this->m_admin->getAll("rh_kabupaten");			
		$data['dt_kecataman'] = $this->m_admin->getAll("rh_kecamatan");			
		$data['dt_kelurahan'] = $this->m_admin->getAll("rh_kelurahan");			
		$data['mode']		= "insert";									
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."trans/booking'>";
	}	
	public function cari_id(){							
		$tgl = gmdate("d", time()+60*60*7);
		$ra = rand(100,999);
		$pr_num = $this->db->query("SELECT * FROM tk_booking ORDER BY id_booking DESC LIMIT 0,1");							
		if($pr_num->num_rows() > 0){		
			$row 	= $pr_num->row();					
			$pan  = strlen($row->kode_booking)-8;
			$id 	= substr($row->kode_booking,$pan,10)+1;	
			if($id < 10){
				$kode1 = "0000".$id;          					
			}elseif($id>9 && $id<=99){
				$kode1 = "000".$id;          					
			}elseif($id>99 && $id<=999){
				$kode1 = "00".$id;          					
			}elseif($id>999){
				$kode1 = "0".$id;          					
			}
			$kode = "BTK".$tgl.$ra.$kode1;
		}else{
			$kode = "BTK".$tgl.$ra."00001";
		}						
		return $kode;
	}
	public function save()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		

		$config['upload_path'] 		= './assets/back/assets/images/booking/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
		$config['max_size']				= '5000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '1024';

		$this->upload->initialize($config);
		if(!$this->upload->do_upload('bukti')){
			$bukti	= "";
		}else{
			$bukti	= $this->upload->file_name;
		}

		$data['tgl_booking'] 			= $waktu;
		$data['id_cabang'] 			= $this->session->userdata('id_cabang');		
		$data['nama_tamu'] 			= $this->input->post('nama_tamu');		
		$data['nama_kontak'] 			= $this->input->post('nama_kontak');		
		$data['no_hp'] 			= $this->input->post('no_hp');		
		$data['email'] 			= $this->input->post('email');		
		$data['checkin'] 			= $this->input->post('checkin');		
		$data['checkout'] 			= $this->input->post('checkout');		
		$data['duration'] 			= $this->input->post('duration');		
		$data['room'] 			= $this->input->post('room');		
		$data['id_tipe_kamar'] 			= $this->input->post('id_tipe_kamar');		
		$data['keterangan'] 			= $this->input->post('keterangan');		
		$data['nama_rekening'] 			= $this->input->post('nama_rekening');		
		$data['id_metode_bayar'] 			= $this->input->post('id_metode_bayar');		
		$data['no_rekening'] 			 = $this->input->post('no_rekening');		
		$data['bank'] 			 = $this->input->post('bank');		
		$data['id_bank'] 			 = $this->input->post('id_bank');		
		$data['tgl_bayar'] 			 = $this->input->post('tgl_bayar');		
		$data['total'] 			 = $this->input->post('total_real');		
		$data['dp'] 			 = $this->input->post('dp');		
		$data['status_bayar'] 			 = 1;
		$data['bukti'] 			= $bukti;		
		$data['kode_booking'] 			= $this->cari_id();		
		if($this->input->post('simpan') == 'simpan_confirm'){
			$data['status'] 			 = 2;		
		}else{
			$data['status'] 			 = 1;		
		}
		$data['created_at'] 			= $waktu;
		
		$this->m_admin->insert($tabel,$data);					
		$_SESSION['pesan'] 		= "Data berhasil disimpan";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."trans/booking'>";					
	}	
	public function hitung()
	{
		$id_tipe_kamar	= $this->input->post('id_tipe_kamar');		
		$duration	= $this->input->post('duration');		
		$room	= $this->input->post('room');		
		$cari = $this->db->query("SELECT * FROM tk_kamar 
			LEFT JOIN tk_tipe_kamar ON tk_kamar.id_tipe_kamar = tk_tipe_kamar.id_tipe_kamar
			LEFT JOIN tabel_cabang ON tk_kamar.id_cabang = tabel_cabang.id_cabang
			LEFT JOIN tk_harga ON tk_tipe_kamar.id_tipe_kamar = tk_harga.id_tipe_kamar				
			WHERE tk_kamar.status = 0 AND tk_kamar.id_tipe_kamar = '$id_tipe_kamar'");		
		if($cari->num_rows() > 0){
			$cek = $cari->row();
			$harga = $cek->harga;
			$total = $harga * $duration * $room;
			echo "nihil|".$total."|".$this->mata_uang($total);				
		}else{
			echo "none";
		}
	}
	public function update()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$id 	= $this->input->post('id');		
		$data['booking'] 			= $this->input->post('booking');		
		$data['keterangan'] 			= $nik = $this->input->post('keterangan');		
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."trans/booking'>";					
	}	
	public function payment()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		$config['upload_path'] 		= './assets/back/assets/images/booking/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
		$config['max_size']				= '5000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '1024';

		$this->upload->initialize($config);
		if(!$this->upload->do_upload('bukti')){
			$bukti	= "";
		}else{
			$bukti	= $this->upload->file_name;
		}
		
		$id 	= $this->input->post('id');		
		$data['nama_rekening'] 			= $this->input->post('nama_rekening');		
		$data['no_rekening'] 			 = $this->input->post('no_rekening');		
		$data['bank'] 			 = $this->input->post('bank');		
		$data['id_bank'] 			 = $this->input->post('id_bank');		
		$data['tgl_bayar'] 			 = $this->input->post('tgl_bayar');		
		$data['id_metode_bayar'] 			 = $this->input->post('id_metode_bayar');		
		$data['total'] 			 = $this->input->post('total');		
		$data['dp'] 			 = $this->input->post('dp');		
		$data['status_bayar'] 	 = 1;
		$data['bukti'] 			= $bukti;		
		if($this->input->post('simpan') == 'simpan_confirm'){
			$data['status'] 	= 2;		
		}else{
			$data['status'] 	= 1;		
		}
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."trans/booking'>";					
	}
	public function cancel()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$id 	= $this->input->get('id');				
		$data['status'] 			 = 3;				
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."trans/booking'>";					
	}	
	public function approve()
	{		
		$waktu 		= gmdate("y-m-d h:i:s", time()+60*60*7);		
		$tabel		= $this->tables;		
		$pk				= $this->pk;		
		
		$id 	= $this->input->get('id');				
		$data['status'] 			 = 2;				
		$data['updated_at'] 			= $waktu;

		$this->m_admin->update($tabel,$data,$pk,$id);					
		$_SESSION['pesan'] 		= "Data berhasil diubah";
		$_SESSION['tipe'] 		= "success";						
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."trans/booking'>";					
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
		$data['dt_booking'] = $this->db->query("SELECT tk_booking.*,tk_tipe_kamar.tipe_kamar,tabel_cabang.cabang,tk_bank.bank AS bank_tujuan FROM tk_booking
			LEFT JOIN tk_tipe_kamar ON tk_booking.id_tipe_kamar = tk_tipe_kamar.id_tipe_kamar
			LEFT JOIN tabel_cabang ON tk_booking.id_cabang = tabel_cabang.id_cabang
			LEFT JOIN tk_bank ON tk_booking.id_bank = tk_bank.id_bank
			WHERE tk_booking.id_booking = '$id' ORDER BY tk_booking.id_booking DESC");		
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
		$data['dt_bank'] = $this->m_admin->getAll("tk_bank");
		$data['dt_tipe_kamar'] = $this->m_admin->getAll("tk_tipe_kamar");
		$data['dt_metode_bayar'] = $this->m_admin->getAll("tk_metode_bayar");
		$data['dt_booking'] = $this->db->query("SELECT tk_booking.*,tk_tipe_kamar.tipe_kamar,tabel_cabang.cabang,tk_bank.bank AS bank_tujuan FROM tk_booking
			LEFT JOIN tk_tipe_kamar ON tk_booking.id_tipe_kamar = tk_tipe_kamar.id_tipe_kamar
			LEFT JOIN tabel_cabang ON tk_booking.id_cabang = tabel_cabang.id_cabang
			LEFT JOIN tk_bank ON tk_booking.id_bank = tk_bank.id_bank
			WHERE tk_booking.id_booking = '$id' ORDER BY tk_booking.id_booking DESC");
		$data['mode']		= "detail";				
		$this->template($data);	
	}
	public function confirm()
	{								
		$data['isi']    = $this->page;		
		$data['title']	= "Konfirmasi ".$this->title;	
		$data['bread']	= $this->bread;
		$tabel	= $this->tables;
		$pk			= $this->pk;
		$id 		= $this->input->get('id');																															
		$data['set']		= "insert";		
		$data['dt_bank'] = $this->m_admin->getAll("tk_bank");
		$data['dt_tipe_kamar'] = $this->m_admin->getAll("tk_tipe_kamar");
		$data['dt_metode_bayar'] = $this->m_admin->getAll("tk_metode_bayar");
		$data['dt_booking'] = $this->db->query("SELECT tk_booking.*,tk_tipe_kamar.tipe_kamar,tabel_cabang.cabang,tk_bank.bank AS bank_tujuan FROM tk_booking
			LEFT JOIN tk_tipe_kamar ON tk_booking.id_tipe_kamar = tk_tipe_kamar.id_tipe_kamar
			LEFT JOIN tabel_cabang ON tk_booking.id_cabang = tabel_cabang.id_cabang
			LEFT JOIN tk_bank ON tk_booking.id_bank = tk_bank.id_bank
			WHERE tk_booking.id_booking = '$id' ORDER BY tk_booking.id_booking DESC");
		$data['mode']		= "confirm";				
		$this->template($data);	
	}
}
