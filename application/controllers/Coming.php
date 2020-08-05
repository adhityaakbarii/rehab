<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coming extends CI_Controller {
  
  var $title  =   "Coming Soon";
	
	public function index()
	{						
		$data['title']	= $this->title;	
		$this->load->view('coming/index',$data);		
	}	
}