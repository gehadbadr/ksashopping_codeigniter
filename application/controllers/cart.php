<?php

class Cart extends CI_Controller {

    function Cart() {
        parent::__construct();
		
        $this->load->model(array('carts_model', 'products_model','cats_model', 'orders','pages_model','customers_model'));
		$this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');

    }
	
	function _remap($method){
    $param_offset = 2;

		// Default to index
		if ( ! method_exists($this, $method))
		{
			// We need one more param
			$param_offset = 1;
			$method = 'order';
		}

		// Since all we get is $method, load up everything else in the URI
		$params = array_slice($this->uri->rsegment_array(), $param_offset);

		// Call the determined method with all params
		call_user_func_array(array($this, $method), $params);
	} 

    function add_to_cart() {
				
			$id = $this->input->post('product_id'); // Assign posted product_id to $id
            $data['cat_link'] = TRUE;

		if ($id && $this->products_model->GetProductByID($id)) {

				$data["product_detail"] = $this->products_model->GetProductByID($id);
				
				$data['title'] = $data["product_detail"][0]->name.' - KSA SHopping';
				$data['product_images'] = $this->products_model->GetProductImages($id);
				$data["product_main_img"] = $this->products_model->GetProductMainImage($id);
				$data["product_comment"] = $this->products_model->GetProductcomment($id);
				$data["product_video"] = $this->products_model->GetpvideoByproduct($id);
				$data["product_views"] = $this->products_model->GetProductViews($id);
				$data["product_cat"] = $this->cats_model->GetCatByID($data["product_detail"][0]->cat_id_fk);
				
				$sort = $data["product_detail"][0]->sort;
				$data['prev'] = $this->products_model->Getprev($sort,$data["product_detail"][0]->cat_id_fk);
				$data['next'] = $this->products_model->Getnext($sort,$data["product_detail"][0]->cat_id_fk);
			 
			
		} else {
				$data['title']="product - KSA SHopping";
		}	
        $this->form_validation->set_rules('quantity', 'quantity', 'trim|required|max_length[50]|numeric|xss_clean');

			if ($this->form_validation->run() == FALSE){ 
				$this->load->view('product_detail_view' , $data);

					}else{
				$cty = $this->input->post('quantity'); 
				$this->carts_model->validate_add_cart_item($id,$cty);
				redirect('cart/order');
			}

    }

    function update_cart() {
//$this->carts_model->validate_update_cart();
    $data['cat_link'] = TRUE;
	$this->form_validation->set_rules('qty[]', 'quantity', 'trim|required|max_length[50]|numeric|xss_clean');

			if ($this->form_validation->run() == FALSE){ 
			    $data['cat_link'] = TRUE;
				$data['title'] = 'سله التسوق  - KSA SHopping';
				$this->load->view('order',$data);

			}else{
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
				redirect('cart/order');
			
			}
		 // Get the total number of items in cart
   
    }

    function delete_from_cart() {
        $this->carts_model->validate_remove_cart_item();
    }

    function show_items_number() {
        echo $this->cart->total_items();
    }
	function show_items_total() {
        echo $this->cart->format_number($this->cart->total());
    }
	function order(){
		
		$data['cat_link'] = TRUE;
        $data['title'] = 'سله التسوق  - KSA SHopping';
		$this->load->view('order',$data);
	
	}

    function show_cart(){
//		$data['lang']=$this->currencies->get_current_language();
//		$data['currency_code']=$this->currencies->get_current_currency();
//        $this->lang->load('settings');
        $data['cat_link'] = TRUE;
        $data['title'] = 'سله التسوق  - KSA SHopping';
        $this->load->view('cart',$data);
    }

    function add_confirm() {
//		$data['lang']=$this->currencies->get_current_language();
//		$data['currency_code']=$this->currencies->get_current_currency();
//		
        $data['cat_link'] = TRUE;
        $data['title'] = "متابعه التسوق  - KSA SHopping";
        $this->load->view('add_confirm', $data);
    }

   /*  function shopping_cart() {
//		$data['lang']=$this->currencies->get_current_language();
//		$data['currency_code']=$this->currencies->get_current_currency();
//		$this->lang->load('settings', $data['lang']);
//		require_user_login();
//		$data['user']=$this->session->userdata('user');
//		$currencies=$this->currencies->get_all_currencies();
//		$data['currencies']=$currencies['results'];
//		$offers=$this->offers->get_all_offers();
//		$data['all_offers']=$offers['results'];
        $data['cat_link'] = TRUE;
        $data['title'] = 'سله التسوق';
        $this->load->view('cart', $data);
    }*/

   /*  function show_order() {
       // $wheres['setting_id'] = 1;
      // $data['settings'] = $this->settings->get_settings_by($wheres);
		$data['cat_link'] = TRUE;
        $data['title'] = 'سله التسوق';
        $this->load->view('cart_order', $data);
    }*/

    function empty_cart() {
        $this->cart->destroy();
    }

    function checkout() {
		$total = $this->cart->contents();
		if (!empty($total)) { 
			   
	//		$data['lang']=$this->currencies->get_current_language();
	//		$data['currency_code']=$this->currencies->get_current_currency();
	//        $this->lang->load('settings', $data['lang']);
	//        $this->lang->load('form_validation', $data['lang']);
	//        require_user_login();
	//        $data['user'] = $this->session->userdata('user');
	//        $currencies = $this->currencies->get_all_currencies();
	//        $data['currencies'] = $currencies['results'];
	//        $offers = $this->offers->get_all_offers();
	//        $data['all_offers'] = $offers['results'];
			$data['cat_link'] = TRUE;
			$data['title'] = "تأكيد الطلب  - KSA SHopping";
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('mobile', 'Telephone', 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('address', ('Region'), 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('email', ('Email'), 'trim|required|valid_email|max_length[50]|xss_clean');
			$this->form_validation->set_rules('city', ('City'), 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('notes', ('Notes'), 'trim|required|xss_clean');
			$this->form_validation->set_rules('payment_method', ('Payment Method'), 'trim|required|max_length[50]|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				
				$this->load->view('checkout', $data);
			} else {
				$email = $this->input->post('email');
				$name = $this->input->post('name') ;
				$mobile = $this->input->post('mobile');
				$address = $this->input->post('address');
				$city = $this->input->post('city');
				$notes = $this->input->post('notes');
				$payment_method = $this->input->post('payment_method');
				$total_str = $this->cart->format_number($this->cart->total());

				$str = '<table>';
				foreach ($this->cart->contents() as $items) {
				 
					$str.='<tr><td align="right">كود: ' . $items['id'] . '&nbsp;&nbsp;&nbsp;&nbsp; اسم المنتج: ' . $items['name'] . '&nbsp;&nbsp;&nbsp;&nbsp; سعر القطعة : ' . $items['price']. '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; العدد(' . $items['qty'] . ') &nbsp;&nbsp;&nbsp;&nbsp; الاجمالي: ' . $this->cart->format_number($items['subtotal'])  .'</td></tr>';
				}
				$str.='<tr><td align="right" colspan="2"> المجموع الكلى: ' . $total_str . ' </td></tr>';

				$str.="</table>";
				$msg = '<table height="500" border="0" width="860" align="right" dir="rtl" style="background:#DEDEDE;border:none;">
							<tr><td align="right" colspan="2"></tr>
							<tr><td align="right" colspan="2">عزيزي ' . $name . '<br />تم تلقى طلبك وسوف تقوم الشركة بتنفيذه سريعاً   </td></tr>
							<tr><th colspan="2" align="right"><br />تفاصيل الطلب:</th></tr>
							<tr><td colspan="2">' . $str . '</td></tr>
							<tr><th colspan="2" align="right"><br />معلومات الشحن:</th></tr>
							<tr><td align="right" colspan="2">الاسم الأول:' . $name . '</td></tr>
							<tr><td align="right" colspan="2">رقم التليفون : ' . $mobile . '</td></tr>
							<tr><td align="right" colspan="2">الحي/ المنطقة : ' . $address . '</td></tr>
							<tr><td align="right" colspan="2">المدينة : ' . $city . '</td></tr>
							<tr><td align="right" colspan="2">ملاحظات : ' . $notes . '</td></tr>
		 
							<tr><td align="right" colspan="2">طريقة الدفع: ' . $payment_method . '</td></tr>
							<tr><td colspan="2">سوف تتلقى رسالة بريد إلكتروني تفيدك بشحن الطلب إلي عنوانك.</td></tr>
							<tr><td colspan="2">شكرا لك<br />
								<a href="http://www.testksa.com/">www.testksa.com </a>
								</td>
							</tr>
						</table>
						<map name="Map">
						  <area shape="rect" coords="629,61,680,111" href="#">
						  <area shape="rect" coords="691,61,738,111" href="#">
						  <area shape="rect" coords="750,59,800,113" href="#">
						  <area shape="rect" coords="811,60,862,113" href="#">
						</map>

				';
				$config['mailtype'] = 'html';
				$config['send_multipart'] = FALSE;
				$config['priority'] = 1;
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				
				$this->email->from("no-reply@testksa.com", "testksa");
				$this->email->to($email);
				$this->email->subject(("طلبك في  testksa"));
				$this->email->message($msg);
				$this->email->send();
				
				$this->email->from($email, $name);
				$this->email->to("info@testksa.com");
				$this->email->subject(("طلبك في  testksa") . "$name");
				$this->email->message($msg);
				$this->email->send();
				
				$order['email'] = $email;
				$order['name'] = $name;
				$order['mobile'] = $mobile;
				$order['address'] = $address;
				$order['city'] = $city;
				$order['products'] = $str;
				$order['total'] = $total_str;
				$order['notes'] = $notes;

				$this->orders->add_order($order);
			   
				if($payment_method == "bank"){
					$this->cart->destroy();
					set_msg('تم إرسال الطلب بنجاح','');
					redirect('/pro/payment_methods');
				 
				}elseif($payment_method == "online"){
					set_msg('تم إرسال الطلب بنجاح','');	
					redirect('/cart/pay_cart');
					//redirect('/cart/paypal');
			   }
					$this->cart->destroy();  
					set_msg('تم إرسال الطلب بنجاح','');
					redirect('/home');
			}
		}else{
			redirect('/home');
		}
			
			
	}
	
	function pay_cart() {

			// Set variables for paypal form 
		$returnURL = base_url().'paypal/success'; //payment success url 
		$cancelURL = base_url().'paypal/cancel'; //payment cancel url 
		$notifyURL = base_url().'paypal/ipn'; //ipn url 
					 
		// Get product data from the database 
					 
		// Get current user ID from the session (optional) 
		$userID = 'client 55'; 
			
		// Add fields to paypal form 
		$this->paypal_lib->add_field('return', $returnURL); 
		$this->paypal_lib->add_field('cancel_return', $cancelURL); 
		$this->paypal_lib->add_field('notify_url', $notifyURL); 
		$this->paypal_lib->add_field('custom', $userID); 
		$this->paypal_lib->add_field('cmd', '_cart'); 
		$this->paypal_lib->add_field('upload', '1'); 

		$i = 0;
		foreach ($this->cart->contents() as $items) {
			$i++;
			$this->paypal_lib->add_field('item_name_'.$i, $items['name']); 
			$this->paypal_lib->add_field('item_number_'.$i ,  $items['id']); 
			$this->paypal_lib->add_field('amount_'.$i,  $items['price']); 
			$this->paypal_lib->add_field('quantity_'.$i,  $items['qty']); 
		}
		// Render paypal form 
		
		$this->paypal_lib->paypal_auto_form();
		
  }
		
	function paypal() {
		// sending data to view
		$data['contact_link'] = TRUE;
		$data['title'] = "paypal - KSA SHopping";
		//view
		$this->load->view('paypal_view', $data);
		}	


}