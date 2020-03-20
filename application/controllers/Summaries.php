<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-20
 * Time: 23:43
 * @property Users_model $Users_model
 * @property Tests_model $Tests_model
 */

class Summaries extends CI_Controller
{
    var $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model');
        $this->load->model('Tests_model');

        $this->data['kongetsu_1'] = date('Ym').'01t000000';
        $this->data['kongetsu_0'] = date('Ymd', mktime(23,59,59, date('n')+1, 0, date('Y'))).'t235959';

        $this->data['sengetsu_1'] = date('Ymd', mktime(0,0,0, date('n')-1, 1, date('Y'))).'t000000';
        $this->data['sengetsu_0'] = date('Ymd', mktime(23,59,59, date('n'), 0, date('Y'))).'t235959';

        if (date('n') < 4)
        {
            $this->data['nendo_1'] = date('Ymd', strtotime('first day of april last year')).'t000000';
            $this->data['nendo_0'] = date('Ymd', strtotime('last day of march this year')).'t235959';
            $this->data['sakunendo_1'] = date('Ymd', strtotime('first day of april -2 year')).'t000000';
            $this->data['sakunendo_0'] = date('Ymd', strtotime('last day of march last year')).'t235959';
        }
        else
        {
            $this->data['nendo_1'] = date('Ymd', strtotime('first day of april this year')).'t000000';
            $this->data['nendo_0'] = date('Ymd', strtotime('last day of march next year')).'t235959';
            $this->data['sakunendo_1'] = date('Ymd', strtotime('first day of april last year')).'t000000';
            $this->data['sakunendo_0'] = date('Ymd', strtotime('last day of march this year')).'t235959';
        }
    }

    public function index()
    {
        $users = $this->Users_model->find(NULL, array('directory' => 'ASC'));
        $this->data['users'] = $users;

        // 今週
        $starttime = mktime(0,0,0,date('n'), date('j') - 7, date('Y'));
        $endtime = mktime(23,59,59,date('n'), date('j'), date('Y'));
        $param['datetime >='] = $starttime;
        $param['datetime <='] = $endtime;
        $results = $this->Tests_model->find_results($param);

        $this->data['results'] = $results;

        $this->data['start_date'] = date('Y年 n月 j日 H時 i分 s秒', $starttime);
        $this->data['end_date'] = date('Y年 n月 j日 H時 i分 s秒', $endtime);

        $page_title = "集計";

        $this->data['page_title'] = $page_title;

        $this->load->view('_head');
        $this->load->view('_header');
        $this->load->view('summaries', $this->data);
        $this->load->view('_foot');
    }

    public function user_id($user_id = NULL, $line = 50, $index = 0)
    {
        // 今週
        $param['user_id'] = $user_id;
        $orders['id'] = 'DESC';
        $results = $this->Tests_model->find_results($param, $orders, $line, $index);

        $this->data['results'] = $results;

        $page_title = "生徒ごとの集計 - ";
        if ( ! empty($results[0]['realname']))
        {
            $page_title .= $results[0]['realname'];
        }
        else
        {
            $page_title .= $results[0]['user_name'];
        }
        $this->data['page_title'] = $page_title;

        $this->load->view('_head');
        $this->load->view('_header');
        $this->load->view('summaries', $this->data);
        $this->load->view('_foot');
    }

    public function date($start = NULL, $end = NULL)
    {
        $starttime = strtotime($start);
        $endtime = strtotime($end);
        $param['datetime >='] = $starttime;
        $param['datetime <='] = $endtime;
        $results = $this->Tests_model->find_results($param);

        $this->data['results'] = $results;

        $this->data['start_date'] = date('Y年 n月 j日 H時 i分 s秒', $starttime);
        $this->data['end_date'] = date('Y年 n月 j日 H時 i分 s秒', $endtime);

        $page_title = "日付集計";

        $this->data['page_title'] = $page_title;

        $this->load->view('_head');
        $this->load->view('_header');
        $this->load->view('summaries', $this->data);
        $this->load->view('_foot');
    }

    public function users()
    {
        $users = $this->Users_model->find(NULL, array('directory' => 'ASC'));
        $this->data['users'] = $users;

        $this->load->view('_head');
        $this->load->view('_header');
        $this->load->view('summaries-users', $this->data);
        $this->load->view('_foot');
    }
}