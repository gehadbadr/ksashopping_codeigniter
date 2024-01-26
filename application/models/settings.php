<?php
class Settings extends CI_Model
{
	function __construct() {
        parent::__construct();
	}
	
	
	function get_settings_by($where)
	{
		$this->db->select('*');
        $this->db->from('settings');
        $this->db->where($where);
        $query = $this->db->get();
		
        return $query->row_array();
	}
	
	function insert_setting($where,$data)
	{	$this->db->where($where);
		if($this->db->update('settings',$data))
		{
			return TRUE;
		}else{
			return FALSE;
		}
        
	}
	function update_page($id,$data)
	{
		$this->db->where('page_id',$id);
		if($this->db->update('pages',$data))
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function delete_page($id)
	{
		$this->db->where('page_id',$id);
		$this->db->delete("pages");
		return TRUE;
	}

	
	
	
	
}