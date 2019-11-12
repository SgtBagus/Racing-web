<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['page'] = 'Home';
		
		$data['tbl_event'] = $this->db->limit(3)->order_by('tgleventStart', 'DESC')->get_where('tbl_event', array('public' => 'ENABLE'))->result_array();
		$data['tbl_blog'] = $this->db->limit(4)->order_by('id', 'DESC')->get_where('tbl_blog', array('status' => 'ENABLE'))->result_array();
		
		$data['tbl_merchandise'] = $this->db->limit(4)->order_by('id', 'DESC')->get_where('tbl_merchandise', array('status' => 'ENABLE'))->result_array();

		
		$data['mainPhoto'] = $this->mymodel->selectDataone('file', array('table_id' => $data['tbl_event']['0']['id'], 'table' => 'tbl_event'));
		$data['rowteammain'] = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $data['tbl_event']['0']['id'] . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");
		$data['rowraidermain'] = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $data['tbl_event']['0']['id'] . " AND b.approve = 'APPROVE' ");
		$this->template->load('template/template','index', $data); 
	}
	
}