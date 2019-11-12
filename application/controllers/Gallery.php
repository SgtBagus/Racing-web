<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page'] = 'Gallery';
        $this->template->load('template/template', 'gallery/index', $data);
    }

    public function view($id)
    {
        $data['page'] = 'Gallery';
        $data['id'] = $this->mymodel->selectDataone('master_imagegroup', array('id' => $id));
        $data['main_image'] = $this->mymodel->selectDataOne('file', array('table_id' => $data['id']['id'], 'table' => 'master_gallery'));
        $data['subpage'] = '<b>' . $data['id']['value'] . '</b>';

        $data['tbl_comment'] = $this->mymodel->selectWithQuery('SELECT * FROM tbl_comment WHERE imagegroup_id = ' . $id . ' ORDER BY created_at DESC LIMIT 3');

        $this->template->load('template/template', 'gallery/view', $data);
    }


    public function fetch()
    {
        $output = '';

        $search = $_GET['title'];

        if ($search) {
            $tbl_gallery = $this->mymodel->selectWithQuery("SELECT a.*, b.imagegroup_id FROM master_imagegroup a INNER JOIN tbl_gallery b ON a.id = b.imagegroup_id WHERE a.public = 'ENABLE' AND a.value LIKE '%" . $_GET['title'] . "%' GROUP BY b.imagegroup_id ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
        } else {
            $tbl_gallery = $this->mymodel->selectWithQuery('SELECT a.*, b.imagegroup_id FROM master_imagegroup a INNER JOIN tbl_gallery b ON a.id = b.imagegroup_id WHERE a.public = "ENABLE" GROUP BY b.imagegroup_id ORDER BY id DESC LIMIT ' . $this->input->post('limit') . ' OFFSET ' . $this->input->post('start'));
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
                                    <b style="font-size:11px">' . $value . '</b><br>
                                    </div>
                                    <div class="col-xs-12" align="center">
									    Total : <b>' . $imagecount[0]['imagecount'] . '</b> <img src="' . base_url('assets/flaticon/sidebar_picture.png') . '" style="display: unset; width: 15px; height: 15px; margin-bottom: 3px;" /> Gambar
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

    public function fetchview($id)
    {
        $output = '';

        $search = $_GET['title'];

        if ($search) {
            $tbl_gallery = $this->mymodel->selectWithQuery("SELECT * FROM tbl_gallery WHERE imagegroup_id = '" . $id . "' AND title LIKE '%" . $_GET['title'] . "%' ORDER BY id DESC LIMIT " . $this->input->post('limit') . " OFFSET " . $this->input->post('start'));
        } else {
            $tbl_gallery = $this->mymodel->selectWithQuery('SELECT * FROM tbl_gallery WHERE imagegroup_id = ' . $id . ' ORDER BY id DESC LIMIT ' . $this->input->post('limit') . ' OFFSET ' . $this->input->post('start'));
        }
        if ($tbl_gallery) {
            foreach ($tbl_gallery as $row) {
                $file =  $this->mymodel->selectDataOne('file', array('table_id' => $row['id'], 'table' => 'tbl_gallery'));

                $output .= '
                <div class="col-xs-12">
                    <div class="box">
                    <img src="' . $file['url'] . '" style="width:100%; border-radius:15px">
                    </div>
                </div>';
            }
        }
        echo $output;
    }

    public function comment()
    {
        $dt = $_POST['dt'];
        $dt['id_raider'] = $this->session->userdata('id');
        $dt['status'] = "ENABLE";
        $dt['created_at'] = date('Y-m-d H:i:s');
        $str = $this->db->insert('tbl_comment', $dt);

        $this->alert->alertsuccess('Success Send Data');
    }

    public function commentview($id)
    {
        $data['page'] = 'Gallery';
        $data['id'] = $this->mymodel->selectDataone('master_imagegroup', array('id' => $id));
        $data['main_image'] = $this->mymodel->selectDataOne('file', array('table_id' => $data['id']['id'], 'table' => 'master_gallery'));
        $data['subpage'] = '<b>' . $data['id']['value'] . '</b>';

        $this->template->load('template/template', 'gallery/commentview', $data);
    }
}
