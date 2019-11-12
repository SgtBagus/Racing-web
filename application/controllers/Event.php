<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Event extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page'] = 'Event';
		$this->template->load('template/template', 'event/index', $data);
	}

	public function view($id)
	{
		$data['page'] = 'Event';
		$data['tbl_event'] = $this->mymodel->selectDataone('tbl_event',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_event'));
		$data['rule'] = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'event_rule'));

		$data['register_id'] = $this->mymodel->selectDataone('tbl_event_register', array('event_id' => $data['tbl_event']['id']));

		$data['rowteam'] = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $id . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");
		$data['rowraider'] = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $id." AND b.approve = 'APPROVE' ");

		$data['subpage'] = '<b>' . $data['tbl_event']['title'] . '</b>';
		$this->template->load('template/template', 'event/view', $data);
	}

	public function gallery($id)
	{
		$data['page'] = 'Event';
		$data['tbl_event'] = $this->mymodel->selectDataone('tbl_event',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_event'));

		$data['register_id'] = $this->mymodel->selectDataone('tbl_event_register', array('event_id' => $data['tbl_event']['id']));
		$data['rowteam'] = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $id . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");
		$data['rowraider'] = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $id." AND b.approve = 'APPROVE' ");

		$data['subpage'] = '<b>' . $data['tbl_event']['title'] . '</b>';
		$this->template->load('template/template', 'event/gallery', $data);
	}

	public function register($id)
	{
		$data['page'] = 'Event';
		$data['tbl_event'] = $this->mymodel->selectDataone('tbl_event',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_event'));
		$data['raider'] = $this->mymodel->selectWhere('tbl_raider', array('team_id' => $this->session->userdata('id')));

		$data['register_id'] = $this->mymodel->selectDataone('tbl_event_register', array('event_id' => $data['tbl_event']['id']));
		$data['rowteam'] = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $id . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");
		$data['rowraider'] = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $id." AND b.approve = 'APPROVE' ");

		$data['subpage'] = 'Mendaftar Event : <b>' . $data['tbl_event']['title'] . '</b>';
		$this->template->load('template/template', 'event/register', $data);
	}

	public function get_raider($id)
	{
		$value = $this->db->query("SELECT a.*, b.url FROM tbl_raider a INNER JOIN file b on b.table_id = a.id WHERE b.table = 'tbl_raider' AND a.id = '" . $id . "'")->result_array();
		echo json_encode($value);
	}

	public function addregister()
	{
		$tbl_event = $this->mymodel->selectDataone('tbl_event', array('id' => $_POST['event_id']));

		$dt['team_id'] = $_POST['team_id'];
		$dt['event_id'] = $_POST['event_id'];
		$dt['approve'] = 'WAITING';
		$dt['note'] = '';
		$dt['status'] = 'ENABLE';
		$dt['created_at'] = date("Y-m-d H:i:s");

		$this->mymodel->insertData('tbl_event_register', $dt);
		$last_id = $this->db->insert_id();

		$countfiles = count($_POST['raiderarray']);
		for ($i = 1; $i <= $countfiles; $i++) {
			$dtd['event_register_id'] = $last_id;
			$dtd['raider_id'] = $_POST['raiderarray'][$i];
			$dtd['status'] = 'ENABLE';
			$dtd['created_at'] = date("Y-m-d H:i:s");
			$this->mymodel->insertData('tbl_event_register_raider', $dtd);
		}
		$this->load->library('email');
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://dev.karyastudio.com',
			'smtp_port' => 465,
			'smtp_user' => 'nso@dev.karyastudio.com',
			'smtp_pass' => 'u4s@,$VJij3s',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$name = "Team - " . $this->session->userdata("name");
		$toemail = $this->session->userdata("email");
		$fromemail = 'nso@dev.karyastudio.com';
		$fromname = 'Never Say Old - Admin';
		$subjectemail = 'Terima Kasih Telah Ikut Serta Di Event Kami';
		$harga = $tbl_event['harga'];
		$wa = $tbl_event['phone'];
		$this->sendemail->addEvent($name, $toemail, $fromemail, $fromname, $subjectemail, $wa, $harga);

		header('Location: ' . base_url('event/resultregister'));
	}


	public function registerrider($idevent)
	{

		$tbl_event = $this->mymodel->selectDataone('tbl_event', array('id' => $idevent));
		$tbl_raider = $this->mymodel->selectDataone('tbl_raider', array('id' => $this->session->userdata('id')));

		$dt['team_id'] = $tbl_raider['team_id'];
		$dt['event_id'] = $idevent;
		$dt['approve'] = 'WAITING';
		$dt['note'] = '';
		$dt['status'] = 'ENABLE';
		$dt['created_at'] = date("Y-m-d H:i:s");

		$this->mymodel->insertData('tbl_event_register', $dt);
		$last_id = $this->db->insert_id();

		$dtd['event_register_id'] = $last_id;
		$dtd['raider_id'] = $tbl_raider['id'];
		$dtd['status'] = 'ENABLE';
		$dtd['created_at'] = date("Y-m-d H:i:s");
		$this->mymodel->insertData('tbl_event_register_raider', $dtd);

		$this->load->library('email');
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://dev.karyastudio.com',
			'smtp_port' => 465,
			'smtp_user' => 'nso@dev.karyastudio.com',
			'smtp_pass' => 'u4s@,$VJij3s',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$name = "Rider - " . $this->session->userdata("name");
		$toemail = $this->session->userdata("email");
		$fromemail = 'nso@dev.karyastudio.com';
		$fromname = 'Never Say Old - Admin';
		$subjectemail = 'Terima Kasih Telah Ikut Serta Di Event Kami';
		$harga = $tbl_event['harga'];
		$wa = $tbl_event['phone'];
		$this->sendemail->addEvent($name, $toemail, $fromemail, $fromname, $subjectemail, $wa, $harga);

		header('Location: ' . base_url('event/resultregister'));
	}

	public function fetch()
	{
		$output = '';

		$search = $_GET['title'];

		if ($search) {
			$event = $this->mymodel->selectWithQuery("SELECT * FROM tbl_event WHERE public = 'ENABLE' AND LOWER(title) like '%" . $search . "%' ORDER BY tgleventStart DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		} else {
			$event = $this->mymodel->selectWithQuery("SELECT * FROM tbl_event WHERE public = 'ENABLE' ORDER BY tgleventStart DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		}
		if ($event) {
			foreach ($event as $row) {
				$photo = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'tbl_event'));
				$rowteam = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $row['id'] . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");

				$rowraider = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $row['id']." AND b.approve = 'APPROVE' ");

				if ($row['statusEvent'] == 'BERJALAN') {
					$status =  '<span class="label bg-yellow round right" style="margin-left:5px">BERJALAN</span>';
				} else if ($row['statusEvent'] == 'SELESAI') {
					$status =  '<span class="label bg-green round right" style="margin-left:5px">SELESAI</span>';
				} else if ($row['statusEvent'] == 'BATAL') {
					$status =  '<span class="label bg-red round right" style="margin-left:5px">DIBATALKAN</span>';
				} else {
					$status =  '<span class="label bg-blue round right" style="margin-left:5px">DIBUKA</span>';
				}
				
				$title = strlen($row["title"]) > 20 ? substr($row["title"], 0, 20) . "..." : $row["title"];
				
				$tanggal = "";
				if ((!$row['tgleventStart']) || (!$row['tgleventEnd'])) { 
					$tanggal = '<b>Coming Soon</b>';
				} else {
					$tanggal = date('d M Y', strtotime($row['tgleventStart'])) . "<b> s/d </b>" . date('d M Y', strtotime($row['tgleventEnd']));
				}

				$output .= '
				<a href="' . base_url("event/view/") . $row['id'] . '" class="a_black">
				<div class="col-xs-6">
				<div class="box">
					<img class="img-even" src="' . $photo['url'] . '">
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12" align="center">
								<b style="font-size:11px">' . $title . '</b><br>
								<div class="row" align="center">
								' . $status . '
								</div>
								<div class="col-md-12" style="padding:0px 10px;">
								</div>
							</div>
						</div>
						<hr style="margin-top:5px; margin-bottom: 5px;">
						<div class="row">
							<div class="col-xs-12" align="center">
								Tanggal Event :
								<br>
								<small>'.$tanggal.'</small>
							</div>
							<div class="col-xs-12" align="center">
								Pendaftar :
								<b>
								<img src="' . base_url('assets/flaticon/icon_rider.png') . '" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" />' . $rowraider[0]['rowraider'] . '
								<img src="' . base_url('assets/flaticon/icon_team.png') . '" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" />' . $rowteam[0]['rowteam'] . '
								</b>
							</div>
						</div>
					</div>
				</div>
			</div>
				</a>';
			}
		}
		echo $output;
	}

	public function galleryfetch($event_id)
	{
		$output = '';

		$search = $_GET['title'];

		if ($search) {
			$tbl_gallery = $this->mymodel->selectWithQuery("SELECT a.*, b.imagegroup_id FROM master_imagegroup a INNER JOIN tbl_gallery b ON a.id = b.imagegroup_id WHERE a.public = 'ENABLE' AND a.id_event = '.$event_id.' AND a.value LIKE '%" . $_GET['title'] . "%' GROUP BY b.imagegroup_id ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
		} else {
			$tbl_gallery = $this->mymodel->selectWithQuery('SELECT a.*, b.imagegroup_id FROM master_imagegroup a INNER JOIN tbl_gallery b ON a.id = b.imagegroup_id WHERE a.public = "ENABLE" AND a.id_event = ' . $event_id . ' GROUP BY b.imagegroup_id ORDER BY id DESC LIMIT ' . $this->input->post('limit') . ' OFFSET ' . $this->input->post('start'));
		}
		if ($tbl_gallery) {
			foreach ($tbl_gallery as $row) {
				$main_image = $this->mymodel->selectDataOne('file', array('table_id' => $row['id'], 'table' => 'master_gallery'));
				$imagecount = $this->mymodel->selectWithQuery('SELECT count(id) as imagecount from tbl_gallery WHERE status = "ENABLE" AND imagegroup_id = ' . $row['id']);

				$value = strlen($row["value"]) > 20 ? substr($row["value"], 0, 20) . "..." : $row["value"];

				$output .= '
                <div class="col-xs-6">
                    <a href="' . base_url('gallery/view/') . $row['id'] . '" class="a_black">
                        <div class="box">
                        <img class="img-even" src="' . $main_image['url'] . '">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12" align="center">
										<b style="font-size:15px">' . $value . '</b><br>
                                    </div>
                                    <div class="col-xs-12" align="center">
									Total : <b>' . $imagecount[0]['imagecount'] . '</b> <img src="'.base_url('assets/flaticon/sidebar_picture.png').'" style="display: unset; width: 15px; height: 15px; margin-bottom: 3px;" /> Gambar
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

	public function rank($id)
	{
		$data['page'] = 'Event';
		$data['tbl_event'] = $this->mymodel->selectDataone('tbl_event',  array('id' => $id));
		$data['file'] = $this->mymodel->selectDataone('file',  array('table_id' => $id, 'table' => 'tbl_event'));

		$data['register_id'] = $this->mymodel->selectDataone('tbl_event_register', array('event_id' => $data['tbl_event']['id']));
		$data['rowteam'] = $this->mymodel->selectWithQuery("SELECT count(team_id) as rowteam from tbl_event_register WHERE event_id = '" . $id . "' AND approve = 'APPROVE' AND team_id NOT LIKE '0'");
		$data['rowraider'] = $this->mymodel->selectWithQuery("SELECT count(a.id) as rowraider from tbl_event_register_raider a INNER JOIN tbl_event_register b ON a.event_register_id = b.id WHERE b.event_id = " . $id." AND b.approve = 'APPROVE' ");

		$data['subpage'] = '<b>' . $data['tbl_event']['title'] . '</b>';
		$this->template->load('template/template', 'event/rank', $data);
	}

	public function rankfetch($id)
	{
		$output = '';

		$tbl_paket = $this->mymodel->selectWithQuery('SELECT * FROM tbl_paket WHERE id_event = ' . $id . ' ORDER BY id LIMIT ' . $this->input->post('limit') . ' OFFSET ' . $this->input->post('start'));
		if ($tbl_paket) {
			foreach ($tbl_paket as $row) {
				$rankDetail = '';
				$fileRank = $this->mymodel->selectDataone('file', array('table_id' => $row['id'], 'table' => 'paket_file'));
				$tbl_paket_detail = $this->db->order_by('number', 'ASC')->get_where('tbl_paket_detail', array('id_paket' => $row['id']))->result_array();

				if ($tbl_paket_detail) {
					foreach ($tbl_paket_detail as $row_detail) {
						$team = $this->mymodel->selectDataone('tbl_team', array('id' => $row_detail['id_team']));
						$fileteam = $this->mymodel->selectDataone('file', array('table_id' => $team['id'], 'table' => 'tbl_team'));

						$rider = $this->mymodel->selectDataone('tbl_raider', array('id' => $row_detail['id_raider']));

						$filerider = $this->mymodel->selectDataone('file', array('table_id' => $rider['id'], 'table' => 'tbl_raider'));

						if ($team != null) {
							$phototeam = '<img src="' . base_url('webfiles/team/team_default.png') . '" width="50px" height="50px" style="border-radius:5px"><br>' . $team['name'];
							if ($fileteam != null) {
								$phototeam = '<img src="' . $fileteam['url'] . '" width="50px" height="50px" style="border-radius:5px"><br>' . $team['name'];
							}
						} else {
							$phototeam = '<i>Tidak Terdaftar Team</i>';
						}

						if ($rider != null) {
							$photorider = '<img src="' . base_url('webfiles/raider/raider_default.png') . '" width="50px" height="50px" style="border-radius:5px"><br>' . $rider['name'];
							if ($filerider != null) {
								$photorider = '<img src="' . $filerider['url'] . '" width="50px" height="50px" style="border-radius:5px"><br>' . $rider['name'];
							}
						} else {
							$photorider = '<i>-</i>';
						}


						$rankDetail .= '<tr>
					<td>' . $row_detail['number'] . '</td>
					<td align="center">' . $phototeam . '</td>
					<td align="center">' . $photorider . '</td>
					<td>' . $row_detail['keterangan'] . '</td>
					</tr>';
					}
				} else {
					$rankDetail .= '<tr>
					<td colspan="4" align="center">Tidak ada Data</td>
					</tr>';
				}

				$filedownload = '';

				if ($fileRank) {
					$filedownload = '<a href="' . base_url('download/downloadPDFPaket/') . $fileRank['id'] . '">
						<button class="btn btn-lg btn-block btn-info btn-daftar" style="margin-bottom: 15px">
							<img src="'.base_url('assets/flaticon/download.png').'" style="display: unset; width: 15px; height: 15px; margin-bottom: 5px;" />  Download
						</button>
					</a>';
				}

				$output .= '
                <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
									<div class="col-xs-12" align="center">
									<h4><b>' . $row['title'] . '</b></h4>
									<table class="table table-hover">
										<thead>
											<th>Juara</th>
											<th>Team</th>
											<th>Rider</th>
											<th>Keterangan</th>
										</thead>
										<tbody>
											' . $rankDetail . '
										</tbody>
									</table>
									' . $filedownload . '
                                    </div>
								</div>
                            </div>
						</div>
                </div>';
			}
		}
		echo $output;
	}

	public function resultregister()
	{
		$data['page'] = 'Event';
		$this->template->load('template/template', 'event/resultregister', $data);
	}
}
