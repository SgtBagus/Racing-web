<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['raider'] = $this->mymodel->selectDataOne('tbl_raider',  array('id' => $this->session->userdata('id')));
		$data['file'] = $this->mymodel->selectDataOne('file',  array('table_id' => $data['raider']['id'], 'table' => 'tbl_raider'));

		$data['team'] = $this->mymodel->selectDataOne('tbl_team',  array('id' => $data['raider']['team_id']));

		if ($data['team'] != 0) {
			$data['file_team'] = $this->mymodel->selectDataOne('file',  array('table_id' => $data['team']['id'], 'table' => 'tbl_team'));
		} else {
			$data['team'] = NULL;
		}

		$data['tbl_event_register'] = $this->mymodel->selectWithQuery("SELECT a.*, b.raider_id, c.title FROM tbl_event_register a INNER JOIN tbl_event_register_raider b ON a.id = b.event_register_id INNER JOIN tbl_event c ON a.event_id = c.id WHERE a.team_id = 0 AND a.approve = 'APPROVE' AND b.raider_id = " . $this->session->userdata('id') . " ORDER BY id DESC");

		$data['title'] = "Dashboard";
		$data['content'] = "dashboard";
		$this->template->load('template/template', 'dashboard/index', $data);
	}

	public function monitoreventrider()
	{
		$data['raider'] = $this->mymodel->selectDataOne('tbl_raider',  array('id' => $this->session->userdata('id')));
		$data['file'] = $this->mymodel->selectDataOne('file',  array('table_id' => $data['raider']['id'], 'table' => 'tbl_raider'));

		$data['tbl_event_register'] = $this->mymodel->selectWithQuery("SELECT a.*, b.raider_id, c.title FROM tbl_event_register a INNER JOIN tbl_event_register_raider b ON a.id = b.event_register_id INNER JOIN tbl_event c ON a.event_id = c.id WHERE a.team_id = 0 AND b.raider_id = " . $this->session->userdata('id') . " ORDER BY id DESC");

		$data['title'] = "Monitor Event";
		$data['content'] = "monitoreventrider";
		$this->template->load('template/template', 'dashboard/index', $data);
	}

	public function account()
	{
		$data['raider'] = $this->mymodel->selectDataOne('tbl_raider',  array('id' => $this->session->userdata('id')));
		$data['file'] = $this->mymodel->selectDataOne('file',  array('table_id' => $data['raider']['id'], 'table' => 'tbl_raider'));
		$data['title'] = "Akun Saya";
		$data['content'] = "account";
		$this->template->load('template/template', 'dashboard/index', $data);
	}

	public function vali_akun()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('dt[name]', '<strong>Nama Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[alamat]', '<strong>Alamat Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[kota]', '<strong>Kota</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[tgllahir]', '<strong>Tanggal Lahir</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[nostart]', '<strong>Nomor Start</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[namajersey]', '<strong>Nama Di Jersey</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[nowa]', '<strong>Nomor Wa</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[motor_id]', '<strong>Nama Motor</strong> Mohon Di Pilih', 'required');
		$this->form_validation->set_rules('dt[goldarah]', '<strong>Golongan Darah</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_message('required', '%s');
	}

	public function editaccount()
	{
		$this->vali_akun();
		if ($this->form_validation->run() == FALSE) {
			$this->alert->alertdanger(validation_errors());
		} else {
			$id = $_POST['id'];
			$dt = $_POST['dt'];
			$dt['updated_at'] = date("Y-m-d H:i:s");
			$this->mymodel->updateData('tbl_raider', $dt, array('id' => $id));

			$this->alert->alertsuccess('Success Send Data');
		}
	}


	public function passwordvalidate()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('newpassword', '<strong>Password Baru</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('conf_newpassword', '<strong>Konfrimasi Password Baru</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('lastpassword', '<strong>Konfirmasi Password Lama</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_message('required', '%s');
	}

	public function editpassword()
	{
		$this->passwordvalidate();
		if ($this->form_validation->run() == FALSE) {
			$this->alert->alertdanger(validation_errors());
		} else {
			$id = $this->session->userdata('id');
			$newPassword = md5($_POST['newpassword']);
			if ($_POST['newpassword'] != $_POST['conf_newpassword']) {
				$this->alert->alertdanger('<strong>Password Baru</strong> & <strong>Konfirmasi Password</strong> harus Sama !');
				return FALSE;
			} else {
				$password = $this->mymodel->selectDataOne('tbl_team', array('id' => $id));
				$lastPassword = md5($_POST['lastpassword']);
				if ($lastPassword != $password['password']) {
					$this->alert->alertdanger('Masukan <strong>Password Lama</strong> anda dengan benar');
					return FALSE;
				} else {
					$dt['password'] = $newPassword;
					$this->mymodel->updateData('tbl_raider', $dt, array('id' => $id));
				}
			}
			$this->alert->alertsuccess('Success Send Data');
		}
	}
	
	public function editphoto()
	{
		$id = $this->session->userdata('id');
		if (!empty($_FILES['file']['name'])) {
			$dir  = "webfiles/raider/";
			$config['upload_path']          = $dir;
			$config['allowed_types']        = '*';
			$config['file_name']           = md5('smartsoftstudio') . rand(1000, 100000);

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file')) {
				$error = $this->upload->display_errors();
				$this->alert->alertdanger($error);
			} else {
				$file = $this->upload->data();
				$data = array(
					'name' => $file['file_name'],
					'mime' => $file['file_type'],
					'dir' => $dir . $file['file_name'],
					'table' => 'tbl_raider',
					'table_id' =>  $id,
					'url' => base_url() . $dir . $file['file_name'],
					'status' => 'ENABLE',
					'created_at' => date('Y-m-d H:i:s')
				);
				$file = $this->mymodel->selectDataone('file', array('table_id' => $id, 'table' => 'tbl_raider'));
				if ($file['name'] != "raider_default.png") {
					@unlink($file['dir']);
				}

				if ($file != null) {
					$this->mymodel->updateData('file', $data, array('table_id' =>  $id, 'table' => 'tbl_raider'));
				} else {
					$this->mymodel->insertData('file', $data);
				}
			}
			$this->alert->alertsuccess('Success Send Data');
		}
	}
}
