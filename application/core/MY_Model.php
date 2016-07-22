<?php

class MY_Model extends CI_Model
{
    
    public $table = "";

    function get_all($condition=null)
    {
        if (isset($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get($this->table);
    }
    
    function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function update($data, $condition=NULL)
    {
        if(isset($condition))
        {
            $this->db->where($condition);
        }
        
        return $this->db->set($data)
            ->update($this->table);
    }

    function get_by_id($condition)
    {
        $res = $this->db->get_where($this->table, $condition);
        if ($res->num_rows() > 0) {
            $result = $res->row();
        } else {
            $result = '';
        }
        return $result;
    }
    function destroy($condition)
    {
        $this->db->delete($this->table, $condition);
    }
    
}