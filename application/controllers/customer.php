<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

    function Customer() {
        parent::__construct();
        	
		$this->load->model('pages_model');
        $this->load->model('customers_model');
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
	  $this->load->view('my_404_page');
	}

	function index() {
        $this->login();
    }
	
	function login() {
        if ($this->session->userdata('customer_logged')) {
            redirect('customer/profile');
        } else {
			$data['home_link'] = TRUE;
			$data['title'] = "تسجيل دخول - KSA SHopping";
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[50]|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('customer/login_view', $data);
            } else {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $customer_id = $this->customers_model->check_login($email, $password);

                if (!$customer_id) {
                    $this->session->set_flashdata('login_error','هناك خطأ في اسم الدخول او كلمة المرور');
                   redirect('customer/login');
                } else {
                    $login_data = array('customer_logged' => TRUE, 'customer_id' => $customer_id);
                    $this->session->set_userdata($login_data);
					
					if($this->input->post('remember')) {
						//$nume =$this->_config['sess_expiration'];-----cookie try-----
						$customer_cookie= array(
							  'name'   => 'customer_cookie',
							  'value'  => 'customer_cookie2',
							   'expire' => time()+60*60*60*24*30,
                        );
						
						$this->input->set_cookie($customer_cookie);
						$this->input->cookie('customer_cookie',true);
						set_msg('cookie','');
					   redirect('customer/login');
					}
				set_msg('مرحبا بك','');
                redirect('customer/profile');
						
                }
            }
        }
    }

    function logout() { 
		$customer_cookie= array(
							  'name'   => 'customer_cookie',
							  'value'  => '',
							  'expire' => '0',);
		$this->input->set_cookie($customer_cookie);
        $this->session->sess_destroy();
        redirect('home');
    }	
	 
	 function forget() {
		$data['home_link'] = TRUE;
		$data['title'] = "استعادة كلمة السر - KSA SHopping";
    	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
				$this->load->view('customer/forget_view', $data);
        } else {
            $email = $this->input->post("email");
            $forget = $this->customers_model->check_email($email);
			if ($forget) {
			
				$pass=random_string("alnum",15);
				$newpassword=md5($pass);

				if($this->customers_model->update_customer_password($forget[0]->customer_id,$newpassword)){	
						$to = $email;
						$subject = "Forget password.";
						$headers = "From: Info@ksashopping.com";
						$body = '<table height="211" border="0" align="right" dir="rtl" style="background:#FFF;border:none;">
							   <tr><td colspan="2">'.$forget[0]->fname.'&nbsp;'.$forget[0]->lname.'</td></tr>
							   <tr><td colspan="2">حسب طلبك, تم استعادة كلمة المرور الخاصة بك. بياناتك الجديدة موجودة أدناه:</td></tr>
							   <tr><td>إسم العضو:</td><td>'.$forget[0]->fname.'</td></tr>
							   <tr> <td>كلمة المرور الجديدة:</td><td>'.$pass.'</td></tr>
							</table>';           

					if (mail($to, $subject, $body, $headers)) {
						
							$this->session->set_flashdata('login_error','لقد تم ارسال كلمة المرور بنجاح ..برجاء التحقق من البريدالالكتروني الخاص بك واعادة الدخول برقم المرور الجديد ');
							redirect('customer/login');
						
					}else {
							$this->session->set_flashdata('login_error','عفوا لم يتم ارسال كلمة المرور بنجاح');
							redirect('customer/forget');
						 
					}
				} else {
						$this->session->set_flashdata('login_error','....عفوا هذا الايميل غير مسجل');
							redirect('customer/forget');
					}
			}else {
					$this->session->set_flashdata('login_error','.....عفوا هذا الايميل غير مسجل');
						redirect('customer/forget');
			}
		}
    }

	
	function register() {
	    $data['home_link'] = TRUE;
		$data['title'] = "تسجيل - KSA SHopping";
		$this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]|xss_clean');
		$this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|max_length[100])|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			// view
			$this->load->view('customer/register_view', $data);
		} else {
			$fname = strip_tags($this->input->post('fname'));
			$lname = strip_tags($this->input->post('lname'));
			$password = $this->input->post("password");
			$repassword = $this->input->post('repassword');
			$email = $this->input->post('email');
				if ($password == $repassword) {
					$customer_id = $this->customers_model->add_customer($fname,$lname, md5($password), $email);
					if ($customer_id == FALSE) {
						$this->session->set_flashdata('login_error','عفوا البريد الالكتروني مسجل من قبل..');
						redirect('customer/register');
					}else{
						$login_data = array('customer_logged' => TRUE, 'customer_id' => $customer_id);
						$this->session->set_userdata($login_data);
					
						//$nume =$this->_config['sess_expiration'];-----cookie try-----
						$customer_cookie= array(
							  'name'   => 'customer_cookie',
							  'value'  => 'customer_cookie2',
							  'expire' => time()+60*60*60*24*30,
						);
						
						$this->input->set_cookie($customer_cookie);
						$this->input->cookie('customer_cookie',true);
						set_msg('cookie','');
						redirect('customer/login');
						set_msg('تمت الاضافة بنجاح','');
					}	
				} else {
					$this->session->set_flashdata('login_error','عفوا كلمة المرور غير مطابقة');
					redirect('customer/register');
                }
				redirect('customer/register');
        }
		
	}
	
	function profile() {
		$data["home_link"] = TRUE;
        if ($this->session->userdata('customer_logged')) {
			$data["account_link"] = TRUE;
            $this->load->view('customer/profile_view', $data);
        } else {
            redirect('customer/login');
        }
    }
	
	function edit() {
		$data["home_link"] = TRUE;
        if ($this->session->userdata('customer_logged')) {
				$id=$this->session->userdata('customer_id');

				$this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|max_length[100]|xss_clean');
				$this->form_validation->set_rules('gender', 'Gender', 'trim|max_length[100]|xss_clean');
				$this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|max_length[100]|xss_clean');

                    if ($this->form_validation->run() == false) {
					$data["edit_link"] = TRUE;
                    $this->load->view('customer/edit_customer_view', $data);
                    } else {
							$fname = strip_tags($this->input->post('fname'));
							$lname = strip_tags($this->input->post('lname'));
							$mobile = strip_tags($this->input->post('mobile'));
							$gender = strip_tags($this->input->post('gender'));
							$dob =  $this->input->post("dob");
							$dob_time =strtotime($dob);
							if($dob != 0000-00-00){
								if(empty($dob_time)|| $dob_time == false){
									$this->session->set_flashdata('login_error','برجاء مراعاة ادخال التاريخ كالاتي yyyy-mm-dd');
									redirect('customer/edit');
								}
							}
							$result= $this->customers_model->edit_customer($id,$fname,$lname,$mobile,$gender,$dob);
							set_msg('تم التعديل بنجاح','');		
				
                        redirect('customer/profile');
                    }
        } else {
            redirect('customer/login');
        }
    }
	
	function address($method = '', $id = '') {
        $data["home_link"] = TRUE;
        if ($this->session->userdata('customer_logged')) {
			$customer_id=$this->session->userdata('customer_id');
            if ($method == 'delete') {
                $this->customers_model->delete_address($id);
            } elseif ($method == 'add') {
                
                $this->form_validation->set_rules('governorate', 'Governorate', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('building', 'The building', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('floor', 'Floor', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('flat', 'Flat', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('telephone', 'Telephone line', 'trim|numeric|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[5000000]|xss_clean');

                if ($this->form_validation->run() == false) {
					$data["address_link"] = TRUE;
                    $this->load->view('customer/add_address_view', $data);
				} else {
					$governorate = strip_tags($this->input->post('governorate'));
					$city = strip_tags($this->input->post('city'));
					$region = strip_tags($this->input->post('region'));
					$street = strip_tags($this->input->post('street'));
					$building = strip_tags($this->input->post('building'));
					$floor = strip_tags($this->input->post('floor'));
					$flat = strip_tags($this->input->post('flat'));
					$mobile = strip_tags($this->input->post('mobile'));
					$telephone = strip_tags($this->input->post('telephone'));
					$type = strip_tags($this->input->post('type'));
					$notes = strip_tags($this->input->post('notes'));
						
					$result= $this->customers_model->add_customer_address($customer_id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes);
					set_msg('تمت الاضافة بنجاح','');	

                    redirect('customer/address');
                }
            } elseif ($method == 'edit') {
             if ($id && $this->customers_model->GetaddressByID($id) && $this->customers_model->GetaddressByCustomerID($id,$customer_id)) {
					$data['this_address'] = $this->customers_model->GetaddressByID($id);
					
					$this->form_validation->set_rules('governorate', 'Governorate', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('building', 'The building', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('floor', 'Floor', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('flat', 'Flat', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('telephone', 'Telephone line', 'trim|numeric|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[5000000]|xss_clean');

                    if ($this->form_validation->run() == false) {
						$data["address_link"] = TRUE;
						$data['this_address'] = $this->customers_model->GetaddressByID($id);
						$this->load->view('customer/edit_address_view', $data);
                    } else {
						$governorate = strip_tags($this->input->post('governorate'));
						$city = strip_tags($this->input->post('city'));
						$region = strip_tags($this->input->post('region'));
						$street = strip_tags($this->input->post('street'));
						$building = strip_tags($this->input->post('building'));
						$floor = strip_tags($this->input->post('floor'));
						$flat = strip_tags($this->input->post('flat'));
						$mobile = strip_tags($this->input->post('mobile'));
						$telephone = strip_tags($this->input->post('telephone'));
						$type = strip_tags($this->input->post('type'));
						$notes = strip_tags($this->input->post('notes'));
						 
						    $result= $this->customers_model->edit_customer_address($id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes);
							set_msg('تم التسجيل بنجاح','');		
				
                        redirect('customer/address');
                    }
                } else {
                    redirect("customer/profile");
                }
            }/* elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->pages_model->delete_page($check);
                }
				redirect('webadmin/pages');
               //redirect($this->agent->referrer());
            }*/ else {
				$data["address_link"] = TRUE;
			    $base_url = base_url() . 'customer/address/';
                $total_rows = $this->customers_model->count_addresses($customer_id);
                $per_page = '5';
                $uri_segment= '3';
          
				$data['addresses'] = $this->customers_model->GetAlladdresses($customer_id,$per_page, $this->uri->segment(3));
                $this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
                
				$this->load->view("customer/address_view", $data);
            }
        } else {
            redirect('customer/login');
        }
    }
	
	function address1($method = '', $id = '') {
        $data["home_link"] = TRUE;
        if ($this->session->userdata('customer_logged')) {
			$customer_id=$this->session->userdata('customer_id');
            if ($method == 'delete') {
                $this->customer_model->delete_address($id);
            } elseif ($method == 'add') {
		
                $this->form_validation->set_rules('governorate', 'Governorate', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('building', 'The building', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('floor', 'Floor', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('flat', 'Flat', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('telephone', 'Telephone line', 'trim|numeric|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[5000000]|xss_clean');

                if ($this->form_validation->run() == false) {
					$data["address_link"] = TRUE;
                    $this->load->view('customer/add_address_view', $data);
				} else {
					$governorate = strip_tags($this->input->post('governorate'));
					$city = strip_tags($this->input->post('city'));
					$region = strip_tags($this->input->post('region'));
					$street = strip_tags($this->input->post('street'));
					$building = strip_tags($this->input->post('building'));
					$floor = strip_tags($this->input->post('floor'));
					$flat = strip_tags($this->input->post('flat'));
					$mobile = strip_tags($this->input->post('mobile'));
					$telephone = strip_tags($this->input->post('telephone'));
					$type = strip_tags($this->input->post('type'));
					$notes = strip_tags($this->input->post('notes'));
						
					$result= $this->customers_model->add_customer_address($customer_id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes);
					set_msg('تمت الاضافة بنجاح','');	

                   
                    redirect('customer/profile');
                }
            } elseif ($method == 'edit') {
			    if ($id && $this->customers_model->GetaddressByID($id)) {
					$data['this_address'] = $this->customers_model->GetaddressByID($id);
					
					$this->form_validation->set_rules('governorate', 'Governorate', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('building', 'The building', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('floor', 'Floor', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('flat', 'Flat', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('telephone', 'Telephone line', 'trim|numeric|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[5000000]|xss_clean');

                    if ($this->form_validation->run() == false) {
						$data["address_link"] = TRUE;
						$data['this_address'] = $this->customers_model->GetaddressByID($id);
						$this->load->view('customer/edit_address_view', $data);
                    } else {
						$governorate = strip_tags($this->input->post('governorate'));
						$city = strip_tags($this->input->post('city'));
						$region = strip_tags($this->input->post('region'));
						$street = strip_tags($this->input->post('street'));
						$building = strip_tags($this->input->post('building'));
						$floor = strip_tags($this->input->post('floor'));
						$flat = strip_tags($this->input->post('flat'));
						$mobile = strip_tags($this->input->post('mobile'));
						$telephone = strip_tags($this->input->post('telephone'));
						$type = strip_tags($this->input->post('type'));
						$notes = strip_tags($this->input->post('notes'));
						 
						    $result= $this->customers_model->add_customer_address($customer_id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes);
							set_msg('تم التسجيل بنجاح','');		
				
                        redirect('customer/profile');
                    }
                } else {
                    redirect("customer/profile");
                }
            } elseif ($method == 'do_operation') {
                $checks = $this->input->post('chk');
                foreach ($checks as $check) {
                    $this->customers_model->delete_address($check);
                }
                redirect('customer/profile');
				//redirect($this->agent->referrer());
            } else {
			   $data["address_link"] = TRUE;
			    $data['addresses'] = $this->customers_model->GetAlladdresses();
				$this->load->view("customer/address_view", $data);
            }
        } else {
            redirect('customer/login');
        }
    }
	function address11($method = '', $id = '') {
		$data["home_link"] = TRUE;
        if ($this->session->userdata('customer_logged')) {
				$customer_id=$this->session->userdata('customer_id');
			if ($method == 'delete') {
                $this->customer_model->delete_address($id);
            }elseif ($method == 'add') {
				$this->form_validation->set_rules('governorate', 'Governorate', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('building', 'The building', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('floor', 'Floor', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('flat', 'Flat', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('telephone', 'Telephone line', 'trim|numeric|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[5000000]|xss_clean');

                    if ($this->form_validation->run() == false) {
					$data["address_link"] = TRUE;
                    $this->load->view('customer/add_address_view', $data);
                    } else {
							$governorate = strip_tags($this->input->post('governorate'));
							$city = strip_tags($this->input->post('city'));
							$region = strip_tags($this->input->post('region'));
							$street = strip_tags($this->input->post('street'));
							$building = strip_tags($this->input->post('building'));
							$floor = strip_tags($this->input->post('floor'));
							$flat = strip_tags($this->input->post('flat'));
							$mobile = strip_tags($this->input->post('mobile'));
							$telephone = strip_tags($this->input->post('telephone'));
							$type = strip_tags($this->input->post('type'));
							$notes = strip_tags($this->input->post('notes'));
						
							
							$result= $this->customers_model->add_customer_address($customer_id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes);
							set_msg('تم التسجيل بنجاح','');		
				
                        redirect('customer/profile');
                    }
			} elseif ($method == 'edit') {	
			    if ($id && $this->customers_model->GetaddressByID($id)) {
					$data['this_address'] = $this->customers_model->GetaddressByID($id);
				
					$this->form_validation->set_rules('governorate', 'Governorate', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('region', 'Region', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('street', 'Street', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('building', 'The building', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('floor', 'Floor', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('flat', 'Flat', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('mobile', 'Mobile', 'trim|numeric|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('telephone', 'Telephone line', 'trim|numeric|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('type', 'Type', 'trim|required|max_length[100]|xss_clean');
					$this->form_validation->set_rules('notes', 'Notes', 'trim|max_length[5000000]|xss_clean');

                    if ($this->form_validation->run() == false) {
					$data["address_link"] = TRUE;
					$data['this_address'] = $this->customers_model->GetaddressByID($id);
                    $this->load->view('customer/edit_address_view', $data);
                    } else {
							$governorate = strip_tags($this->input->post('governorate'));
							$city = strip_tags($this->input->post('city'));
							$region = strip_tags($this->input->post('region'));
							$street = strip_tags($this->input->post('street'));
							$building = strip_tags($this->input->post('building'));
							$floor = strip_tags($this->input->post('floor'));
							$flat = strip_tags($this->input->post('flat'));
							$mobile = strip_tags($this->input->post('mobile'));
							$telephone = strip_tags($this->input->post('telephone'));
							$type = strip_tags($this->input->post('type'));
							$notes = strip_tags($this->input->post('notes'));
						
							
							$result= $this->customers_model->edit_customer_address($id,$customer_id,$governorate,$city,$region,$street,$building,$floor,$flat,$mobile,$telephone,$type,$notes);
							set_msg('تم التعديل بنجاح','');		
				
                        redirect('customer/profile');
                    }
				} else {
					redirect('customer/address');
				}					
		    } else {
				$data["address_link"] = TRUE;
			    $data['addresses'] = $this->customers_model->GetAlladdresses();
				$this->load->view("customer/address_view", $data);
            }		
        } else {
            redirect('customer/login');
        }
    }
	
    function edit_password() {
		$data["home_link"] = TRUE;
        if ($this->session->userdata('customer_logged')) {
				$id=$this->session->userdata('customer_id');

				$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('repassword', 'Confirm Password', 'trim|required|max_length[100])|xss_clean');
				
                    if ($this->form_validation->run() == false) {
					$data["edit_link"] = TRUE;
                    $this->load->view('customer/edit_customer_pw_view', $data);
                    } else {
							$password = $this->input->post("password");
							$repassword = $this->input->post('repassword');
							

						if ($password == $repassword) {
							$result= $this->customers_model->edit_customer_pw($id,md5($password));
							set_msg('تم التعديل بنجاح','');		
						} else {
							$this->session->set_flashdata('login_error','عفوا كلمة المرور غير مطابقة');
							redirect('customer/edit_password');
						}
                        redirect('customer/profile');
                    }
        } else {
            redirect('customer/login');
        }
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
			$config['full_tag_open'] = '<div ">';
			$config['full_tag_close'] = '</div>';
					

		return $config;
	}  
}