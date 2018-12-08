<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-9月-29
 * Time: 16:17
 */

class Settings_model extends CI_Model
{
    public function load()
    {
        $result = array();

        $this->db->from('Settings');
        $query = $this->db->get();

        foreach ($query->result_array() as $item)
        {
            if ( ! empty($item['strvalue']))
            {
                $result[$item['name']] = $item['strvalue'];
            }
            else
            {
                $result[$item['name']] = $item['numvalue'];
            }
        }

        return $result;
    }

    public function find($param = NULL, $orders = array('id' => 'DESC'))
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

        $this->db->from('Settings');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function upsert($params = NULL)
    {
        foreach ($params as $param)
        {
            $data = array();

            foreach ($param as $key => $val)
            {
                $data[$key] = $val;
            }
            unset($key, $val);

            $this->db->replace('Settings', $data);

        }
        unset($param);

        return TRUE;
    }

}