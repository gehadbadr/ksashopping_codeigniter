<?php

class Carts_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
 /* Cart Functions */

    // Add an item to the cart
    function validate_add_cart_item($id,$cty) {

	    $data["product_detail"] = $this->products_model->GetProductByID($id);
	    $product_id =  $data["product_detail"][0]->product_id;
        if ($data["product_detail"][0]->statue == 1) {
			$price=$data["product_detail"][0]->offer_price;
		}else{
			$price=$data["product_detail"][0]->price;
		}
       $total = $this->cart->contents();
        $update = FALSE;
        if (!empty($total)) { //print_r($total);exit;
            foreach ($total as $item) {
//			if(($item['id']==$id) && ($item['options']['color']==$options))
                if (($item['id'] == $product_id)) {

                    $data = array(
                        'rowid' => $item['rowid'],
                        'qty' => $item['qty'] + $cty
                    );
                    $this->cart->update($data);
                    $update = TRUE;
                    return TRUE;
                }
            }
            if ($update == FALSE) {
                if ($product_id > 0) {
                        $data = array(
                            'id' => $product_id,
                            'qty' => $cty,
                            'price' => $price,
                            'name' => $data["product_detail"][0]->name,
//					'options' =>array("color" => $options),
                           // 'ship' => $data["product_detail"][0]->ship,
                          //  'image' => $data["product_detail"][0]->image
                        );
                    
                    // Add the data to the cart using the insert function that is available because we loaded the cart library
					$this->cart->insert($data);

                    return TRUE; // Finally return TRUE
                } else {
                    // Nothing found! Return FALSE!
                    return FALSE;
                }
            }
        } else {

            if ($product_id > 0) {
                    $data = array(
                            'id' => $product_id,
                            'qty' => $cty,
                            'price' =>$price,
                            'name' => $data["product_detail"][0]->name,
//					'options' =>array("color" => $options),
                           // 'ship' => $data["product_detail"][0]->ship,
                            //'image' => $data["product_detail"][0]->image
                    );
                
                // Add the data to the cart using the insert function that is available because we loaded the cart library
                $this->cart->insert($data);

                return TRUE; // Finally return TRUE
            } else {
                // Nothing found! Return FALSE!
                return FALSE;
            }
        }
/*
//$id = $this->input->post('product_id'); // Assign posted product_id to $id
     //   $cty = $this->input->post('quantity'); // Assign posted quantity to $cty
//		$options = $this->input->post('opt'); // Assign posted quantity to $cty

        $this->db->where('product_id', $id); // Select where id matches the posted id
        $query = $this->db->get('products', 1); // Select the products where a match is found and limit the query by 1
		
        $total = $this->cart->contents();
        $update = FALSE;
        if (!empty($total)) { //print_r($total);exit;
            foreach ($total as $item) {
//			if(($item['id']==$id) && ($item['options']['color']==$options))
                if (($item['id'] == $id)) {

                    $data = array(
                        'rowid' => $item['rowid'],
                        'qty' => $item['qty'] + $cty
                    );
                    $this->cart->update($data);
                    $update = TRUE;
                    return TRUE;
                }
            }
            if ($update == FALSE) {
                if ($query->num_rows > 0) {
                    foreach ($query->result() as $row) {
                        $data = array(
                            'id' => $id,
                            'qty' => $cty,
                            'price' => $row->price,
                            'name' => $row->name,
//					'options' =>array("color" => $options),
                            'ship' => $row->ship,
                            'image' => $row->image
                        );
                    }
                    // Add the data to the cart using the insert function that is available because we loaded the cart library
					$this->cart->insert($data);

                    return TRUE; // Finally return TRUE
                } else {
                    // Nothing found! Return FALSE!
                    return FALSE;
                }
            }
        } else {

            if ($query->num_rows > 0) {
                foreach ($query->result() as $row) {
                    $data = array(
                            'id' => $id,
                            'qty' => $cty,
                            'price' => $row->price,
                            'name' => $row->name,
//					'options' =>array("color" => $options),
                            'ship' => $row->ship,
                            'image' => $row->image
                    );
                }
                // Add the data to the cart using the insert function that is available because we loaded the cart library
                $this->cart->insert($data);

                return TRUE; // Finally return TRUE
            } else {
                // Nothing found! Return FALSE!
                return FALSE;
            }
        }*/
    }

    function validate_remove_cart_item() {
        $rowid = $this->input->post('rowid');
        $data = array(
            'rowid' => $rowid,
            'qty' => 0
        );
        $this->cart->update($data);
        $update = TRUE;
    }

    function block_product($where) {
        $this->db->query("update products set featured = 0 where product_id='$where'");
    }
    
	function validate_update_cart(){

     // Get the total number of items in cart
     $total = count($this->cart->contents());//$this->cart->total_items();

     // Retrieve the posted information
     $item = $this->input->post('rowid');
     $qty = $this->input->post('qty');

     // Cycle true all items and update them
		 for($i=0;$i<$total;$i++)
		 {
			 // Create an array with the products rowid's and quantities.
			 $data = array(
				   'rowid' => $item[$i],
				   'qty'   => $qty[$i]
				);

				// Update the cart with the new information
			 $this->cart->update($data);
		 }

	}  
   
	


}

?>