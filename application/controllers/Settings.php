<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Settings
 *
 * do re mi fa so la si
 * cis es fis gis b
 *
 * @property Users_model $Users_model
 * @property Tests_model $Tests_model
 * @property Settings_model $Settings_model
 */
class Settings extends CI_Controller {

    var $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model');
        $this->load->model('Tests_model');
        $this->load->model('Settings_model');

        $this->data['settings'] = $this->Settings_model->load();
    }

	public function index()
	{
	    $this->load->database();
        $this->load->view('_head');
        $this->load->view('_header');
        $this->load->view('settings');
        $this->load->view('_foot');
	}

	public function problems()
    {
        if ( $this->input->method(TRUE) === "POST" )
        {
            $user_id = $this->input->post('user_id');
            $param = array();

            foreach ($this->input->post('test_id') as $test_id)
            {
                $param[] = array(
                    'user_id' => $user_id,
                    'test_id' => $test_id,
                );
            }

            if (count($param) > 0)
            {
                $this->Users_model->add_testset($param,$user_id);
            }
        }



        // 問題一覧
        $tests = $this->Tests_model->find(NULL, array('id'=>'ASC'));

        // ユーザ一覧
        $users = $this->Users_model->find(NULL, array('name'=>'ASC'));

        foreach ($users as &$user)
        {
            $user['tests'] = $this->Users_model->find_testset_from_user($user['id']);
        }
        unset($user);

        $this->data['users'] = $users;

        $this->data['tests'] = $tests;

        $this->load->view('_head');
        $this->load->view('_header');
        $this->load->view('settings-problems', $this->data);
        $this->load->view('_foot');
    }

    public function users()
    {
        if ( $this->input->method(TRUE) === "POST" )
        {
            $user_id = $this->input->post('user_id');
            $realname = $this->input->post('realname');
            $param = array();

            if ( ! empty($realname))
            {
                $param = array('realname' => $this->input->post('realname'));

                $this->Users_model->update_users($param, array('id' => $user_id));
            }

        }

        // ユーザ一覧
        $users = $this->Users_model->find(NULL, array('name'=>'ASC'));
        $this->data['users'] = $users;

        $this->load->view('_head', $this->data);
        $this->load->view('_header', $this->data);
        $this->load->view('settings-users', $this->data);
        $this->load->view('_foot', $this->data);
    }

    public function summaries()
    {
        $this->load->view('_head', $this->data);
        $this->load->view('_header', $this->data);
        $this->load->view('settings-summaries', $this->data);
        $this->load->view('_foot', $this->data);
    }

    public function commons()
    {
        if ( $this->input->method(TRUE) === "POST" )
        {
            $params = array();

            $admin_email = $this->input->post('admin_email');
            $params[] = array(
                'name' => 'admin_email',
                'strvalue' => $admin_email
            );
            $result_subject = $this->input->post('result_subject');
            $params[] = array(
                'name' => 'result_subject',
                'strvalue' => $result_subject
            );
            $result_body = $this->input->post('result_body');
            $params[] = array(
                'name' => 'result_body',
                'strvalue' => $result_body
            );

            $this->Settings_model->upsert($params);

            // 設定をリロード
            $this->data['settings'] = $this->Settings_model->load();
        }

        $this->load->view('_head', $this->data);
        $this->load->view('_header', $this->data);
        $this->load->view('settings-commons', $this->data);
        $this->load->view('_foot', $this->data);
    }
    /**
     * @param int $count
     */
	public function toi1($count = 0)
    {
        $data = array();
        $mondai = ['C3','C#3','D3','D#3','E3','F3','F#3','G3','G#3','A3','A#3','B3'];
        $seed = rand(0, count($mondai)-1);

        $data['mondai'] = $mondai[$seed];
        $data['count'] = $count + 1;

        $this->load->view('testpage-toi1', $data);
    }
}
