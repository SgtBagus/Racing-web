<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['page'] = 'Home';
		$data['tbl_event'] = $this->db->limit(2)->order_by('tgleventStart', 'DESC')->get_where('tbl_event', array('public' => 'ENABLE'))->result_array();
		$data['tbl_blog'] = $this->db->limit(1)->order_by('id', 'DESC')->get_where('tbl_blog', array('status' => 'ENABLE'))->result_array();
		
		$data['tbl_merchandise'] = $this->db->limit(2)->order_by('id', 'DESC')->get_where('tbl_merchandise', array('status' => 'ENABLE'))->result_array();
		$this->template->load('template/template','index', $data); 
	}
	
}