<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-14
 * Time: 23:06
 *
 * @property Users_model $Users_model
 */

class Enter extends CI_Controller
{
    var $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model');

    }

    public function index()
    {

    }

    public function user($dir_name = NULL, $user_name = NULL)
    {
        if ( ! empty($_SERVER['PHP_AUTH_USER']))
        {
            $user_name = $_SERVER['PHP_AUTH_USER'];
        }

        if (empty($user_name))
        {
            redirect('enter/error');
        }

        // TODO: ユーザIDをDB登録＆参照
        $param['name'] = $user_name;
        $param['directory'] = $dir_name;
        $this->Users_model->add($param);

        $users = $this->Users_model->find($param);
        $this_user_data = $users[0];

        $this->data['user'] = $this_user_data;
        $this->session->set_userdata($this_user_data);

        // 問題設定をロード
        $this->data['test_sets'] = $this->Users_model->find_testset_from_user($this_user_data['id']);

        // TODO: ユーザページを表示
        $this->load->view('enter', $this->data);
    }

    public function error($kind = NULL)
    {
        $this->load->view('error', $this->data);
    }

    public function aroundregi()
    {
        $this->load->helper('file');
        $this->load->helper('directory');

        // $dir = '/home/sites/heteml/users/i/c/h/ichionkai/web/ichionkai.jp/drp/user';
        $dir = dirname( dirname(APPPATH)) . DIRECTORY_SEPARATOR . "new_drp" . DIRECTORY_SEPARATOR . "user";
        echo $dir . '<br>' . PHP_EOL;

        $directory_map = directory_map($dir, 2,TRUE);
        // echo print_r($directory_map); exit();

        // ファイル一覧を作成
        $filepathes = array();
        foreach ($directory_map as $key => $val)
        {
            if (is_array($val))
            {
                foreach ($val as $v)
                {
                    // .htpasswdファイルのみ
                    if ($v == ".htpasswd")
                    {
                        // echo $key . $v . PHP_EOL;
                        // ex. "user_b0775junzo/.htpasswd"
                        $filepathes[] = $key . $v;
                    }
                }
                unset($v);
            }
        }
        unset($key, $val);

        // ファイル一覧からユーザー登録処理
        foreach ($filepathes as $filepath)
        {
            if (($handle = fopen($dir.DIRECTORY_SEPARATOR.$filepath, "r")) !== FALSE)
            {
                while (($data = fgetcsv($handle, 1000, ":")) !== FALSE)
                {
                    //$num = count($data);
                    //echo "<p> $num fields in line $row: <br /></p>\n";
                    //$row++;
                    //for ($c=0; $c < $num; $c++) {
                    //    echo $data[$c] . "<br />\n";
                    //}

                    // "kitkat"はスルー
                    if ( isset($data[0]) && $data[0] !== "kitkat")
                    {
                        $param = array(
                            'name' => $data[0],
                            'directory' => dirname($filepath),
                            'filepath' => $dir.DIRECTORY_SEPARATOR.$filepath
                        );

                        $this->Users_model->add($param);
                    }
                }
                fclose($handle);
            }
        }

        $result = $this->Users_model->find();

        // echo print_r($result);
        foreach ($result as $res)
        {
            echo 'ID.' . $res['id'] . ', name : ' . $res['name'] . ', directory : ' . $res['directory'] . ', filepath : ' . $res['filepath'] . '<br>' . PHP_EOL;
        }

        echo '終了' . '<br>' . PHP_EOL;
    }
}