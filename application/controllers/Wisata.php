<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Wisata extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page'] = 'Wisata';
		$this->template->load('template/template', 'wisata/index', $data);
	}

	public function view($id)
	{
		$data['page'] = 'Wisata';
		$data['tbl_wisata'] = $this->mymodel->selectDataone('tbl_wisata',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_wisata'));
		$this->template->load('template/template', 'wisata/view', $data);
	}

	public function fetch()
	{
		$output = '';
		$search = $_GET['title'];
		if ($search) {
			$tbl_wisata = $this->mymodel->selectWithQuery("SELECT * from tbl_wisata WHERE title LIKE '%" . $_GET['title'] . "%' AND status = 'ENABLE' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		} else {
			$tbl_wisata = $this->mymodel->selectWithQuery("SELECT * FROM tbl_wisata WHERE status = 'ENABLE' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		}
		if ($tbl_wisata) {
			foreach ($tbl_wisata as $row) {
				$photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_wisata'));
				
				$title = strlen($row["title"]) > 15 ? substr($row["title"], 0, 15) . "..." : $row["title"];
				
				$tanggal = "";
				if ((!$row['tgleventStart']) || (!$row['tgleventEnd'])) { 
					$tanggal = '<b>Coming Soon</b>';
				} else {
					$tanggal = date('d M Y', strtotime($row['tgleventStart'])) . "<b> s/d </b>" . date('d M Y', strtotime($row['tgleventEnd']));
				}

				$output .= '
				<div class="col-xs-6">
				<a href="' . base_url('wisata/view/') . $row['id'] . '" class="a_black">
				<div class="box">
				<img class="img-even" src="' . $photo['url'] . '">
				<div class="box-body">
				<div class="row">
				<div class="col-xs-12" align="center">
				<b style="font-size:11px">' . $title . '</b><br>
				</div>
				</div>
				<div class="row">
				<div class="col-xs-12" align="center">
				Wisata Dimulai : 
				<br>
								<small>'.$tanggal.'</small>
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
