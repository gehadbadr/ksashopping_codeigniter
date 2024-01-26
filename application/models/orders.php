<?php class orders extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*function get_all_orders($limit=0,$offset=0)
	{
		$ret['count']=$this->db->get('orders')->num_rows();
		if($limit!=0)
		{
		$ret['results']=$this->db->get('orders',$limit,$offset)->result_array();}
		else{
			$ret['results']=$this->db->get('orders')->result_array();
		}
		
		
	return $ret;
		
	
	}*/
	
	function GetAllOrders($limit=0,$offset=0) {
	    $this->db->order_by("order_id", "desc");
		if($limit!=0){
			$query = $this->db->get('orders',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('orders');
			$res = $query->result();
			return $res;
        }
	
    } 
	
	function count_order() { 
    return $this->db->count_all_results('orders'); 
    }
	
	function GetOrderByID($id) {
        $query = $this->db->get_where("orders", array("order_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function edit_order($id,$notes){
        $this->db->update("orders", array('notes' => $notes), array('order_id' => $id));
    }
	
	function get_all_confirmations($limit=0,$offset=0)
	{
		$ret['count']=$this->db->get('order_confirmations')->num_rows();
		if($limit!=0)
		{
		$ret['results']=$this->db->get('order_confirmations',$limit,$offset)->result_array();}
		else{
			$ret['results']=$this->db->get('order_confirmations')->result_array();
		}
		
		
	return $ret;
		
	
	}
	
	
	function add_order($data)
	{
		if($this->db->insert('orders',$data))
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	function add_details($data)
	{
		if($this->db->insert('order_details',$data))
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	function GetordersdetailsByID($id) {
	    
		$query = $this->db->get_where("order_details", array("order_id_fk" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetorderuserID($order_id_fk) {
	    
		    $query = $this->db->query("SELECT DISTINCT order_details. user_id_fk ,statue
FROM  order_details
WHERE  order_details.order_id_fk = $order_id_fk
");
        $res = $query->result();
        return $res;
    }
	
	function GetordersdetailsByuserID($user_id,$order_id_fk) {
        $query = $this->db->query("SELECT DISTINCT order_details. * , products.product_id ,products.name, products.image,products.offerprice , users.username
FROM users, products, orders, order_details
WHERE order_details.products_id_fk = products.product_id && products.user_id_fk = users.user_id && users.user_id =$user_id && order_details.order_id_fk = $order_id_fk
");
        $res = $query->result();
        return $res;
    }
	
//--------------user--------------------------

function Getuserorders($user_id,$num, $offset) {
  if(!$offset){
              $offset=0;  
            }
$query = $this->db->query("SELECT  distinct order_details.order_id_fk ,orders.*
FROM  orders, order_details
WHERE   order_details.order_id_fk =orders.order_id &&
order_details.user_id_fk  = $user_id &&
statue <> '1'
ORDER BY order_details.order_id_fk desc
LIMIT $offset,$num  ");
        $res = $query->result();
        return $res;
    } 
	
	function count_userorder($user_id) { 
	 $query = $this->db->query("SELECT  distinct order_details.order_id_fk 
FROM  orders, order_details
WHERE   order_details.order_id_fk =orders.order_id &&
order_details.user_id_fk  = $user_id
");
	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
   


//--------------user--------------------------



//--------------buyer--------------------------

function Getbuyerorders($buyer_id,$num, $offset) {
  if(!$offset){
              $offset=0;  
            }
$query = $this->db->query("SELECT  orders.* FROM  orders WHERE   buyer_id_fk =$buyer_id && buyer_statue <> '1' ORDER BY order_id desc LIMIT $offset,$num  ");
        $res = $query->result();
        return $res;
    } 
	
	function count_buyerorder($buyer_id) { 
$query = $this->db->query("SELECT  orders.* FROM  orders WHERE   buyer_id_fk =$buyer_id && buyer_statue <> '1' ");
 
	$res = $query->num_rows();
            
              if ($res == null) {
                return null;
            } else {
                return $res;
            } 
          
    }
   


//--------------user--------------------------
	
	
	function add_confirmation($data)
	{
		if($this->db->insert('order_confirmations',$data))
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	
	function get_order_by($where)
	{
		$query=$this->db->get_where('orders',$where);
		
		if($query->num_rows())
		{
			return $query->row_array();
			
		}else{
			return FALSE;
		}
		
	}
	
	function get_confirmation_by($where)
	{
		$query=$this->db->get_where('order_confirmations',$where);
		
		if($query->num_rows())
		{
			return $query->row_array();
			
		}else{
			return FALSE;
		}
		
	}
	
	function update_order($order_id,$data)
	{
		$this->db->where('order_id', $order_id);
		if($this->db->update('order_confirmations',$data))
		{
			return $this->db->affected_rows();
		}else{
			return false;
		}
	}
	function del_order($id)
	{
		$this->db->where('order_id', $id);
		if($this->db->delete('orders'))
		{
			return $this->db->affected_rows();
		}else{
			return false;
		}
	}
	
	function del_confirmation($id)
	{
		$this->db->where('confirm_id', $id);
		if($this->db->delete('order_confirmations'))
		{
			return $this->db->affected_rows();
		}else{
			return false;
		}
	}
}
?>