<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blogs extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page'] = 'Blogs';
		$this->template->load('template/template', 'blog/index', $data);
	}

	public function view($id)
	{
		$data['page'] = 'Blogs';
		$data['tbl_blog'] = $this->mymodel->selectDataone('tbl_blog',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_blog'));
		$this->template->load('template/template', 'blog/view', $data);
	}

	public function fetch()
	{
		$output = '';
		$search = $_GET['title'];
		if ($search) {
			$tbl_blog = $this->mymodel->selectWithQuery("SELECT * from tbl_blog WHERE title LIKE '%" . $_GET['title'] . "%' AND status = 'ENABLE' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		} else {
			$tbl_blog = $this->mymodel->selectWithQuery("SELECT * FROM tbl_blog WHERE status = 'ENABLE' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		}
		if ($tbl_blog) {
			foreach ($tbl_blog as $row) {
				$photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_blog'));

				// $desktpsi = strlen($row["deskripsi"]) > 50 ? substr($row["deskripsi"], 0, 50) . "..." : $row["deskripsi"];
				$title = strlen($row["title"]) > 20 ? substr($row["title"], 0, 20) . "..." : $row["title"];

				$output .= '
				<div class="col-xs-6">
					<a href="' . base_url('blogs/view/') . $row['id'] . '" class="a_black">
						<div class="box">
                        <img class="img-even" src="' . $photo['url'] . '">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12" align="center">
									<b style="font-size:11px">' . $title . '</b>
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
