<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-24
 * Time: 1:10
 *
 * @property Users_model $Users_model
 * @property Tests_model $Tests_model
 * @property Settings_model $Settings_model
 */

class Practice extends CI_Controller
{
    var $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model');
        $this->load->model('Tests_model');
        $this->load->model('Settings_model');

        $this->data['settings'] = $settings = $this->Settings_model->load();
    }

    public function index()
    {

    }

    public function end1()
    {
        $this->load->helper('email');

        // テスト結果をDBに登録
        $score = 0;
        foreach ($this->session->score as $item)
        {
            if ($item['result'] == "ok")
            {
                $score++;
            }
        }
        $param = array();
        $param[] = array(
            'user_id' => $this->session->id,
            'test_id' => $this->session->test_id,
            'datetime' => $this->session->start_time,
            'score' => $score,
            'results' => serialize($this->session->score)
        );
        $this->Tests_model->add_results($param);

        $this_users = $this->Users_model->find(array('id'=>$this->session->id),array('name' => 'ASC'));
        $this_user = $this_users[0];

        // テスト結果をメール送信
        if (isset($settings['admin_email']))
        {
            $subject = $settings['result_subject'];
            $body = $settings['result_body'];
            $result_date = date('Y-m-d H:i:s', $this->session->start_time);
            if ( ! empty($this_user['realname']))
            {
                $result_name = $this_user['realname'];
            }
            else
            {
                $result_name = $this_user['name'];
            }

            $result_result = '';
            foreach ($this->session->score as $key => $val)
            {
                $result_result .= '第'.$key.'問目 '.PHP_EOL;
                $result_result .= '問題 : '.$val['mondai'].' ';
                $result_result .= '回答 : '.$val['ans'].' ';
                $result_result .= '正誤 : '.$val['result'].PHP_EOL;
                $result_result .= PHP_EOL;
            }
            unset($key,$val);

            $body = str_replace('<NAME>', $result_name, $body);
            $body = str_replace('<DATE>', $result_date, $body);
            $body = str_replace('<RESULT>', $result_result, $body);

            HBsendMail($settings['admin_email'], $subject, $body, 'noreply@ichionkai.jp', '音感テスト');
        }

        // テスト結果を別名セッションに登録
        $this->session->set_userdata('oldscore', $this->session->score);

        // テスト結果をクリア
        $array_items = array('score', 'counts', 'start_time', 'test_id');
        $this->session->unset_userdata($array_items);

        $this->load->view('practice-end1', $this->data);
    }

    public function p1($parameter = NULL, $count = 10)
    {

        // TODO: 問題解答
        $_mondai = $this->input->post('mondai');
        $_ans = $this->input->post('ans');
        $result = '';
        $counter = 0;

        $this->session->unset_userdata(array('oldscore'));

        if ( ! empty($_mondai) && ! empty($_ans))
        {

            // カウンター（問題数）
            $counter = $this->session->counts;
            if (empty($counter))
            {
                // 回答が初めて送信されたらそれを1回とする
                $counter = 1;
                $this->session->set_userdata('start_time', time());
            }
            else
            {
                // 問題数をカウントアップ
                $counter++;
            }

            // スコアをセッションからロード
            $score = $this->session->score;

            if (empty($score))
            {
                // スコアの初期化
                $score = array();
            }

            $score[$counter]['mondai'] = $_mondai;
            $score[$counter]['ans'] = $_ans;

            if ($_mondai === $_ans)
            {
                // 正解
                $score[$counter]['result'] = 'ok';
                $result = 'ok';
            }
            else
            {
                // 間違い
                $score[$counter]['result'] = 'ng';
                $result = 'ng';
            }

            // スコアをセッションに登録
            $this->session->set_userdata('score', $score);

            // 問題数と回答数が異なっていたら初期化
            if (count($score) !== $counter)
            {
                $array_items = array('score', 'counts', 'start_time');
                $this->session->unset_userdata($array_items);
                redirect('practice/p1/'.$parameter.'/'.$count);
            }
        }

        // カウンター（問題数）
        $this->session->set_userdata('counts', $counter);

        // 回答が揃ったら、結果ページへ
        if (count($this->session->score) >= $count)
        {
            // 結果ページへ
            redirect('practice/end1');
        }

        switch ($parameter)
        {
            case "octave3":
                $audios = array(
                    "do3", "cis3", "re3", "es3", "mi3", "fa3", "fis3", "so3", "gis3", "la3", "b3", "si3", 
                );
                $this->data['octaves'] = array(3);
                break;
            case "octave2-4":
                $audios = array(
                    "do2", "cis2", "re2", "es2", "mi2", "fa2", "fis2", "so2", "gis2", "la2", "b2", "si2",
                    "do3", "cis3", "re3", "es3", "mi3", "fa3", "fis3", "so3", "gis3", "la3", "b3", "si3",
                    "do4", "cis4", "re4", "es4", "mi4", "fa4", "fis4", "so4", "gis4", "la4", "b4", "si4",
                );
                $this->data['octaves'] = array(4,3,2);
                break;
            case "octave1-5":
                $audios = array(
                    "do1", "cis1", "re1", "es1", "mi1", "fa1", "fis1", "so1", "gis1", "la1", "b1", "si1",
                    "do2", "cis2", "re2", "es2", "mi2", "fa2", "fis2", "so2", "gis2", "la2", "b2", "si2",
                    "do3", "cis3", "re3", "es3", "mi3", "fa3", "fis3", "so3", "gis3", "la3", "b3", "si3",
                    "do4", "cis4", "re4", "es4", "mi4", "fa4", "fis4", "so4", "gis4", "la4", "b4", "si4",
                    "do5", "cis5", "re5", "es5", "mi5", "fa5", "fis5", "so5", "gis5", "la5", "b5", "si5",
                );
                $this->data['octaves'] = array(5,4,3,2,1);
                break;
            default:
                if ( ! empty($this->session->name) && ! empty($this->session->directory))
                {
                    $uri = sprintf('enter/%s/%s', $this->session->directory, $this->session->name);
                }
                else
                {
                    $uri = 'enter';
                }
                redirect($uri);
                break;
        }

        $this_tests = $this->Tests_model->find(array('parameter' => $parameter), array('id' => 'ASC'));
        $this->session->set_userdata('test_id', $this_tests[0]['id']);

        $seed = rand(0, count($audios)-1);
        $mondai = $audios[$seed];
        $this_octave = substr($mondai, -1, 1);

        $this->data['this_octave'] = $this_octave;
        $this->data['mondai'] = $mondai;
        $this->data['audios'] = $audios;
        $this->data['result'] = $result;

        $this->load->view('practice-p1', $this->data);
    }
}

/**
ド       do
ド♯      cis
レ       re
ミ♭      es
ミ       mi
ファ      fa
ファ♯     fis
ソ       so
ソ♯      gis
ラ       la
シ♭      b
シ       si
 */