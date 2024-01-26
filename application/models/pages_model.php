<?php

class Pages_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	function GetAllPages($limit=0,$offset=0) {
	    $this->db->order_by("page_id", "desc");
		if($limit!=0){
			$query = $this->db->get('pages',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('pages');
			$res = $query->result();
			return $res;
        }
	
    }

    
 function count_pages() { 
    return $this->db->count_all_results('pages'); 
    }   

    function Getnavpages() {
        $this->db->order_by("page_id", "desc");
        $query = $this->db->get('pages',3);
        $res = $query->result();
        return $res;
    }
    
   

    function GetpageByID($id) {
        if ($this->db->get("pages", array("page_id" => $id))) {
            $query = $this->db->get_where('pages', array('page_id' => $id), 1);
            $res = $query->result();
            if ($query->result() == null) {
                return null;
            } else {
                return $res;
            }
        }else{
            return null;
        }
    }
	
	function GetpageByname($id) {
        if ($this->db->get("pages", array("title" => $id))) {
            $query = $this->db->get_where('pages', array('title' => $id), 1);
            $res = $query->result();
            if ($query->result() == null) {
                return null;
            } else {
                return $res;
            }
        }else{
            return null;
        }
    }
	
// start ADMIN_page 
	 
     function add_page($title, $content ,$path,$thumb) {
        $this->db->insert("pages", array("title" => $title, "content" => $content, "path" => $path, "thumb" => $thumb,"date"=>date("Y-m-d")), 1);

    }

    function delete_page($id) {
		$path_to_images = $this->db->get_where("pages", array("page_id" => $id));
        foreach ($path_to_images->result() as $row) {
					$image = $row->path;
					$thumb = $row->thumb;

					unlink($image);
					unlink($thumb);
		}			
        $this->db->delete("pages", array("page_id" => $id), 1);
    }

    function edit_page($id, $title, $content,$path,$thumb) {
			 $path_to_images = $this->db->get_where('pages', array('page_id' => $id), 1);
				foreach ($path_to_images->result() as $row ) {
					$old_path = $row->path;
					$old_thumb = $row->thumb;
				
						if($path!= $old_path ){
							unlink($old_path);
							unlink($old_thumb);
						}
				}
        $this->db->update("pages", array("title" => $title, "content" => $content, "path" => $path, "thumb" => $thumb,"date"=>date("Y-m-d")), array("page_id" => $id));
    }

//end page	


}

?>