<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-15
 * Time: 1:12
 */

class Users_model extends CI_Model
{

    public function add($param = NULL)
    {
        foreach ($param as $key => $val)
        {
            $data[$key] = $val;
            $this->db->where($key, $val);
        }
        unset($key, $val);

        if ($this->db->count_all_results('Users') === 0)
        {
            $this->db->insert('Users', $data);
        }

        return TRUE;
    }

    public function update_users($param = NULL, $where = NULL)
    {
        if (is_array($where))
        {
            foreach ($where as $key => $val)
            {
                $this->db->where($key, $val);
            }
            unset($key, $val);

            $this->db->update('Users', $param);

            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function add_testset($params = NULL, $user_id = NULL)
    {
        if ( ! empty($user_id))
        {
            $this->db->where('user_id', $user_id);
            $this->db->delete('Testsets');
        }

        foreach ($params as $param)
        {
            $data = array();
            foreach ($param as $key => $val)
            {
                $data[$key] = $val;
            }
            unset($key, $val);
            $this->db->insert('Testsets', $data);
        }
        unset($param);

        return TRUE;
    }

    public function find($param = NULL, $orders = array('name' => 'ASC'))
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

        $this->db->from('Users');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function find_testset_from_user($user_id = NULL)
    {
        $results = array();

        $this->db->select('Tests.name, Tests.parameter, Tests.id');

        if ( ! empty($user_id))
        {
            $this->db->where('Testsets.user_id', $user_id);
        }

        $this->db->from('Testsets');
        $this->db->join('Tests', 'Tests.id = Testsets.test_id', 'left');

        $query = $this->db->get();
        $results = $query->result_array();

        return $results;
    }

    public function find_result_from_user($user_id = NULL)
    {
        $results = array();

        $this->db->from('Results');

        if ( ! empty($user_id))
        {
            $this->db->where('user_id', $user_id);
        }

        $query = $this->db->get();
        $results = $query->result_array();

        return $results;
    }
}