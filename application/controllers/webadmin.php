<?php

class Webadmin extends CI_Controller {
//protected $_config;-----cookie try
    function Webadmin() {
        parent::__construct();
        
        $this->load->model('cats_model');
		$this->load->model('payment_model');
		$this->load->model('pay_model');
		$this->load->model('orders');
        $this->load->model('products_model');
		$this->load->model('pages_model');
		$this->load->model('contact_model');
		$this->load->model('customers_model');
        $this->load->model('user_model');
		$this->load->model('buyer_model');
        $this->load->model('user_products_model');
       
	 //  	
		$this->load->helper('cookie');
		$this->check_products_offer_expire();
		$this->check_ad_expire();
        $this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
    }
	public function _remap($method, $params = array()){
	  if (method_exists($this, $method)){
	   return call_user_func_array(array($this, $method), $params);
	  }
	  $this->_parse404();
	}

	public function _parse404(){
	  header("HTTP/1.1 404 Not Found");
	  $this->load->view('admin/my_404_page');
	}

    function index() {
        $this->login();
    }

    function main_page() {
        if ($this->session->userdata('logged_in')) {
            $this->load->view('admin/main_page_view');
        } else {
            redirect('webadmin/login');
        }
    }

    function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('webadmin/main_page');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[50]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
			    
                $this->load->view('admin/login_view');
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $user_id = $this->admin_model->check_login($username, $password);

                if (!$user_id) {
                    $this->session->set_flashdata('login_error','هناك خطأ في اسم الدخول او كلمة المرور');
                   redirect('webadmin/login');
                } else {
                    $login_data = array('logged_in' => TRUE, 'admin_id' => $user_id);
                    $this->session->set_userdata($login_data);
					
					if($this->input->post('remember')) {
						//$nume =$this->_config['sess_expiration'];-----cookie try-----
						$admin_cookie= array(
							  'name'   => 'admin_cookie',
							  'value'  => 'admin_cookie2',
							   'expire' => time()+60*60*60*24*30,
                        );
						
						$this->input->set_cookie($admin_cookie);
						$this->input->cookie('admin_cookie',true);
						set_msg('cookie','');
					   redirect('webadmin/login');
					}
				set_msg('مرحبا بك','');
                redirect('webadmin/main_page');
						
                }
            }
        }
    }

    function logout() {
		$admin_cookie= array(
							  'name'   => 'admin_cookie',
							  'value'  => '',
							   'expire' => '0',);
		$this->input->set_cookie($admin_cookie);
        $this->session->sess_destroy();
        redirect('webadmin/login');
    }

    function forget() {
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/forget_view');
        } else {
            $email = $this->input->post("email");
            $forget = $this->admin_model->check_email($email);
			if ($forget) {
			
				$pass=random_string("alnum",15);
				$newpassword=md5($pass);

				if($this->admin_model->update_admin_password($forget[0]->admin_id,$newpassword)){	
						$to = $email;
						$subject = "Forget password.";
						$headers = "From: Info@ksashopping.com";
						$body = '<table height="211" border="0" align="right" dir="rtl" style="background:#FFF;border:none;">
							   <tr><td colspan="2">'.$forget[0]->username.'</td></tr>
							   <tr><td colspan="2">حسب طلبك, تم استعادة كلمة المرور الخاصة بك. بياناتك الجديدة موجودة أدناه:</td></tr>
							   <tr><td>إسم العضو:</td><td>'.$forget[0]->username.'</td></tr>
							   <tr> <td>كلمة المرور الجديدة:</td><td>'.$pass.'</td></tr>
							</table>';           

					if (mail($to, $subject, $body, $headers)) {
						
							$this->session->set_flashdata('login_error','لقد تم ارسال كلمة المرور بنجاح ..برجاء التحقق من البريدالالكتروني الخاص بك واعادة الدخول برقم المرور الجديد ');
							redirect('webadmin/login');
						
					}else {
							$this->session->set_flashdata('login_error','عفوا لم يتم ارسال كلمة المرور بنجاح');
							redirect('webadmin/forget');
						 
					}
				} else {
						$this->session->set_flashdata('login_error','....عفوا هذا الايميل غير مسجل');
							redirect('webadmin/forget');
					}
			}else {
					$this->session->set_flashdata('login_error','.....عفوا هذا الايميل غير مسجل');
						redirect('webadmin/forget');
			}
		}
    }


    function product($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->products_model->delete_product($id);
            }
			elseif ($method == 'add') {
                $data["cats"] = $this->cats_model->GetAllCats();
						
			    $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|xss_clean');
                $this->form_validation->set_rules('cat_id', 'Catigory', 'trim|required|max_length[50]|xss_clean');
                $this->form_validation->set_rules('content', 'Details', 'trim|required');
                $this->form_validation->set_rules('price', 'Price', 'trim|required|max_length[50]|numeric|xss_clean');
                $this->form_validation->set_rules('shipping', 'Shipping', 'trim|max_length[50]|numeric|xss_clean');
			    if($this->input->post("offer_price")){
				    $this->form_validation->set_rules('offer_price', 'Offer Price', 'trim|required|max_length[100]|xss_clean|numeric');
					$this->form_validation->set_rules('offer_start', 'Start Date of Offer Price', 'trim|required');
					$this->form_validation->set_rules('offer_expire', 'Expired Date of Offer Price', 'trim|required');
				}
                
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('admin/products/add_product_view', $data);
                } else {
				    $product_name = $this->input->post("name");
                    $cat_id = $this->input->post("cat_id");
                    $details = $this->input->post("content");
                    $price = $this->input->post("price") ;
					$shipping = $this->input->post("shipping") ;
                    $offer_price =$this->input->post("offer_price");
					if(!empty($offer_price)){
						$offer_start =  $this->input->post("offer_start");
						$offer_start_time =strtotime($offer_start);
						if(empty($offer_start_time)|| $offer_start_time == false){
						$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
							redirect('webadmin/product/add');
						}
						
						$offer_expire =  $this->input->post("offer_expire");
						$offer_expire_time =strtotime($offer_expire);
						if(empty($offer_expire_time)|| $offer_expire_time == false){
						$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
							redirect('webadmin/product/add');
						}
						
						$date=time();
							if($offer_start_time <= $date && $offer_expire_time >= $date){
								$statue = '1';
							}else{
								$statue = '0';
							}
					}else{
						$offer_price = '';
                        $offer_start = '';
						$offer_expire = '' ;
						$statue = '0';

                    }
					   
					
					
					if (!empty($_FILES['photo_thumb']['name'])) {
           			    $date_image = time();
						$upload_path = 'upload/product/';
						$path = $upload_path. $date_image. '.jpg';
						$this->upload->initialize($this->set_upload_options($upload_path,$date_image));
                    
						if(!$this->upload->do_upload('photo_thumb')){
							$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
							redirect('webadmin/product/add'); 
					    }
						//resize image----------------------------------------------
						$width = '600';
						$height = '400';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
					}else{
						$this->session->set_flashdata('login_error','يجب ادخال الصورة الرئيسية للمنتج');                                                               
						redirect('webadmin/product/add');
                    }
				
                    $product_id = $this->products_model->add_product($product_name,$cat_id,$details,$price,$offer_price,$offer_start ,$offer_expire ,$statue,$shipping,$path,$thumb);
					
				
                    $pvideos = $this->input->post('pvideo');
					if(!empty($pvideos)){
						foreach ($pvideos as $pvideo) {
							if(!empty ($pvideo)){
								$this->products_model->add_pvideo($product_id, $pvideo);
							}else{

							}
						}
                    }
					
					$pcolors = $this->input->post('pcolor');
					if(!empty($pcolors)){
						foreach ($pcolors as $pcolor) {
							if(!empty ($pcolor)){
								$this->products_model->add_pcolor($product_id, $pcolor);
							}else{

							}
						}
                    }
					
					$psizes = $this->input->post('psize');
					if(!empty($psizes)){
						foreach ($psizes as $psize) {
							if(!empty ($psize)){
								$this->products_model->add_psize($product_id, $psize);
							}else{

							}
						}
                    }
					
					if (!empty($_FILES['photo_thumb']['name'])) {
						if (!empty($_FILES['photo']['name'])) {
							$i = '0';
							while ($i < count($_FILES['photo']['name'])) {
								$date_image = time(). $i;
								$upload_path = 'upload/product/';
								$image_path = $upload_path. $date_image. '.jpg';
								$this->upload->initialize($this->set_upload_options($upload_path,$date_image));	
								if ($_FILES['photo']['size'][$i]<'900000') {
									if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $image_path)) {
										//resize image----------------------------------------------
										//resize image---------------------codeigniter can't resize more than 1 image & also it counts the hight and width of all image eachather but it can't count them as singuilar-------------------------
										//resize image----------------------------------------------
										//resize image----------------------------------------------
										$width = '600';
										$height = '400';
										$this->resize_image($image_path,$width,$height);
										//making thumb -------------------------------------
										$width = '100';
										$height = '100';
										$this->making_thumb($image_path,$width,$height);
										$thumb = $upload_path . $date_image. '_thumb.jpg';
										// -------------------------------------------------
										$this->products_model->add_product_image($product_id, $image_path,$thumb ,$i + '1' );
									}
								} else{
									$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB............');
									redirect('webadmin/product/edit/'.$product_id);

								}
								$i++;
							}
						}
					} else{
						$this->session->set_flashdata('login_error','يجب اضافة الصورة الرئيسية للمنتج حتي تتمكن من اضافة باقي الصور.....');
						redirect('webadmin/product/edit/'.$product_id);

					}	
					set_msg('تم الاضافة  بنجاح','');
                    redirect('webadmin/product');
                }
            } elseif ($method == 'edit') {
                if ($id && $this->products_model->GetProductByID($id)) {
                    $data['this_product'] = $this->products_model->GetProductByID($id);
					$data['product_main_image'] = $this->products_model->GetProductMainImage($id);
					$data['product_images'] = $this->products_model->GetProductAllImages($id);
                    $data["cats"] = $this->cats_model->GetAllCats();
					$data["pvideo"] = $this->products_model->GetpvideoByproduct($id);
					$data["pcolor"] = $this->products_model->GetpcolorByproduct($id);
					$data["psize"] = $this->products_model->GetpsizeByproduct($id);
					
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('cat_id', 'Catigory', 'trim|required|max_length[100]|xss_clean');
                   
                    $this->form_validation->set_rules('details', 'Details', 'trim|required');
                    $this->form_validation->set_rules('price', 'Price', 'trim|required|max_length[100]|numeric|xss_clean');
					$this->form_validation->set_rules('shipping', 'Shipping', 'trim|max_length[50]|numeric|xss_clean');
					/*$this->form_validation->set_rules('pvideo', 'Video', 'trim|max_length[50]|xss_clean');
					$this->form_validation->set_rules('pcolor', 'Color', 'trim|max_length[50]|xss_clean');
					$this->form_validation->set_rules('psize', 'Size', 'trim|max_length[50]|xss_clean');*/
					if($this->input->post("offer_price")){
						$this->form_validation->set_rules('offer_price', 'Offer Price', 'trim|required|max_length[100]|xss_clean|numeric');
						$this->form_validation->set_rules('offer_start', 'Start Date of Offer Price', 'trim|required');
						$this->form_validation->set_rules('offer_expire', 'Expired Date of Offer Price', 'trim|required');
					}

                    if ($this->form_validation->run() == FALSE) {
                        $this->load->view('admin/products/edit_product_view', $data);
                    } else {
                        $product_name = $this->input->post("name");
                        $cat_id = $this->input->post("cat_id");
                        $details = $this->input->post("details");
                        $price = $this->input->post("price") ;
						$shipping = $this->input->post("shipping") ;
                        $offer_price = $this->input->post("offer_price") ;
						if(!empty($offer_price)){
							$offer_start =  $this->input->post("offer_start");
							$offer_start_time =strtotime($offer_start);
							if(empty($offer_start_time)|| $offer_start_time == false){
							$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
								redirect('webadmin/product/edit/'.$id);
							}
							
							$offer_expire =  $this->input->post("offer_expire");
							$offer_expire_time =strtotime($offer_expire);
							if(empty($offer_expire_time)|| $offer_expire_time == false){
							$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
								redirect('webadmin/product/edit/'.$id);
							}
							
							$date=time();
								if($offer_start_time <= $date && $offer_expire_time >= $date){
									$statue = '1';
								}else{
									$statue = '0';
								}
						}else{
							$offer_price = '';
							$offer_start = '';
							$offer_expire = '' ;
							$statue = '0';

						}
                        //------------------------------------------
						if (!empty($_FILES['photo_thumb']['name'])) {
           			    	$date_image = time();
							$upload_path = 'upload/product/';
							$path = $upload_path. $date_image. '.jpg';
							$this->upload->initialize($this->set_upload_options($upload_path,$date_image));
                        if(!$this->upload->do_upload('photo_thumb')){
							$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
							redirect('webadmin/product/edit/'.$id);
						 
					    }
						//resize image----------------------------------------------
						$width = '600';
						$height = '400';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
                      
						}else{
                        $path = $data["product_main_image"][0]->image ;
						$thumb = $data["product_main_image"][0]->image_thumb ;
						}

                        $this->products_model->edit_product($id, $product_name, $cat_id, $details, $price, $offer_price,$offer_start,$offer_expire,$statue,$shipping,$path, $thumb);
                       
					   
						$pvideos = $this->input->post('pvideo');
						if(!empty($pvideos)){
							foreach ($pvideos as $pvideo) {
								if(!empty ($pvideo)){
									$this->products_model->add_pvideo($id, $pvideo);
								}
							}
						}
						
						$pcolors = $this->input->post('pcolor');
						if(!empty($pcolors)){
							foreach ($pcolors as $pcolor) {
								if(!empty ($pcolor)){
									$this->products_model->add_pcolor($id, $pcolor);
								}else{

								}
							}
						}
						
						$psizes = $this->input->post('psize');
						if(!empty($psizes)){
							foreach ($psizes as $psize) {
								if(!empty ($psize)){
									$this->products_model->add_psize($id, $psize);
								}else{

								}
							}
						}
						if ($data["product_main_image"][0]->image != 'images/images/no_image.jpg') {
                            $data['product_image_flag'] = $this->products_model->GetProductImageFlag($id);
							$i = 0 ;
							$n = $data['product_image_flag'][0]->flag +1 ;
							while ($i < count($_FILES['photo']['name'])) {
								$date_image = time(). $i;
								$upload_path = 'upload/product/';
								$image_path = $upload_path. $date_image. '.jpg';
								$this->upload->initialize($this->set_upload_options($upload_path,$date_image));	
								if ($_FILES['photo']['size'][$i]<'999999') {
									if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $image_path)) {
											// ---------------------------------------------------------
											//resize image----------------------------------------------
											$width = '600';
											$height = '400';
											$this->resize_image($image_path,$width,$height);
											//making thumb ---------------------------------------------
											$width = '100';
											$height = '100';
											$this->making_thumb($image_path,$width,$height);
											$thumb = $upload_path . $date_image. '_thumb.jpg';
											// ---------------------------------------------------------
											$this->products_model->add_product_image($id, $image_path,$thumb ,$n );
									}
								}else{
									$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
									redirect('webadmin/product/edit/'.$id);
								}
								$n++;
								$i++;
							}
						} else {
							$this->session->set_flashdata('login_error','يجب اضافة الصورة الرئيسية للمنتج حتي تتمكن من اضافة باقي الصور.....');
							redirect('webadmin/product/edit/'.$id);
					    }
						set_msg('تم التعديل  بنجاح','');			
						redirect('webadmin/product');
                    }
                } else {
                    redirect('webadmin/product');
                }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                 if(!$checks){
				 } else {
                foreach ($checks as $check) {
                    $this->products_model->delete_product($check);
                }}sleep(1);

                redirect('webadmin/product');
            } else {
                
				$base_url = base_url() . 'webadmin/product/';
                $total_rows = $this->products_model->count_products();
                $per_page = '10';
                $uri_segment= '3';
				
                $data["cats"] = $this->cats_model->GetAllCats();
				$data['products'] = $this->products_model->GetAllProducts($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
                $this->load->view('admin/products/products_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }

	
    function check_products_offer_expire() {
		$date= time();
		$data['products_offer'] = $this->products_model->GetAllProducts();
            if(!empty($data['products_offer'])){
				for($i=0;$i<count($data['products_offer']);$i++){
					$product_id=$data['products_offer'][$i]->product_id;
					$offer_start=$data['products_offer'][$i]->offer_start;
				    $offer_start_time =strtotime($offer_start);
						
					$offer_expire=$data['products_offer'][$i]->offer_expire;
				    $offer_expire_time =strtotime($offer_expire);						
						if($offer_start_time <= $date && $offer_expire_time >= $date){
							$this->products_model->update_statue_offer_start($product_id);
								
						}else{
							$this->products_model->update_statue_offer_expire($product_id);
						}
				}		
			}

	}					
    
	
	function pcat($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
		   if ($method == 'sort') {
					$this->form_validation->set_rules('sort', 'Order','trim|required|numeric|max_length[10]|xss_clean');
                if ($this->form_validation->run() == FALSE) {
					$id = $this->input->post('cat_id'); 
					$product_id = $this->input->post('product_id');
					$base_url = base_url().'webadmin/pcat/'.$id.'/';
					$total_rows = $this->products_model->count_GetAllProductscat($id);
					$per_page = '10';
					$uri_segment= '4';
					
					$data['pcat']="true";
					$data['cat_id']=$id;
					$data['product_id']=$product_id;
					$data["cats"] = $this->cats_model->GetAllCats();
					$data['products'] = $this->products_model->GetAllProductscat($id,$per_page,$this->uri->segment(4));
					$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
								
					$this->load->view('admin/products/products_view', $data);
		         	

                } else {
			
				$sort = $this->input->post('sort');
				$cat_id = $this->input->post('cat_id'); 
				$product_id = $this->input->post('product_id');

				$sort=$sort-1;
				$data['count'] = $this->products_model->count_GetAllProductscat($cat_id);
				$count =$data["count"];
					if($sort>=0&&$sort<$count){
						$data['product'] = $this->products_model->GetProductByID($product_id);
						$current_sort = $data["product"][0]->sort;			
						$data['product_next'] = $this->products_model->Getsort($sort,$cat_id);
						$old = $data["product_next"][0]->sort;
						
						$temp_sort = '-1';
						
						$this->products_model->update_sort($old,$temp_sort,$current_sort);
						set_msg('لقد تم تغير الترتيب بنجاح...','');

					}else{
						$this->session->set_flashdata('login_error','الترتيب الذي ادخلته غير صحيح');
						$product_id = $this->input->post("product_id");
						$this->session->set_flashdata('product_id',$product_id);
					}
				redirect('webadmin/pcat/'.$cat_id );

				}
				
		
            }elseif ($method == 'sort_up') {
			    $data['product'] = $this->products_model->GetProductByID($id);
				$cat = $data["product"][0]->cat_id_fk;	
				$sort = $data["product"][0]->sort;
				$data['catnext'] = $this->products_model->Getnext($sort,$cat);
                $nextsort = $data["catnext"][0]->sort;
				$temp_sort = '-1';
                
				$this->products_model->update_sort($nextsort,$temp_sort,$sort);

            }elseif ($method == 'sort_down') {
				
				$data['product'] = $this->products_model->GetProductByID($id);
				$cat = $data["product"][0]->cat_id_fk;
				$sort = $data["product"][0]->sort;
				$data['catprev'] = $this->products_model->Getprev($sort,$cat);
				$prevsort = $data["catprev"][0]->sort;
				$temp_sort = '-1';
				
				$this->products_model->update_sort($prevsort,$temp_sort,$sort);
				
		    }elseif ($method == 'do_sort') {
				redirect($this->agent->referrer());          
            }else {
			
			    $id=$method;

				if ($id && $this->cats_model->GetCatByID($id)) {
												
					$base_url = base_url().'webadmin/pcat/'.$id.'/';
					$total_rows = $this->products_model->count_GetAllProductscat($id);
					$per_page = '10';
					$uri_segment= '4';
					
					$data['pcat']="true";
					$data['cat_id']=$id;
					$data["cats"] = $this->cats_model->GetAllCats();
					$data['products'] = $this->products_model->GetAllProductscat($id,$per_page,$this->uri->segment(4));
					$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
								
					$this->load->view('admin/products/products_view', $data);
		               
				} else {
					redirect('webadmin/product');
				}
				
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
    
	function pcode($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {

			 $this->form_validation->set_rules('product_code', 'CODE', 'trim|required|numeric');
                
                if ($this->form_validation->run() == FALSE) {
					
					$base_url = base_url() . 'webadmin/product/';
					$total_rows = $this->products_model->count_products();
					$per_page = '10';
					$uri_segment= '3';
					
					$data["cats"] = $this->cats_model->GetAllCats();
					$data['products'] = $this->products_model->GetAllProducts($per_page,$this->uri->segment(3));
					$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
								
					$this->load->view('admin/products/products_view', $data);
					
				} else {
					
					$product_id = $this->input->post('product_code');
					$data["cats"] = $this->cats_model->GetAllCats();
					$data['products'] = $this->products_model->GetProductByID($product_id);;
                  
					$this->load->view('admin/products/products_view', $data);
				}	
					
        } else {
            redirect('webadmin/login');
        }
    }
	
	function image($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->products_model->delete_image($id);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	/*function pvideo($method = '', $product_id = '', $video_id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->products_model->delete_pvideo($video_id);
            } elseif ($method == 'edit') {
               if ($video_id && $this->products_model->GetpvideoByID($video_id)) {
                    $data['this_product'] = $this->products_model->GetProductByID($product_id);
                    $data["pvideo"] = $this->products_model->GetpvideoByID($video_id);
                    $this->form_validation->set_rules('Product Video', 'pvideo', 'required');
                    if ($this->form_validation->run() == FALSE) {
                        $this->load->view('admin/products/edit_p_video_view', $data);
                    } else {
                        // form data
                        $pvideo = $this->input->post("pvideo");

                        $this->products_model->edit_pvideo($video_id, $pvideo);

                        redirect('webadmin/product/edit/' . $product_id);
                    }
					
				} else {
                    redirect('webadmin/product');
                }	
            
           }
        } else {
            redirect('webadmin/login');
        }
    }*/
	function pvideo($method = '', $product_id = '', $pvideo_id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->products_model->delete_pvideo($pvideo_id);
            }elseif ($method == 'edit') {
				    if ($product_id && $this->products_model->GetProductByID($product_id)&&$this->products_model->GetpvideoByproduct($product_id)) {
						if ($pvideo_id && $this->products_model->join_pvideo($pvideo_id)) {
							$data['this_product'] = $this->products_model->GetProductByID($product_id);
							$data["pvideo"] = $this->products_model->GetpvideoByID($pvideo_id);
							$this->form_validation->set_rules('pvideo','Product Video', 'trim|max_length[500]|xss_clean|required');
							if ($this->form_validation->run() == FALSE) {
								$this->load->view('admin/products/edit_p_video_view', $data);
							} else {
								// form data
								$pvideo = $this->input->post("pvideo");

								$this->products_model->edit_pvideo($pvideo_id, $pvideo);

								redirect('webadmin/product/edit/' . $product_id);
							}
					    }else{
							redirect('webadmin/product');
					    }
				    }else{
						redirect('webadmin/product');
					}
            } else {
			   redirect('webadmin/product');
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	
	
	
	
	function catigory($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->cats_model->delete_catigory($id);
	    	}elseif ($method == 'sort') {
	
				$this->form_validation->set_rules('sort', 'Order','trim|required|numeric|max_length[10]|xss_clean');

                if ($this->form_validation->run() == FALSE) {
				$base_url = base_url() . 'webadmin/catigory/';
                $total_rows = $this->cats_model->count_cat();
                $per_page = '10';
                $uri_segment= '3';
                  				
				$data['cats'] = $this->cats_model->GetAllCats($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
				$cat_id = $this->input->post("cat_id");
				$data['cat_id'] = $cat_id;
				
                $this->load->view('admin/cats/catigory_view', $data);

                } else {
			
				$sort = $this->input->post('sort');
				$cat_id = $this->input->post('cat_id');

				$sort = $sort-1;
				$data['count'] = $this->cats_model->count_cat();
				$count =$data["count"];
				if($sort>=0&&$sort<$count){

					$data['cat'] = $this->cats_model->GetCatByID($cat_id);
					$current_sort = $data["cat"][0]->sort;			
					$data['catnext'] = $this->cats_model->Getsort($sort);
					$old = $data["catnext"][0]->sort;
					
					$temp_sort = '-1';
					
					$this->cats_model->update_sort($old,$temp_sort,$current_sort);
					set_msg('لقد تم تغير الترتيب بنجاح...','');

					}else{
						$this->session->set_flashdata('login_error','الترتيب الذي ادخلته غير صحيح');
						$cat_id = $this->input->post("cat_id");
						$this->session->set_flashdata('cat_id',$cat_id);
					}
				redirect('webadmin/catigory');

				}
            }elseif ($method == 'sort_up') {
			    $data['cat'] = $this->cats_model->GetCatByID($id);
				$sort = $data["cat"][0]->sort;
				$data['catnext'] = $this->cats_model->Getnext($sort);
                $nextsort = $data["catnext"][0]->sort;
				
				$temp_sort = '-1';
                
				$this->cats_model->update_sort($nextsort,$temp_sort,$sort);
			
            }elseif ($method == 'sort_down') {
			    
				$data['cat'] = $this->cats_model->GetCatByID($id);
				$sort = $data["cat"][0]->sort;
				$data['catprev'] = $this->cats_model->Getprev($sort);
				$prevsort = $data["catprev"][0]->sort;
				$temp_id = '-1';
			
				$this->cats_model->update_sort($prevsort,$temp_id,$sort);
			
            }elseif ($method == 'do_sort') {
               
				redirect($this->agent->referrer());
            } elseif ($method == 'edit') {

                if ($id && $this->cats_model->GetCatByID($id)) {

                    $data['cat'] = $this->cats_model->GetCatByID($id);
					$this->form_validation->set_rules('cat_name', 'Catigory name', 'trim|required|max_length[100]|xss_clean');
                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view('admin/cats/edit_cat_view', $data);
                    } else {

                        $cat_name = $this->input->post("cat_name");
						if (!empty($_FILES['photo_thumb']['name'])) {
						$date_image = time();
						$upload_path = 'upload/catigory/';
					    $path = $upload_path. $date_image. '.jpg';

                        $this->upload->initialize($this->set_upload_options($upload_path,$date_image));
                      
						 if(!$this->upload->do_upload('photo_thumb')){
						
						$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
						redirect('webadmin/catigory/edit/'.$id);
						 
						 }
						//resize image----------------------------------------------
						$width = '510';
						$height = '309';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
							// -------------------------------------------------
					}else{
                        $path = $data["cat"][0]->path ;
						$thumb = $data["cat"][0]->thumb ;

						
                    }
                        $this->cats_model->edit_catigory($id, $cat_name, $path,$thumb);
                        redirect('webadmin/catigory');
                    }
                } else {
					set_msg('تم التعديل  بنجاح','');
                    redirect('webadmin/catigory');
                }
            } elseif ($method == 'add') {
               
			
                $this->form_validation->set_rules('catigory_name', 'Catigory name', 'trim|required|max_length[100]|xss_clean');
                
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('admin/cats/add_cat_view');
                } else {
				
				        $catigory_name = $this->input->post('catigory_name');
				      	if (!empty($_FILES['photo_thumb']['name'])) {
						$date_image = time();
						$upload_path = 'upload/catigory/';
					    $path = $upload_path. $date_image. '.jpg';

                        $this->upload->initialize($this->set_upload_options($upload_path,$date_image));
                       
						if(!$this->upload->do_upload('photo_thumb')){
						
							$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
							redirect('webadmin/catigory/add');
						 
						}
                        //resize image----------------------------------------------
						$width = '510';
						$height = '309';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
							
						}else{
							$this->session->set_flashdata('login_error','يجب ادخال صورة');
							redirect('webadmin/catigory/add');
                    }
				$this->cats_model->add_cat($catigory_name, $path,$thumb);
					set_msg('تم الاضافة بنجاح','');
                    redirect('webadmin/catigory');
                }
            }elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                 if($checks){
                foreach ($checks as $check) {
                    $this->cats_model->delete_catigory($check);
                }}
				set_msg('تم الحذف  بنجاح','');
				redirect('webadmin/catigory');
			//	redirect($this->agent->referrer());
            } else {
                $base_url = base_url() . 'webadmin/catigory/';
                $total_rows = $this->cats_model->count_cat();
                $per_page = '10';
                $uri_segment= '3';

				$data['cats'] = $this->cats_model->GetAllCats($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
                $this->load->view('admin/cats/catigory_view', $data);
   
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function payment($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->payment_model->delete_payment($id);
            }elseif ($method == 'sort') {
			$this->form_validation->set_rules('sort', 'Order','trim|required|numeric|max_length[10]|xss_clean');

                if ($this->form_validation->run() == FALSE) {
				$base_url = base_url() . 'webadmin/payment/';
                $total_rows = $this->payment_model->count_payment();
                $per_page = '10';
                $uri_segment= '3';
                        

				$data['payment'] = $this->payment_model->GetAllpayment($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
				$payment_id = $this->input->post("payment_id");
				$data['payment_id'] = $payment_id;
				
                $this->load->view('admin/payment/payment_view', $data);

                } else {
			
				$sort = $this->input->post('sort');
				$payment_id = $this->input->post('payment_id');

				$sort=$sort-1;
				$data['count'] = $this->payment_model->count_payment();
				$count =$data["count"];
					if($sort>=0&&$sort<$count){
						$data['payment'] = $this->payment_model->GetpaymentByID($payment_id);
						$current_sort = $data["payment"][0]->sort;			
						$data['paymentnext'] = $this->payment_model->Getsort($sort);
						$old = $data["paymentnext"][0]->sort;
						
						$temp_sort = '-1';
						
						$this->payment_model->update_sort($old,$temp_sort,$current_sort);
						set_msg('لقد تم تغير الترتيب بنجاح...','');

					}else{
						$this->session->set_flashdata('login_error','الترتيب الذي ادخلته غير صحيح');
						$payment_id = $this->input->post("payment_id");
						$this->session->set_flashdata('payment_id',$payment_id);
					}
				redirect('webadmin/payment');

				}
				
            }elseif ($method == 'sort_up') {
			    $data['payment'] = $this->payment_model->GetpaymentByID($id);
				$sort = $data["payment"][0]->sort;
				$data['paymentnext'] = $this->payment_model->Getnext($sort);
                $nextsort = $data["paymentnext"][0]->sort;
				
				
				$temp_sort = '-1';
                
				$this->payment_model->update_sort($nextsort,$temp_sort,$sort);
								
            }elseif ($method == 'sort_down') {
			    
				$data['payment'] = $this->payment_model->GetpaymentByID($id);
				$sort = $data["payment"][0]->sort;
				$data['catprev'] = $this->payment_model->Getprev($sort);
				$prevsort = $data["catprev"][0]->sort;
				$temp_sort = '-1';
				
				
                
				$this->payment_model->update_sort($prevsort,$temp_sort,$sort);
				
            }elseif ($method == 'do_sort') {
               
				redirect($this->agent->referrer());
            } elseif ($method == 'edit') {

                if ($id && $this->payment_model->GetpaymentByID($id)) {

                    $data['payment'] = $this->payment_model->GetpaymentByID($id);
					
                    $this->form_validation->set_rules('payment_name', 'Payment Method', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('content', 'Content', 'trim|required');

                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view('admin/payment/edit_payment_view', $data);
                    } else {

                        $payment_name = $this->input->post("payment_name");
						$content = $this->input->post('content');
						if (!empty($_FILES['photo_thumb']['name'])) {
						$date_image = time();
						$upload_path = 'upload/payment/';
					    $path = $upload_path. $date_image. '.jpg';

                        $this->upload->initialize($this->set_upload_options($upload_path,$date_image));
                        
					    if(!$this->upload->do_upload('photo_thumb')){
						
						$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
						redirect('webadmin/payment/edit/'.$id);
						 
						}
					    //resize image----------------------------------------------
						$width = '620';
						$height = '60';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
						
						}else{
                        $path = $data["payment"][0]->path ;
                        $thumb = $data["payment"][0]->thumb ;
                    }
                        $this->payment_model->edit_payment($id, $payment_name,$content, $path,$thumb);
						set_msg('تم التعديل بنجاح','');
                        redirect('webadmin/payment');
                    }
                } else {
                    redirect('webadmin/payment');
                }
            } elseif ($method == 'add') {

                    $this->form_validation->set_rules('payment_name', 'Payment Method', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('content', 'Content', 'trim|required');


					if($this->form_validation->run() == FALSE) {
						$this->load->view('admin/payment/add_payment_view');
					}else {
					
					$payment_name = $this->input->post('payment_name');
					$content = $this->input->post('content');
					
							if (!empty($_FILES['photo_thumb']['name'])) {
								$date_image = time();
								$upload_path = 'upload/payment/';
								$path = $upload_path. $date_image. '.jpg';
								$this->upload->initialize($this->set_upload_options($upload_path,$date_image));

								if(!$this->upload->do_upload('photo_thumb')){
									$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
									redirect('webadmin/payment/add');
								}
							   //resize image----------------------------------------------
								$width = '620';
								$height = '60';
								$this->resize_image($path,$width,$height);
								//making thumb -------------------------------------
								$width = '100';
								$height = '100';
								$this->making_thumb($path,$width,$height);
								$thumb = $upload_path . $date_image. '_thumb.jpg';
								// -------------------------------------------------
							}else{
							$this->session->set_flashdata('login_error','يجب ادخال صورة');
							redirect('webadmin/payment/add');
						}
					$this->payment_model->add_payment($payment_name,$content, $path,$thumb);
					set_msg('تم الاضافة بنجاح','');
					redirect('webadmin/payment');
					}
				
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
				if($checks){
                foreach ($checks as $check) {
                    $this->payment_model->delete_payment($check);
                }}
				set_msg('تم الحذف  بنجاح','');
                redirect('webadmin/payment');
				//redirect($this->agent->referrer());
            } else {
                $base_url = base_url() . 'webadmin/payment/';
                $total_rows = $this->payment_model->count_payment();
                $per_page = '10';
                $uri_segment= '3';

				$data['payment'] = $this->payment_model->GetAllpayment($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
                $this->load->view('admin/payment/payment_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function inbox($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->contact_model->delete_message($id);
            } if ($method == 'show') {
                    $data['this_message'] = $this->contact_model->GetMessageByID($id);
                    $this->load->view('admin/inbox/show_message_view', $data);
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->contact_model->delete_message($check);
                }
				set_msg('تم الحذف  بنجاح','');
                redirect('webadmin/inbox');
            } else {
				$base_url = base_url() . 'webadmin/inbox/';
                $total_rows = $this->contact_model->count_inbox();
                $per_page = '10';
                $uri_segment= '3';

				$data['messages'] = $this->contact_model->GetALLMessages($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
							
                $this->load->view('admin/inbox/inbox_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	
	function comment($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->products_model->delete_comment($id);
            } if ($method == 'show') {
                    $data['this_comment'] = $this->products_model->GetcommentByID($id);
                    $this->load->view('admin/comments/show_comment_view', $data);
            } elseif ($method == 'update') {
                $statue = $this->input->post('statue');
               
                    $this->products_model->edit_comment($id, $statue);
                
                redirect('webadmin/comment');
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->products_model->delete_comment($check);
                }
                redirect('webadmin/comment');
            } elseif ($method == 'product') {
				 $this->form_validation->set_rules('product_code', 'CODE', 'trim|required|numeric');
                
                if ($this->form_validation->run() == FALSE) {
					
					$base_url = base_url() . 'webadmin/comment/';
					$total_rows = $this->products_model->count_comment();
					$per_page = '10';
					$uri_segment= '3';
					$data['products'] = $this->products_model->GetAllProducts();
					$data['comments'] = $this->products_model->GetALLcomment($per_page,$this->uri->segment(3));
					$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
								
					$this->load->view('admin/comments/comment_view', $data);
				} else {
					$product_id = $this->input->post('product_code');
					$data['products'] = $this->products_model->GetAllProducts();
					$data['comments'] = $this->products_model->GetProductcomment($product_id);
                  
					$this->load->view('admin/comments/comment_view', $data);
				}				
            } else {
				
                	$base_url = base_url() . 'webadmin/comment/';
					$total_rows = $this->products_model->count_comment();
					$per_page = '10';
					$uri_segment= '3';
					$data['products'] = $this->products_model->GetAllProducts();
					$data['comments'] = $this->products_model->GetALLcomment($per_page,$this->uri->segment(3));
					$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
								
                $this->load->view('admin/comments/comment_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }

/*
	function report($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->user_model->delete_report($id);
            } if ($method == 'show') {
                    $data['this_message'] = $this->user_model->GetreportByID($id);
                    $this->load->view('admin/show_report_view', $data);
            } elseif ($method == 'update') {
                $statue = $this->input->post('statue');
               
                    $this->user_model->edit_report($id, $statue);
                
                redirect('webadmin/report');
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->user_model->delete_report($check);
                }
                redirect('webadmin/report');
            } else {
                				
							
					$config['base_url'] = base_url().'webadmin/report/';
					$config['total_rows'] =  $this->user_model->count_report();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['messages'] = $this->user_model->GetALLreport($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
				
                $this->load->view('admin/report_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function buyer_report($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->buyer_model->delete_report($id);
            } if ($method == 'show') {
                    $data['this_message'] = $this->buyer_model->GetreportByID($id);
                    $this->load->view('admin/show_buyer_report_view', $data);
            } elseif ($method == 'update') {
                $statue = $this->input->post('statue');
               
                    $this->buyer_model->edit_report($id, $statue);
                
                redirect('webadmin/buyer_report');
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->buyer_model->delete_report($check);
                }
                redirect('webadmin/buyer_report');
            } else {
                				
							
					$config['base_url'] = base_url().'webadmin/buyer_report/';
					$config['total_rows'] =  $this->buyer_model->count_report();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['messages'] = $this->buyer_model->GetALLreport($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
				
                $this->load->view('admin/buyer_report_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	*/

	function pay_confirm($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->products_model->delete_messagepay($id);
            } if ($method == 'show') {
					if ($id && $this->products_model->GetMessagepayByID($id)) {    
                    $data['this_message'] = $this->products_model->GetMessagepayByID($id);
                    $this->load->view('admin/pay_confirm/show_pay_confirm_view', $data);
					}else{ 
					redirect('webadmin/pay_confirm');
				    }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->products_model->delete_messagepay($check);
                }
                redirect('webadmin/pay_confirm');
            } else {
                				
					$config['base_url'] = base_url().'webadmin/pay_confirm/';
					$config['total_rows'] =  $this->products_model->count_pay();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['messages'] = $this->products_model->GetALLMessagespay($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
				
                $this->load->view('admin/pay_confirm/pay_confirm_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }

    
    
    function order($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            
                if ($method == 'show') {
                    $data['this_order'] = $this->orders->GetOrderByID($id);
                    $this->load->view('admin/order_view', $data);
                }elseif ($method == 'edit') {
					if ($id && $this->orders->GetOrderByID($id)) {
					 
					$data['this_order'] = $this->orders->GetOrderByID($id);
					$this->form_validation->set_rules('notes', 'notes', 'trim|max_length[100]|xss_clean');
			
						if ($this->form_validation->run() == FALSE) {
							$this->load->view('admin/orders/edit_order_view', $data);
						} else {					
						$notes = $this->input->post("notes");
						$this->orders->edit_order($id,$notes);
						redirect('webadmin/order');
						}
	                }else {
						redirect('webadmin/order');
					}
                }  elseif ($method == 'delete') {
                    $this->orders->del_order($id);
                } elseif ($method == 'do_operation') {
                    $checks = $this->input->post('chk');
                    foreach ($checks as $check) {
                        $this->orders->del_order($check);
                    }
                    redirect('webadmin/order');
                }
            else {
                
				
					$config['base_url'] = base_url().'webadmin/order/';
					$config['total_rows'] =  $this->orders->count_order();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['orders'] = $this->orders->GetAllOrders($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
                $this->load->view('admin/orders/order_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	
	 function newsletter($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->contact_model->delete_newsletter($id);
            } elseif ($method == 'export') {
				$this->admin_model->export_newsletter();
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->contact_model->delete_newsletter($check);
                }
				set_msg('تم الحذف  بنجاح','');
                redirect('webadmin/newsletter');
            } else {
                $base_url = base_url() . 'webadmin/newsletter/';
                $total_rows =$this->contact_model->count_Newsletter();
                $per_page = '10';
                $uri_segment= '3';

				$data['emails'] = $this->contact_model->GetALLNewsletter($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
	
                $this->load->view('admin/newsletter/newsletter_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }


    function slider($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
			$this->check_slider_expire();
            if ($method == 'delete') {
                $this->admin_model->delete_slider($id);
            } elseif ($method == 'edit') {
                if ($id && $this->admin_model->GetsliderByID($id)) {
                    $data['this_slider'] = $this->admin_model->GetsliderByID($id);
					
                    $this->form_validation->set_rules('slider_name', 'slider', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('slider_expire', 'Expired Date', 'trim|max_length[100]|xss_clean');
                
                    
					if ($this->form_validation->run() == false) {
                        $this->load->view('admin/sliders/edit_slider_view', $data);
                    } else {
					
                        $slider_name = $this->input->post("slider_name");
                        $slider_url =  $this->input->post("slider_url");
						
						$slider_expire =  $this->input->post("slider_expire");
					    $slider_expire_time =strtotime($slider_expire);
                        if(empty($slider_expire_time)|| $slider_expire_time == false){
							$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
							redirect('webadmin/slider/edit/'.$id);
						 
						}
						
						if (!empty($_FILES['slider_image']['name'])) {
							$date_image = time();
							$upload_path = 'upload/slider/';
							$path = $upload_path. $date_image. '.jpg';
							$this->upload->initialize($this->set_upload_options($upload_path,$date_image));

                         if(!$this->upload->do_upload('slider_image')){
						
							$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
						    redirect('webadmin/slider/edit/'.$id);
						 
						 }
					    //resize image----------------------------------------------
						$width = '536';
						$height = '285';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
                        }else{
                        $data['this_slider'] = $this->admin_model->GetsliderByID($id);
                        $path = $data['this_slider'][0]->slider_image ;
                        $thumb = $data['this_slider'][0]->thumb ;
						
						
						
						}
						$now=time();
						
						
						if($slider_expire_time>=  $now){
							$statue = '1';
						}else{
							$statue = '0';
						}
					
                        $this->admin_model->edit_slider($id, $slider_name, $slider_url, $path,$thumb,$slider_expire,$statue);
						
						set_msg('تم التعديل  بنجاح','');
                        redirect('webadmin/slider');
                    }
                } else {
                    redirect('webadmin/slider');
                }
            } elseif ($method == 'add') {
			  
                $this->form_validation->set_rules('slider_name', 'slider', 'trim|required|max_length[100]|xss_clean');
                $this->form_validation->set_rules('slider_expire', 'Expired Date', 'trim|max_length[100]|xss_clean');
                  
				if ($this->form_validation->run() == false) {
                    $this->load->view('admin/sliders/add_slider_view');
                } else {
                    $slider_name = $this->input->post('slider_name');
                    $slider_url =  $this->input->post("slider_url");
					
					$slider_expire =  $this->input->post("slider_expire");
					$slider_expire_time =strtotime($slider_expire);
                    if(empty($slider_expire_time)|| $slider_expire_time == false){
					$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
						redirect('webadmin/slider/add');
					}	 	
						
					
					if (!empty($_FILES['slider_image']['name'])) {
						$date_image = time();
						$upload_path = 'upload/slider/';
						$path = $upload_path. $date_image. '.jpg';
						$this->upload->initialize($this->set_upload_options($upload_path,$date_image));
						if(!$this->upload->do_upload('slider_image')){
						
			     		$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
						redirect('webadmin/slider/add');
						 
						 }
					   //resize image----------------------------------------------
						$width = '536';
						$height = '285';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------	 
					}else{
                        $this->session->set_flashdata('login_error','يجب ادخال صورة');                                                               
						redirect('webadmin/slider/add');
                    }
					
					$now=time();
						
						if($slider_expire_time >=  $now){
							$statue = '1';
						}else{
							$statue = '0';
						}
					
                    $this->admin_model->add_slider($slider_name, $slider_url, $path ,$thumb,$slider_expire,$statue);
					set_msg('تم الاضافة  بنجاح','');
                    redirect('webadmin/slider');
                }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->admin_model->delete_slider($check);
                }
				set_msg('تم الحذف  بنجاح','');
                redirect('webadmin/slider');
            } else {
				$base_url = base_url().'webadmin/slider/';
                $total_rows = $this->admin_model->count_slider();
                $per_page = '10';
                $uri_segment= '3';

				$data['sliders'] = $this->admin_model->GetAllsliders($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
	
                $this->load->view('admin/sliders/slider_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function check_slider_expire(){
		    $date= time();
			$data['sliders_load'] = $this->admin_model->GetAllsliders();
                if(!empty($data['sliders_load'])){

					for($i=0;$i<count($data['sliders_load']);$i++){
						$slider_id=$data['sliders_load'][$i]->slider_id;
						//$slider_start=$data['sliders_load'][$i]->slider_start;
					   // $slider_start_time =strtotime($slider_start);
						
						$slider_expire=$data['sliders_load'][$i]->slider_expire;
					    $slider_expire_time =strtotime($slider_expire);
						
						if( $slider_expire_time >= $date){
							$this->admin_model->update_statue_start_slider($slider_id);
								
						}else{
							$this->admin_model->update_statue_expire_slider($slider_id);
						}
				    }		
				}
	}
	
	function ads($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->admin_model->delete_ad($id);
            } elseif ($method == 'edit') {
                if ($id && $this->admin_model->GetAdByID($id)) {
                    $data['this_ad'] = $this->admin_model->GetAdByID($id);
					
				$this->form_validation->set_rules('ad_name', 'ad', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('ad_start', 'Start Date', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('ad_expire', 'Expired Date', 'trim|required|max_length[100]|xss_clean');
                    
                    
					if ($this->form_validation->run() == false) {
                        $this->load->view('admin/ads/edit_ad_view', $data);
                    } else {
					
                        $ad_name = $this->input->post("ad_name");
                        $ad_url =  $this->input->post("ad_url");
						
						$ad_start =  $this->input->post("ad_start");
					    $ad_start_time =strtotime($ad_start);
				        if(empty($ad_start_time)|| $ad_start_time == false){
							$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
							redirect('webadmin/ads/edit/'.$id);
						 
						}

						$ad_expire =  $this->input->post("ad_expire");
					    $ad_expire_time =strtotime($ad_expire);
						if(empty($ad_expire_time)|| $ad_expire_time == false){
							$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
							redirect('webadmin/ads/edit/'.$id);
						 
						}
						
						
						if (!empty($ad_expire)) {
						 
						}else{
						$ad_expire=$data['this_ad'][0]->ad_expire;
						$ad_expire_time=$data['this_ad'][0]->ad_expire_time;
						} 
						
						
						if (!empty($_FILES['ad_image']['name'])) {
						$date_image = time();
						$upload_path = 'upload/ads/';
						$path = $upload_path. $date_image. '.jpg';
						$this->upload->initialize($this->set_upload_options($upload_path,$date_image));
						
                        if(!$this->upload->do_upload('ad_image')){
						
							$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
							redirect('webadmin/ads/edit/'.$id);
						 
						 }
					   //resize image----------------------------------------------
						$width = '546';
						$height = '285';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
						}else{
                        $data['this_ad'] = $this->admin_model->GetAdByID($id);
                        $path = $data['this_ad'][0]->ad_image ;
                        $thumb = $data['this_ad'][0]->thumb ;
						
						
						
						}
						
						
						$date=time();
						if($ad_start_time <= $date && $ad_expire_time >= $date){
								$statue = '1';
						}else{
								$statue = '0';
						}
					
                        $this->admin_model->edit_ad($id, $ad_name, $ad_url, $path,$thumb,$ad_start ,$ad_expire,$statue);
						set_msg('تم التعديل  بنجاح','');						
                        redirect('webadmin/ads');
                    }
                } else {
                    redirect('webadmin/ads');
                }
            } elseif ($method == 'add') {
			 
                $this->form_validation->set_rules('ad_name', 'ad', 'trim|required|max_length[100]|xss_clean');
                $this->form_validation->set_rules('ad_start', 'Start Date', 'trim|max_length[100]|xss_clean');
                $this->form_validation->set_rules('ad_expire', 'Expired Date', 'trim|max_length[100]|xss_clean');
                       
				if ($this->form_validation->run() == false) {
                    $this->load->view('admin/ads/add_ad_view');
                } else {
                    $ad_name = $this->input->post('ad_name');
                    $ad_url =  $this->input->post("ad_url");
					
					$ad_start =  $this->input->post("ad_start");
					$ad_start_time =strtotime($ad_start);
					if(empty($ad_start_time)|| $ad_start_time == false){
					$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
						redirect('webadmin/ads/add');
					}
					
					$ad_expire =  $this->input->post("ad_expire");
					$ad_expire_time =strtotime($ad_expire);
					
                    if(empty($ad_expire_time)|| $ad_expire_time == false){
					$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
						redirect('webadmin/ads/add');
					}	 	
						
					
					
					
					if (!empty($_FILES['ad_image']['name'])) {
						$date_image = time();
						$upload_path = 'upload/ads/';
						$path = $upload_path. $date_image. '.jpg';
						$this->upload->initialize($this->set_upload_options($upload_path,$date_image));
                      if(!$this->upload->do_upload('ad_image')){
						
						$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
						redirect('webadmin/ads/add');
						 
						 }
					   //resize image----------------------------------------------
						$width = '546';
						$height = '285';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
				    }else{
                         $this->session->set_flashdata('login_error','يجب ادخال صورة');                                                               
						redirect('webadmin/ads/add');
                    }
					
					$date=time();
						if($ad_start_time <= $date && $ad_expire_time >= $date){
								$statue = '1';
						}else{
								$statue = '0';
						}
					
					   
					
                    $this->admin_model->add_ad($ad_name, $ad_url, $path ,$thumb,$ad_start ,$ad_expire ,$statue);
					set_msg('تم الاضافة  بنجاح','');
                    redirect('webadmin/ads');
                } 
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->admin_model->delete_ad($check);
                }
				set_msg('تم الحذف  بنجاح','');
                redirect('webadmin/ads');
            } else {
				
				$base_url = base_url() . 'webadmin/ads/';
                $total_rows = $this->admin_model->count_ads();
                $per_page = '10';
                $uri_segment= '3';
          
                $data['ads'] = $this->admin_model->GetAllAds($per_page, $this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
                
                $this->load->view('admin/ads/ad_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function check_ad_expire() {
	    $date= time();
		$data['ads_load'] = $this->admin_model->GetAllAds();
            if(!empty($data['ads_load'])){

				for($i=0;$i<count($data['ads_load']);$i++){
					$ad_id=$data['ads_load'][$i]->ad_id;
					$ad_start=$data['ads_load'][$i]->ad_start;
				    $ad_start_time =strtotime($ad_start);
							
					$ad_expire=$data['ads_load'][$i]->ad_expire;
				    $ad_expire_time =strtotime($ad_expire);
							
					if($ad_start_time <= $date && $ad_expire_time >= $date){
						$this->admin_model->update_statue_start_ad($ad_id);
								
					}else{
						$this->admin_model->update_statue_expire_ad($ad_id);
					}
			    }		
			}
	}
	
	function video($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->admin_model->delete_video($id);
            } elseif ($method == 'add') {
                $this->form_validation->set_rules('video_name', 'video name', 'trim|required|max_length[500]|xss_clean');
                $this->form_validation->set_rules('video_url', 'video link', 'trim|required|max_length[500]|xss_clean');
                if ($this->form_validation->run() == false) {
                    $this->load->view('admin/videos/add_video_view');
                } else {
                    $video_name = $this->input->post('video_name');
                    $video_url =  $this->input->post("video_url");
					
					$url =$this->admin_model->parse_youtube_url($video_url,'embed');
					$path =$this->admin_model->parse_youtube_url($video_url,'hqthumb');
                    $this->admin_model->add_video($video_name, $url, $path);
					set_msg('تم الاضافة  بنجاح','');
                    redirect('webadmin/video');
                }
			}elseif ($method == 'edit') {
                if ($id && $this->admin_model->GetvideoByID($id)) {
                    $data['this_video'] = $this->admin_model->GetvideoByID($id);
                    $this->form_validation->set_rules('video_name', 'video name', 'trim|required|max_length[500]|xss_clean');
                    $this->form_validation->set_rules('video_url', 'video link', 'trim|max_length[500]|xss_clean');
					if ($this->form_validation->run() == false) {
                        $this->load->view('admin/videos/edit_video_view', $data);
                    } else {
                        $video_name = $this->input->post("video_name");
                        $video_url =  $this->input->post("video_url");
						

						if(empty($video_url)){
							$url=$data['this_video'][0]->url;
							$path=$data['this_video'][0]->image;
						}else{
							$url =$this->admin_model->parse_youtube_url($video_url,'embed');
							$path =$this->admin_model->parse_youtube_url($video_url,'hqthumb');	
						}
                        $this->admin_model->edit_video($id, $video_name, $url, $path);
						set_msg('تم التعديل  بنجاح','');
                        redirect('webadmin/video');
                    }
                } else {
                    redirect('webadmin/video');
                }
            
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->admin_model->delete_video($check);
                }
				set_msg('تم الحذف  بنجاح','');
                redirect('webadmin/video');
            } else {
				
				$base_url = base_url() . 'webadmin/video/';
                $total_rows = $this->admin_model->count_video();
                $per_page = '10';
                $uri_segment= '3';

				$data['videos'] = $this->admin_model->GetAllvideos($per_page,$this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));			
			
                $this->load->view('admin/videos/video_view', $data);
				
				
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function contact($method = '') {
	    if ($this->session->userdata('logged_in')) {
			if ($method == 'add') {
				$this->form_validation->set_rules('contact_details', 'Contact Details', 'trim|required');
				if ($this->form_validation->run() == false) {
					if ($this->contact_model->GetcontactData()) {
						$data['details'] = $this->contact_model->GetcontactData();
						$this->load->view('admin/contact/add_contact_view', $data);
					} else {
						$data['details'] = false;
						$this->load->view('admin/contact/add_contact_view', $data);
					}
				} else {
					$contact_details = $this->input->post('contact_details');
					$this->contact_model->add_contact($contact_details);
					set_msg('تمت الاضافة بنجاح','');
					redirect('webadmin/contact');
				}
			} else {
				$this->load->view('admin/contact/contact_view');
			}
		} else {
            redirect('webadmin/login');
        }	
    }
	
	function facebook($method = '') {
	    if ($this->session->userdata('logged_in')) {
			if ($method == 'add') {
				$this->form_validation->set_rules('facebook', 'Facebook', 'trim|required|max_length[255]|xss_clean');	
				$this->form_validation->set_rules('twitter', 'Twitter', 'trim|max_length[255]|xss_clean');
				$this->form_validation->set_rules('youtube', 'Youtube', 'trim|max_length[255]|xss_clean');
				if ($this->form_validation->run() == false) {
					if ($this->admin_model->GetfaceData()) {
						$data['details'] = $this->admin_model->GetfaceData();
						$this->load->view('admin/facebook/add_facebook_view', $data);
					} else {
						$data['details'] = false;
						$this->load->view('admin/facebook/add_facebook_view', $data);
					}
				} else {
					$facebook = $this->input->post('facebook');
					$twitter = $this->input->post("twitter");
					$youtube =$this->input->post("youtube");
					
					$this->admin_model->add_face($facebook, $twitter,$youtube);
					set_msg('تم التعديل  بنجاح','');
					redirect('webadmin/facebook');
				}
			} else {
				$this->load->view('admin/facebook/facebook_view');
			}
		} else {
            redirect('webadmin/login');
        }	
    }
	
/*	
	function country($method = '', $id = '',$upload = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {

                $this->admin_model->delete_country($id);
				
            } elseif ($method == 'edit') {

                if ($id && $this->admin_model->GetcountryByID($id)) {
                if(!empty($upload)){
					$data["upload"]= "يوجد دولة بنفس الاسم";
					$data['cat'] = $this->admin_model->GetcountryByID($id);
					 $this->load->view('admin/edit_country_view', $data);
					} else { 
                    $data['cat'] = $this->admin_model->GetcountryByID($id);
				
                    $this->form_validation->set_rules('cat_name', 'Country name', 'trim|required|max_length(100)|xss_clean');
                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view('admin/edit_country_view', $data);
                    } else {

                        $cat_name = $this->input->post("cat_name");
						$data['samecountry'] = $this->admin_model->GetcountryByID($id);
						if($cat_name==$data['samecountry'][0]->name){
						}else{
                       $data['Allcountry'] = $this->admin_model->GetAllcountrys();
						for ($i = 0; $i < count($data['Allcountry']); $i++) {
						
						   $data['Allcountry'][$i]->name;
						   
						   if($cat_name==$data['Allcountry'][$i]->name){
						   $upload= "p";
						redirect('webadmin/country/edit/'.$id.'/'.$upload);
						   
						   }
						   
					  
						
						}}
						
		
						
                        $this->admin_model->edit_country($id, $cat_name);
                        redirect('webadmin/country');
                    }}
                } else {
                    redirect('webadmin/country');
                }
            } elseif ($method == 'add') {
               
                if(!empty($upload)){
					$data["upload"]= "يوجد دولة بنفس الاسم";
					
					 $this->load->view('admin/add_country_view', $data);
					} else { 
                $this->form_validation->set_rules('catigory_name', 'Country name', 'trim|required|max_length(100)|xss_clean');
                
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('admin/add_country_view');
                } else {
				
				$catigory_name = $this->input->post('catigory_name');
				$data['Allcountry'] = $this->admin_model->GetAllcountrys();
				for ($i = 0; $i < count($data['Allcountry']); $i++) {
						
						   $data['Allcountry'][$i]->name;
						   
						   if($catigory_name==$data['Allcountry'][$i]->name){
						   $upload= "p";
						redirect('webadmin/country/add/1/'.$upload);
						   
						   }
						   
					  
						
						}
				      
				$this->admin_model->add_country($catigory_name);
                    redirect('webadmin/country');
                }}
            }elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                 if($checks){
                foreach ($checks as $check) {
                    $this->admin_model->delete_country($check);
                }}
                redirect('webadmin/country');
            }elseif ($method == 'show') {
                $data['cats5'] = $this->admin_model->GetAllcountrys();
                $this->load->view('admin/catigory1_view');

                
                
            } else {

                
					$config['base_url'] = base_url().'webadmin/country/';
					$config['total_rows'] =  $this->admin_model->count_country();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['cats'] = $this->admin_model->GetAllcountrys($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
                $this->load->view('admin/country_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function city($method = '', $id = '',$upload = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {

                $this->admin_model->delete_city($id);
				
            } elseif ($method == 'edit') {

                if ($id && $this->admin_model->GetcityByID($id)) {
				
				 if(!empty($upload)){
					$data["upload"]= "يوجد مدينة بنفس الاسم";
					$data["country"] = $this->admin_model->GetAllcountrys();
                    $data['cat'] = $this->admin_model->GetcityByID($id);
					 $this->load->view('admin/edit_city_view', $data);
					} else { 
                    $data["country"] = $this->admin_model->GetAllcountrys();
                    $data['cat'] = $this->admin_model->GetcityByID($id);
				     
				    $this->form_validation->set_rules('cat_name', 'City name', 'trim|required');
                    
                    $this->form_validation->set_rules('country_id', 'Country name', 'trim|required|max_length(100)|xss_clean');
                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view('admin/edit_city_view', $data);
                    } else {

                        $cat_name = $this->input->post("cat_name");
						$country_id = $this->input->post("country_id");
						$data['samecity'] = $this->admin_model->GetcityByID($id);
						if($cat_name==$data['samecity'][0]->name){
						}else{
                       $data['Allcity'] = $this->admin_model->GetAllcitys();
						for ($i = 0; $i < count($data['Allcity']); $i++) {
						
						   $data['Allcity'][$i]->name;
						   
						   if($cat_name==$data['Allcity'][$i]->name){
						   $upload= "p";
						redirect('webadmin/city/edit/'.$id.'/'.$upload);
						   
						   }
						   
					  
						
						}}
						
                        $this->admin_model->edit_city($id, $cat_name,$country_id);
                        redirect('webadmin/city');
                    }}
                } else {
                    redirect('webadmin/city');
                }
            } elseif ($method == 'add') {
               
                  if(!empty($upload)){
					$data["upload"]= "يوجد مدينة بنفس الاسم";
					$data["country"] = $this->admin_model->GetAllcountrys();
					 $this->load->view('admin/add_city_view', $data);
					} else { 
                $this->form_validation->set_rules('country_id', 'Country name', 'trim|required');
                   
                $this->form_validation->set_rules('catigory_name', 'City name', 'trim|required|max_length(100)|xss_clean');
                
                if ($this->form_validation->run() == FALSE) {
				$data["country"] = $this->admin_model->GetAllcountrys();
                    $this->load->view('admin/add_city_view',$data);
                } else {
				
				$catigory_name = $this->input->post('catigory_name');
				$country_id = $this->input->post("country_id");
				$data['Allcity'] = $this->admin_model->GetAllcitys();
				for ($i = 0; $i < count($data['Allcity']); $i++) {
						
						   $data['Allcity'][$i]->name;
						   
						   if($catigory_name==$data['Allcity'][$i]->name){
						   $upload= "p";
						redirect('webadmin/city/add/1/'.$upload);
						   
						   }
						   
					  
						
						}      
				$this->admin_model->add_city($catigory_name,$country_id);
                    redirect('webadmin/city');
                }}
            }elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                 if($checks){
                foreach ($checks as $check) {
                    $this->admin_model->delete_city($check);
                }}
                redirect('webadmin/city');
            } else {

                				
				
					$config['base_url'] = base_url().'webadmin/city/';
					$config['total_rows'] =  $this->admin_model->count_city();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['cats'] = $this->admin_model->GetAllcitys($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
                $this->load->view('admin/city_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	 function users($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->user_model->delete_user($id);
            } elseif ($method == 'add') {
                $this->form_validation->set_rules('username', 'username', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				if ($this->form_validation->run() == false) {
                    $this->load->view('admin/add_user_view');
                } else {
                    $username = $this->input->post('username');
                    $password = $this->input->post("password");
                    $repassword = $this->input->post('repassword');
                    $email = $this->input->post('email');
                    if ($password == $repassword) {
                        if (!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email))) {
                            
                        } else {
                            $this->user_model->add_user($username, md5($password), $email);
                        }
                    } else {
                        
                    }
                    redirect('webadmin/users');
                }
            } elseif ($method == 'edit') {
                if ($id && $this->user_model->GetuserByID($id)) {
                    
                       $this->form_validation->set_rules('membership', 'Membership', 'required');
                      
                    if ($this->form_validation->run() == false) {
                         $data['this_user'] = $this->user_model->GetuserByID($id);
						 $data["phone"] = $this->user_model->GetphoneByuser($id);
				         $data["branch"] = $this->user_model->GetbranchByuser($id); 
                    $this->load->view('admin/edit_user_view', $data);
                    } else {
                        $membership = $this->input->post('membership');
                        $statue = $this->input->post("statue");
                      
                        
                           
                        $this->user_model->edit_authority($id,$membership);
                        $this->user_model->edit_statue($id,$statue);    
                        
                        redirect('webadmin/users');
                    }
                } else {
                    redirect("webadmin/users");
                }
            } elseif ($method == 'block') {
			
				$authority = '0';
                
				$this->user_model->edit_authority($id,$authority);
				$statue = '0';
				$this->user_model->edit_statue($id,$statue); 
                
				
                redirect('webadmin/users');
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
				  if(!$checks){
				 } else {
               
                foreach ($checks as $check) {
                    $this->user_model->delete_user($check);
                }}
                redirect('webadmin/users');
            }elseif ($method == 'show_product') {
			    if ($id && $this->user_model->GetuserByID($id)) {
					
						$config['base_url'] = base_url().'webadmin/users/show_product/'.$id;
						$config['total_rows'] =  $this->user_products_model->count_products($id);
						$config['per_page'] = '10';
						$config['uri_segment'] = '5';
						$config['num_links'] = '8';
						$config['full_tag_open'] = '<div ">';
						$config['full_tag_close'] = '</div>';
						
						  
						$config['next_link'] = '&gt;&gt;'; 
						$config['prev_link'] = '&lt;&lt;';

					$data['this_user'] = $this->user_model->GetuserByID($id);
					$data['products'] = $this->user_products_model->GetAllProducts($id,$config['per_page'],$this->uri->segment(5));
					$this->pagination->initialize($config);
					
					$this->load->view('admin/products_user_view', $data);
				} else {
                    redirect("webadmin/users");
                }
            }elseif ($method == 'show_payment') {
			    if ($id && $this->user_model->GetuserByID($id)) {
					
						$config['base_url'] = base_url().'webadmin/users/show_payment/'.$id;
						$config['total_rows'] =  $this->user_model->count_UserPayment($id);
						$config['per_page'] = '10';
						$config['uri_segment'] = '5';
						$config['num_links'] = '8';
						$config['full_tag_open'] = '<div ">';
						$config['full_tag_close'] = '</div>';
						
						  
						$config['next_link'] = '&gt;&gt;'; 
						$config['prev_link'] = '&lt;&lt;';

					$data['this_user'] = $this->user_model->GetuserByID($id);
					$data['cats'] = $this->user_model->GetUserPayment($id,$config['per_page'],$this->uri->segment(5));
					$this->pagination->initialize($config);
					
					$this->load->view('admin/payment_user_view', $data);
				} else {
                    redirect("webadmin/users");
                }
            }elseif ($method == 'show_offer') {
			    if ($id && $this->user_model->GetuserByID($id)) {
					
						$config['base_url'] = base_url().'webadmin/users/show_offer/'.$id;
						$config['total_rows'] =  $this->user_model->count_ads($id);
						$config['per_page'] = '10';
						$config['uri_segment'] = '5';
						$config['num_links'] = '8';
						$config['full_tag_open'] = '<div ">';
						$config['full_tag_close'] = '</div>';
						
						  
						$config['next_link'] = '&gt;&gt;'; 
						$config['prev_link'] = '&lt;&lt;';

					$data['this_user'] = $this->user_model->GetuserByID($id);
					$data['ads'] = $this->user_model->GetAllAds($id,$config['per_page'],$this->uri->segment(5));
					$this->pagination->initialize($config);
					
					$this->load->view('admin/offer_user_view', $data);
				} else {
                    redirect("webadmin/users");
                }
            } else {
			
			    
                $config['base_url'] = base_url() . 'webadmin/users/';
                $config['total_rows'] = $this->user_model->count_user();
                $config['per_page'] = '10';
                $config['uri_segment'] = '3';
                $config['num_links'] = '8';
                $config['full_tag_open'] = '<div ">';
                $config['full_tag_close'] = '</div>';


                $config['next_link'] = '&gt;&gt;';
                $config['prev_link'] = '&lt;&lt;';


                $data['users'] = $this->user_model->GetAllusers($config['per_page'], $this->uri->segment(3));
                $this->pagination->initialize($config);
				
				
                $this->load->view('admin/user_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function confirm_user($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
             if ($method == 'confirm') {
			
				$authority = '1';
                
				$this->user_model->edit_authority($id,$authority);
                $statue = 'on';
				$this->user_model->edit_statue($id,$statue); 
				
                redirect('webadmin/confirm_user');
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
				  if(!$checks){
				 } else {
               
                foreach ($checks as $check) {
                    $this->user_model->delete_user($check);
                }}
                redirect('webadmin/confirm_user');
            } else {
			    
                $config['base_url'] = base_url() . 'webadmin/users/';
                $config['total_rows'] = $this->user_model->count_confirm_user();
                $config['per_page'] = '10';
                $config['uri_segment'] = '3';
                $config['num_links'] = '8';
                $config['full_tag_open'] = '<div ">';
                $config['full_tag_close'] = '</div>';


                $config['next_link'] = '&gt;&gt;';
                $config['prev_link'] = '&lt;&lt;';


                $data['confirm_user'] = $this->user_model->GetAllconfirm_user($config['per_page'], $this->uri->segment(3));
                $this->pagination->initialize($config);
				
				
                $this->load->view('admin/user_view', $data);
            }
		} else {
            redirect('webadmin/login');
        }
    } 
	
	
	 function buyers($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->buyer_model->delete_buyer($id);
            } elseif ($method == 'add') {
                $this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|max_length(100)|xss_clean');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				if ($this->form_validation->run() == false) {
                    $this->load->view('admin/add_buyer_view');
                } else {
                    $fname = $this->input->post('fname');
					$lname = $this->input->post('lname');
                    $password = $this->input->post("password");
                    $repassword = $this->input->post('repassword');
                    $email = $this->input->post('email');
                    if ($password == $repassword) {
                        if (!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email))) {
                            
                        } else {
                            $this->buyer_model->add_buyer($fname,$lname, md5($password), $email);
                        }
                    } else {
                        
                    }
                    redirect('webadmin/buyers');
                }
            } elseif ($method == 'edit') {
                if ($id && $this->buyer_model->GetbuyerByID($id)) {
                    
                       $this->form_validation->set_rules('membership', 'Membership', 'required');
               
                    if ($this->form_validation->run() == false) {
                         $data['this_buyer'] = $this->buyer_model->GetbuyerByID($id);
                    $this->load->view('admin/edit_buyer_view', $data);
                    } else {
                        $membership = $this->input->post('membership');
                        $password = $this->input->post("password");
                        $repassword = $this->input->post('repassword');
                        $email = $this->input->post('email');
                        
                           
                        $this->buyer_model->edit_authority($id,$membership);
                            
                        
                        redirect('webadmin/buyers');
                    }
                } else {
                    redirect("webadmin/buyers");
                }
            } elseif ($method == 'block') {
			
				$authority = '0';
                
				$this->buyer_model->edit_authority($id,$authority);
                
				
                redirect('webadmin/buyers');
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
				  if(!$checks){
				 } else {
               
                foreach ($checks as $check) {
                    $this->buyer_model->delete_buyer($check);
                }}
                redirect('webadmin/buyers');
            } else {
			
			    
                $config['base_url'] = base_url() . 'webadmin/buyers/';
                $config['total_rows'] = $this->buyer_model->count_buyer();
                $config['per_page'] = '10';
                $config['uri_segment'] = '3';
                $config['num_links'] = '8';
                $config['full_tag_open'] = '<div ">';
                $config['full_tag_close'] = '</div>';


                $config['next_link'] = '&gt;&gt;';
                $config['prev_link'] = '&lt;&lt;';


                $data['buyers'] = $this->buyer_model->GetAllbuyers($config['per_page'], $this->uri->segment(3));
                $this->pagination->initialize($config);
				
				
                $this->load->view('admin/buyer_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function offer($method = '', $id = '',$upload = '') {
        if ($this->session->userdata('logged_in')) {
		 
            if ($method == 'delete') {
                $this->user_model->delete_ad($id);
            } elseif ($method == 'edit') {
                if ($id && $this->user_model->GetAdByID($id)) {
                    $data['this_ad'] = $this->user_model->GetAdByID($id);
					if(!empty($upload)){
					$data["upload"]= "يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  300 KB ";
					
					 $this->load->view('admin/edit_offer_view', $data);
					}else {
                    $this->form_validation->set_rules('ad_name', 'offer', 'trim|required|max_length(100)|xss_clean');
                    $this->form_validation->set_rules('content', 'Details', 'trim|required');
                    $this->form_validation->set_rules('ad_from', 'Start Date', 'trim|required|max_length(100)|xss_clean');
                    $this->form_validation->set_rules('ad_to', 'Expired Date', 'trim|required|max_length(100)|xss_clean');
                    
                    
					if ($this->form_validation->run() == false) {
                        $this->load->view('admin/edit_offer_view', $data);
                    } else {
					
                        $ad_name = $this->input->post("ad_name");
                        $ad_url ='1'/*$this->input->post("ad_url")*//*;
						$content =  strip_tags($this->input->post("content"));
						
						$ad_from =  $this->input->post("ad_from");
					    $ad_from_time =strtotime($ad_from);
						$ad_to =  $this->input->post("ad_to");
					    $ad_to_time =strtotime($ad_to);
						
						
						if (!empty($ad_to)) {
						 
						}else{
						$ad_to=$data['this_ad'][0]->ad_to;
						$ad_to_time=$data['this_ad'][0]->ad_to_time;
						} 
						
						
						if (!empty($_FILES['ad_image']['name'])) {
                        $config['upload_path'] = 'upload/';
                        $path = 'upload/' . $config['file_name'] = time() . '.jpg';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size'] = '2048';
                        $config['max_width'] = '2048';
                        $config['max_height'] = '1536';
                        $this->upload->initialize($config);
                         if(!$this->upload->do_upload('ad_image')){
						
						$upload= "p";
						redirect('webadmin/offer/edit/'.$id.'/'.$upload);
						 
						 }
						
                        //resize image----------------------------------------------
						$data['image_library'] = 'GD2';
						$data['source_image'] = './' . $path;
						$data['maintain_ratio'] = FALSE;
						$data['width'] = '546';
						$data['height'] = '285';
						$this->image_lib->initialize($data);
						$this->image_lib->resize();
                        // -------------------------------------------------
						}else{
                        $data['this_ad'] = $this->user_model->GetAdByID($id);
                        $path = $data['this_ad'][0]->ad_image ;
						
						
						
						}
						
						
						$date=time();
						if($ad_from_time<= $date){
						$statue = '1';
						if($ad_to_time<= $date){
						$statue = '0';
						}else{$statue = '1';}
						}else{$statue = '0';
					   }
					
                        $this->user_model->edit_ad($id, $ad_name, $ad_url,$content, $path,$ad_from ,$ad_from_time,$ad_to,$ad_to_time,$statue);
						
						
                        redirect('webadmin/offer');
                    }}
                } else {
                    redirect('webadmin/offer');
                }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->user_model->delete_ad($check);
                }
                redirect('webadmin/offer');
            } else {
			
			    
					$config['base_url'] = base_url().'webadmin/offer/';
					$config['total_rows'] =  $this->user_model->count_offer_admin();
					$config['per_page'] = '10';
					$config['uri_segment'] = '3';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';

    
				$data['ads'] = $this->user_model->GetAlloffer_admin($config['per_page'],$this->uri->segment(3));
				$this->pagination->initialize($config);
                
                $this->load->view('admin/offer_view', $data);
            }
       
		} else {
            redirect('webadmin/login');
        }
    }
    */
	
	function pages($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->pages_model->delete_page($id);
            } elseif ($method == 'add') {
			
                $this->form_validation->set_rules('page_title', 'Title', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('page_content', 'Content', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $this->load->view('admin/pages/add_page_view');
                } else {
                    $title = $this->input->post('page_title');
                    $content = $this->input->post("page_content");
						if (!empty($_FILES['image']['name'])) {
							$date_image = time();
							$upload_path = 'upload/page/';
							$path = $upload_path. $date_image. '.jpg';
							$this->upload->initialize($this->set_upload_options($upload_path,$date_image));   
							if(!$this->upload->do_upload('image')){
							
							$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
							redirect('webadmin/pages/add');
							 
							}
						   //resize image----------------------------------------------
							$width = '444';
							$height = '380';
							$this->resize_image($path,$width,$height);
							//making thumb -------------------------------------
							$width = '100';
							$height = '100';
							$this->making_thumb($path,$width,$height);
							$thumb = $upload_path . $date_image. '_thumb.jpg';
							// -------------------------------------------------
						}else{
						
						
                        $path = '' ;
						$thumb = '' ;
						
						
                    }
                    $this->pages_model->add_page($title, $content,$path,$thumb);
					set_msg('تمت الاضافة بنجاح','');
                    redirect('webadmin/pages');
                }
            } elseif ($method == 'edit') {
                if ($id && $this->pages_model->GetpageByID($id)) {
				$data['this_page'] = $this->pages_model->GetpageByID($id);
				
                    $this->form_validation->set_rules('page_title', 'Title', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('page_content', 'Content', 'trim|required');
               
                    if ($this->form_validation->run() == false) {
                        $data['this_page'] = $this->pages_model->GetpageByID($id);
                        $this->load->view('admin/pages/edit_page_view', $data);
                    } else {
                        $title = $this->input->post('page_title');
                        $content = $this->input->post("page_content");
							
						if (!empty($_FILES['image']['name'])) {
							$date_image = time();
							$upload_path = 'upload/page/';
							$path = $upload_path. $date_image. '.jpg';
							$this->upload->initialize($this->set_upload_options($upload_path,$date_image)); 
                        
						if(!$this->upload->do_upload('image')){
						
						$this->session->set_flashdata('login_error','يجب مراعاة  ان الحجم الصورة التي تقوم برفعها لا تزيد عن  1000 KB');
						redirect('webadmin/pages/edit/'.$id);
						 
						 }
					   //resize image----------------------------------------------
						$width = '444';
						$height = '380';
						$this->resize_image($path,$width,$height);
						//making thumb -------------------------------------
						$width = '100';
						$height = '100';
						$this->making_thumb($path,$width,$height);
				     	$thumb = $upload_path . $date_image. '_thumb.jpg';
					    // -------------------------------------------------
                        
						}else{
						$data['path'] = $this->pages_model->GetpageByID($id);
						
                        $path = $data['path'][0]->path ;
                        $thumb = $data['path'][0]->thumb ;

						
                    }
                        $this->pages_model->edit_page($id, $title, $content,$path,$thumb);
						set_msg('تم التعديل بنجاح','');
                        redirect('webadmin/pages');
                    }
                } else {
                    redirect('webadmin/pages');
                }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->pages_model->delete_page($check);
                }
				redirect('webadmin/pages');
               //redirect($this->agent->referrer());
            } else {
			    $base_url = base_url() . 'webadmin/pages/';
                $total_rows = $this->pages_model->count_pages();
                $per_page = '10';
                $uri_segment= '3';
          
                $data['pages'] = $this->pages_model->GetAllPages($per_page, $this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
                
				$this->load->view("admin/pages/pages_view", $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	

    function admins($method = '', $id = '') {
        if ($this->session->userdata('logged_in')) {
            if ($method == 'delete') {
                $this->admin_model->delete_admin($id);
            } elseif ($method == 'add') {
		
                $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]|xss_clean');
                $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|max_length[100])|xss_clean');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

                if ($this->form_validation->run() == false) {
                    $this->load->view('admin/admins/add_admin_view');
                } else {
                    $username = $this->input->post('username');
                    $password = $this->input->post("password");
                    $repassword = $this->input->post('repassword');
                    $email = $this->input->post('email');
                    if ($password == $repassword) {
                        $result=$this->admin_model->add_admin($username, md5($password), $email);
                        if ($result == FALSE) {
							$this->session->set_flashdata('login_error','عفوا البريد الالكتروني مسجل من قبل..');
							redirect('webadmin/admins/add');
                        }else{set_msg('تمت الاضافة بنجاح','');}	
                    } else {
                        $this->session->set_flashdata('login_error','عفوا كلمة المرور غير مطابقة');
						redirect('webadmin/admins/add');
                    }
                    redirect('webadmin/admins');
                }
            } elseif ($method == 'edit') {
                if ($id && $this->admin_model->GetadminByID($id)) {
                    
                    $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]|xss_clean');
                    $this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

               
                    if ($this->form_validation->run() == false) {
                         $data['this_admin'] = $this->admin_model->GetadminByID($id);
                    $this->load->view('admin/admins/edit_admin_view', $data);
                    } else {
                        $username = $this->input->post('username');
                        $password = $this->input->post("password");
                        $repassword = $this->input->post('repassword');
                        $email = $this->input->post('email');
						if ($password == $repassword) {
							$result= $this->admin_model->edit_admin($id,$username, md5($password), $email);

							if ($result == FALSE) {
								$this->session->set_flashdata('login_error','عفوا البريد الالكتروني مسجل من قبل..');
								redirect('webadmin/admins/edit/'.$id);
							}else{set_msg('تم التعديل بنجاح','');}		
						} else {
							$this->session->set_flashdata('login_error','عفوا كلمة المرور غير مطابقة');
							redirect('webadmin/admins/edit/'.$id);
						}
                        redirect('webadmin/admins');
                    }
                } else {
                    redirect("webadmin/admins");
                }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->admin_model->delete_admin($check);
                }
                redirect('webadmin/admins');
				//redirect($this->agent->referrer());
            } else {
			    $base_url = base_url() . 'webadmin/admins/';
                $total_rows = $this->admin_model->count_admins();
                $per_page = '10';
                $uri_segment= '3';
          
                $data['admins'] = $this->admin_model->GetAlladmins($per_page, $this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
                $this->load->view('admin/admins/admins_view', $data);
            }
        } else {
            redirect('webadmin/login');
        }
    }
	
	function set_upload_options($upload_path,$date_image){   
		$config = array();
		$config['upload_path'] = $upload_path;
        $config['file_name'] = $date_image. '.jpg';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '2048';
        $config['max_height'] = '1536';
		return $config;
	}
	
	function resize_image($path,$width,$height){   
		$data['image_library'] = 'GD2';
		$data['source_image'] = './' . $path;
		$data['maintain_ratio'] = FALSE;
		$data['width'] = $width;
		$data['height'] = $height;
		$this->image_lib->initialize($data);
		$this->image_lib->resize();
	}
	
	function making_thumb($path,$width,$height){   
		$image_data['image_library'] = 'GD2';
		$image_data['source_image'] = './' . $path;
		$image_data['create_thumb'] = TRUE;
		$image_data['thumb_marker'] = '_thumb';
		$image_data['width'] = $width;
		$image_data['height'] = $height;
		$this->image_lib->initialize($image_data);
		$this->image_lib->resize();
	}
	
		
	function set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment){   
		$config = array();
			$config['base_url'] = $base_url;
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = $uri_segment;
            $config['num_links'] = '8';
			$config['next_link']        = '&raquo;';
			$config['prev_link']        = '&laquo;';
            $config['full_tag_open']    = '<div class="text-center"><nav><ul class="pagination justify-content-center p-0">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tag_close']  = '</span></li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tag_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tag_close']  = '</span></li>';

		return $config;
	}		
    



   


	
	
   
}


     

    
    

?>