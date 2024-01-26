<?php

class cats_model extends CI_Model {

    function __construct() {
        parent::__construct();

    }

   	function GetAllCats($limit=0,$offset=0) {
	    $this->db->order_by("sort", "desc");
		if($limit!=0){
			$query = $this->db->get('cats',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('cats');
			$res = $query->result();
			return $res;
        }
	
    } 
	
	function GetAllCatstositebycity($city_id_fk,$limit=0,$offset=0) {
	   
        if($limit!=0){
		   if(!$offset){
              $offset=0;  
            }
			$query = $this->db->query("SELECT DISTINCT cats. * 
FROM cats, products, price, users
WHERE price.price_id = products.offerprice && products.cat_id_fk = cats.cat_id && users.city_id_fk =$city_id_fk && products.user_id_fk = users.user_id && price.statue =1 && offerprice <>0
ORDER BY cats.sort DESC 
  LIMIT $offset, $limit");
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->query("SELECT DISTINCT cats. * 
FROM cats, products, price, users
WHERE price.price_id = products.offerprice && products.cat_id_fk = cats.cat_id && users.city_id_fk =$city_id_fk && products.user_id_fk = users.user_id && price.statue =1 && offerprice <>0
ORDER BY cats.sort DESC  ");
			$res = $query->result();
			return $res;
        }
    }
	

    
 function count_cat() { 
    return $this->db->count_all_results('cats'); 
    }
	

	
    function GetCatByID($id) {
        $query = $this->db->get_where('cats',array('cat_id' => $id));
        $res = $query->result();
		if ($query->result() == null) {
            return null;
        } else {
            return $res;
        }
        
    }
    function ProductsOfCatigory($id){
        if (!$id) {
            return null;
        } else {
		$this->db->order_by("sort", "desc");
            $query = $this->db->get_where('products', array('cat_id_fk' => $id));
            $res = $query->result();
            if ($query->result() == null) {
                return null;
            } else {
                return $res;
            }
        }
    }
    
    
    
	
	function Getprev($sort){
            
        $query=$this->db->query("select sort from cats where  sort < $sort ORDER BY sort DESC LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
    
    function Getnext($sort){
            
        $query=$this->db->query("select sort from cats where sort > $sort ORDER BY sort ASC  LIMIT 1"); 
            
        $res = $query->result();
        return $res;
    }
	
	function update_sort($nextsort,$temp_sort,$sort){
            
        $query=$this->db->query("UPDATE cats SET sort = $temp_sort WHERE sort = $nextsort " ); 
		$query2=$this->db->query("UPDATE cats SET sort = $nextsort WHERE sort = $sort " ); 
        $query3=$this->db->query("UPDATE cats SET sort = $sort WHERE sort = $temp_sort " );        

	}	
        
    function Getsort($n){
            
        $query=$this->db->query("select sort from cats ORDER BY sort DESC LIMIT $n,1"); 
            
        $res = $query->result();
        return $res;
    }
	
	//cart
	
		function get_child_categories($where)
	{
		
		$this->db->select('cats.cat_id,cats.pid,cats.name,products.name as parent,cats.slug');
		$this->db->from('cats');
		$this->db->join('cats as p','cats.pid = products.cat_i_fk','inner');
		$this->db->where($where);
		$query=$this->db->get();
		
	if($query->num_rows())
	{
		$result=$query->result_array();
		foreach($result as $key=>$val)
		{
			$product['cat_id']=$val['cat_id'];
			$product['deleted']="0";
			$prod=$this->products->get_all_products($product);
			$result[$key]['products']=$prod['results'];
		}
		return $result;
	}else{
		return FALSE;
	}
		
	}
	function get_all_categories($limit=0,$offset=0)
	{
		$ret['count']=$this->db->get_where('cats',array('pid'=>'0'))->num_rows();
		if($limit!=0)
		{
		$ret['results']=$this->db->get_where('cats',array('pid'=>'0'),$limit,$offset)->result_array();}
		else{
			$ret['results']=$this->db->get_where('cats',array('pid'=>'0'))->result_array();
		}
		foreach($ret['results'] as $key=>$val)
		{
			$category['cats.pid']=$val['cat_id'];
			$ret['results'][$key]['children']=$this->get_child_categories($category);
			
			
		}
		
	return $ret;
		
	
	}
	
		
// start admin cat 
	 
    function add_cat($name, $path,$thumb) {
        if (!$name) {
            
        } else {
		
		    $this->db->order_by("sort", "desc");
            $query = $this->db->get('cats',1);
			if($query->result()){
				foreach ($query->result() as $row ) {
				$sort_value = $row->sort +1; 
				}
			}else{
			    $sort_value = 1;
			}
			
            $this->db->insert('cats', array('name' => $name,'path' => $path,'thumb' =>$thumb,'sort' => $sort_value,'date' =>date("Y-m-d h:i:s")), 1);
        }
    }
    
   	
    function delete_catigory($id) {
	
	  $query = $this->db->get_where("products", array("cat_id_fk" => $id));
	
	        foreach ($query->result() as $row ) {
	                $row->product_id;
                    $this->products_model->delete_product($row->product_id);
			}
				
		 $query2 = $this->db->get_where('cats', array('cat_id' => $id), 1);
           
				foreach ($query2->result() as $row2 ) {
					$path = $row2->path;
					$thumb = $row2->thumb;
						unlink($path);
						unlink($thumb);
				    
				}
        $this->db->query("delete from cats where cat_id = '$id'");
        
    }

    function edit_catigory($id, $name, $path,$thumb) {
		 $query = $this->db->get_where('cats', array('cat_id' => $id), 1);
           
				foreach ($query->result() as $row ) {
					$old_path = $row->path;
					$old_thumb = $row->thumb;
				
						if($path!= $old_path && $old_path != 'images/images/no_image.jpg'){
							unlink($old_path);
							unlink($old_thumb);
							
							
						}
				}
        $this->db->where('cat_id', $id);
        $this->db->update("cats", array('name' => $name,'path' => $path,'thumb' =>$thumb,'date' =>date("Y-m-d h:i:s")));
    }

//end cat	
	
	
	
}
?>
