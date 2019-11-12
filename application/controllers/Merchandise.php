<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Merchandise extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page'] = 'Merchandise';
		$this->template->load('template/template', 'merchandise/index', $data);
	}

	public function view($id)
	{
		$data['page'] = 'Merchandise';
		$data['tbl_merchandise'] = $this->mymodel->selectDataone('tbl_merchandise',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_merchandise'));
		$data['file_detail'] = $this->mymodel->selectWhere('file',array('table_id'=>$id,'table'=>'tbl_merchandise_detail'));
		$data['subpage'] = '<b>' . $data['tbl_merchandise']['title'] . '</b>';
		$this->template->load('template/template', 'merchandise/view', $data);
	}
	public function fetch()
	{
		$output = '';

		$search = $_GET['title'];

		if ($search) {
			$tbl_merchandise = $this->mymodel->selectWithQuery("SELECT * from tbl_merchandise WHERE title LIKE '%" . $_GET['title'] . "%' AND status = 'ENABLE' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		} else {
			$tbl_merchandise = $this->mymodel->selectWithQuery("SELECT * FROM tbl_merchandise WHERE status = 'ENABLE' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		}
		if ($tbl_merchandise) {
			foreach ($tbl_merchandise as $row) {
				$photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_merchandise'));

				
				$title = strlen($row["title"]) > 20 ? substr($row["title"], 0, 20) . "..." : $row["title"];
				
				$output .= '
				<div class="col-xs-6">
					<a href="' . base_url('merchandise/view/') . $row['id'] . '" class="a_black">
						<div class="box">
						<img class="img-even" src="' . $photo['url'] . '">
							<div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                    </div>
                                    <div class="col-xs-12" align="center">
                                        <b style="font-size:11px">' . $title . '</b><br>
                                        <small><b>Rp. ' . number_format($row['harga'], 0, ',', '.') . ',- </b></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>';
			}
		}
		echo $output;
	}
}
