<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['page'] = 'Login';
		$this->template->load('template/template', 'login/index', $data);
	}

	public function rider()
	{
		$data['page'] = 'Login';
		$this->template->load('template/template', 'login/rider', $data);
	}

	public function act_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$pass = md5($password);

		$session     = $this->mlogin->login($email, $pass);
		if ($session) {
			$this->session->set_userdata('session_sop', true);
			$this->session->set_userdata('id', $session['id']);
			$this->session->set_userdata('email', $session['email']);
			$this->session->set_userdata('name', $session['name']);
			$this->session->set_userdata('role', 'Team');
			echo "success";
			return TRUE;
		} else {
			$this->alert->alertdanger("Cek Kembali Email dan Password anda !");
			return FALSE;
		}
	}

	public function act_login_rider()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$pass = md5($password);
		$session     = $this->mlogin->loginrider($email, $pass);
		if ($session) {
			$this->session->set_userdata('session_sop', true);
			$this->session->set_userdata('id', $session['id']);
			$this->session->set_userdata('email', $session['email']);
			$this->session->set_userdata('name', $session['name']);
			$this->session->set_userdata('role', 'Rider');
			echo "success";
			return TRUE;
		} else {
			$this->alert->alertdanger("Cek Kembali Email dan Password anda !");
			return FALSE;
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		header('Location: ' . base_url('login'));
	}

	public function logoutRider()
	{
		$this->session->sess_destroy();
		header('Location: ' . base_url('login/rider'));
	}
	
	public function register()
	{
		$data['page'] = 'Daftar';
		$this->template->load('template/template', 'login/register', $data);
	}

	public function registerrider()
	{
		$data['page'] = 'Daftar';
		$this->template->load('template/template', 'login/registerrider', $data);
	}

	public function validate()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('dt[name]', '<strong>Nama Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[email]', '<strong>Email Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('password', '<strong>Password</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('confirmpassword', '<strong>Konfirmasi Password</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[alamat]', '<strong>Alamat Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[kota]', '<strong>Kota Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[nowa]', '<strong>Nomor Wa</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_message('required', '%s');
	}

	public function actionRegister()
	{
		$this->validate();
		if ($this->form_validation->run() == FALSE) {
			$this->alert->alertdanger(validation_errors());
		} else {
			$email_query = $this->mymodel->selectDataone('tbl_team', array('email' => $_POST['dt']['email']));
			if ($email_query != null) {
				$this->alert->alertdanger('<strong>Email</strong> tersebut sudah Terdaftar');
				return false;
			} else if ($_POST['password'] != $_POST['confirmpassword']) {
				$this->alert->alertdanger('<strong>Password</strong> & <strong> Konfirmasi Password </strong> tidak sama !');
				return false;
			} else {
				$dt = $_POST['dt'];
				$dt['password'] = md5($_POST['password']);
				$dt['verificacion'] = "DISABLE";
				$dt['status'] = "ENABLE";
				$dt['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('tbl_team', $dt);

				$file['name'] = 'team_default.png';
				$file['mime'] = 'image/png';
				$file['dir'] = 'webfiles/team/team_default.png';
				$file['table'] = 'tbl_team';
				$file['table_id'] = $this->db->insert_id();
				$file['url'] = base_url() . $file['dir'];
				$file['status'] = 'ENABLE';
				$file['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('file', $file);

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
		
				$name = "Team - ".$_POST['dt']['name'];
				$toemail = $_POST['dt']['email'];
				$fromemail = 'nso@dev.karyastudio.com';
				$fromname = 'Never Say Old - Admin';
				$subjectemail = 'Terima Kasih Telah Mendaftar Di Never Say Old!';
				$this->sendemail->register($name, $toemail, $fromemail, $fromname, $subjectemail);

				$session     = $this->mlogin->login($_POST['dt']['email'], md5($_POST['password']));
				$this->session->set_userdata('session_sop', true);
				$this->session->set_userdata('id', $session['id']);
				$this->session->set_userdata('email', $session['email']);
				$this->session->set_userdata('name', $session['name']);
				$this->session->set_userdata('role', 'Team');

				$this->alert->alertsuccess('Akun Team Berhasil Terdaftar anda akan di arahkan ke halaman utama');
			}
		}
	}

	public function validateRider()
	{
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('dt[name]', '<strong>Nama</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[email]', '<strong>Email</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('password', '<strong>Password</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('confirmpassword', '<strong>Konfirmasi Password</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[alamat]', '<strong>Alamat Tim</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[tgllahir]', '<strong>Tanggal Lahir</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[nostart]', '<strong>Nomor Start</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[namajersey]', '<strong>Nama di Jersey</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[nowa]', '<strong>Nomor Wa</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_rules('dt[goldarah]', '<strong>Golongan Darah</strong> Tidak Boleh Kosong', 'required');
		$this->form_validation->set_message('required', '%s');
	}

	public function actionRegisterRider()
	{
		$this->validateRider();
		if ($this->form_validation->run() == FALSE) {
			$this->alert->alertdanger(validation_errors());
		} else {

			if ($_POST['password'] != $_POST['confirmpassword']) {
				$this->alert->alertdanger('<strong>Password</strong> & <strong> Konfirmasi Password </strong> tidak sama !');
				return false;
			}

			$email_query = $this->mymodel->selectDataone('tbl_raider', array('email' => $_POST['dt']['email']));
			if ($email_query) {
				if ($email_query['team_id']) {
					$dt = $_POST['dt'];
					$dt['team_id'] = $email_query['team_id'];
					$dt['eventikut'] = $email_query['eventikut'];
					$dt['password'] = md5($_POST['password']);
					$dt['updated_at'] = date('Y-m-d H:i:s');
					$this->mymodel->updateData('tbl_raider', $dt, array('id' => $email_query['id']));

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
			
					$name = "Rider - ".$_POST['dt']['name'];
					$toemail = $_POST['dt']['email'];
					$fromemail = 'nso@dev.karyastudio.com';
					$fromname = 'Never Say Old - Admin';
					$subjectemail = 'Terima Kasih Telah Mendaftar Di Never Say Old!';
					$this->sendemail->register($name, $toemail, $fromemail, $fromname, $subjectemail);	

					$session     = $this->mlogin->loginrider($_POST['dt']['email'], md5($_POST['password']));
					$this->session->set_userdata('session_sop', true);
					$this->session->set_userdata('id', $session['id']);
					$this->session->set_userdata('email', $session['email']);
					$this->session->set_userdata('name', $session['name']);
					$this->session->set_userdata('role', 'Rider');
					$this->alert->alertsuccess('Akun Rider Berhasil Terdaftar anda akan di arahkan ke halaman utama');
					return false;
				} else {
					$this->alert->alertdanger('<strong>Email</strong> tersebut sudah Terdaftar');
					return false;
				}
			} else {
				$dt = $_POST['dt'];
				$dt['team_id'] = 0;
				$dt['eventikut'] = 0;
				$dt['password'] = md5($_POST['password']);
				$dt['verificacion'] = 'DISABLE';
				$dt['status'] = 'ENABLE';
				$dt['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('tbl_raider', $dt);

				$file['name'] = 'raider_default.png';
				$file['mime'] = 'image/png';
				$file['dir'] = 'webfiles/raider/raider_default.png';
				$file['table'] = 'tbl_raider';
				$file['table_id'] = $this->db->insert_id();
				$file['url'] = base_url() . $file['dir'];
				$file['status'] = 'ENABLE';
				$file['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('file', $file);

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
		
				$name = "Rider - ".$_POST['dt']['name'];
				$toemail = $_POST['dt']['email'];
				$fromemail = 'nso@dev.karyastudio.com';
				$fromname = 'Never Say Old - Admin';
				$subjectemail = 'Terima Kasih Telah Mendaftar Di Never Say Old!';
				$this->sendemail->register($name, $toemail, $fromemail, $fromname, $subjectemail);	


				$session     = $this->mlogin->loginrider($_POST['dt']['email'], md5($_POST['password']));
				$this->session->set_userdata('session_sop', true);
				$this->session->set_userdata('id', $session['id']);
				$this->session->set_userdata('email', $session['email']);
				$this->session->set_userdata('name', $session['name']);
				$this->session->set_userdata('role', 'Rider');

				$this->alert->alertsuccess('Akun Rider Berhasil Terdaftar anda akan di arahkan ke halaman utama');
			}
		}
	}
}
