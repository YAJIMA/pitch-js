<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-28
 * Time: 17:36
 */

class Tests_model extends CI_Model
{
    public function find($param = NULL, $orders = array('id' => 'ASC'))
    {
        if ($param !== NULL)
        {
            foreach ($param as $key => $val)
            {
                $this->db->where($key, $val);
            }
            unset($key, $val);
        }

        foreach ($orders as $key => $val)
        {
            $this->db->order_by($key, $val);
        }
        unset($key, $val);

        $this->db->from('Tests');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function add_results($params = NULL)
    {
        foreach ($params as $param)
        {
            $data = array();

            foreach ($param as $key => $val)
            {
                $data[$key] = $val;
            }
            unset($key, $val);

            if (count($data) > 0)
            {
                $this->db->insert('Results', $data);
            }
            else
            {
                return FALSE;
            }
        }
        unset($param);

        return TRUE;
    }

    public function find_results($param = NULL, $orders = array('id' => 'DESC'), $limit = NULL, $offset = 0)
    {
        if ($param !== NULL)
        {
            foreach ($param as $key => $val)
            {
                $this->db->where($key, $val);
            }
            unset($key, $val);
        }
        $this->db->where('results <>', 'N;');

        foreach ($orders as $key => $val)
        {
            $this->db->order_by($key, $val);
        }
        unset($key, $val);

        if ($limit !== NULL)
        {
            $this->db->limit($limit, $offset);
        }

        $this->db->from('Results');
        $this->db->join('Tests', 'Tests.id = Results.test_id', 'left');
        $this->db->join('Users', 'Users.id = Results.user_id', 'left');

        $this->db->select('Results.*, Tests.name as test_name, Tests.parameter, Users.realname, Users.name as user_name');

        $query = $this->db->get();

        $results = $query->result_array();

        foreach ($results as &$item)
        {
            $item['date_format'] = date('Y年m月d日 H時i分s秒', $item['datetime']);
            $item['result_raw'] = unserialize($item['results']);
        }

        return $results;
    }
}