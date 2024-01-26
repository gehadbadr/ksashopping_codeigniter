<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function home() {
        parent::__construct();
        
        $this->load->model('cats_model');
		$this->load->model('payment_model');
		$this->load->model('pages_model');
		$this->load->model('contact_model');
        $this->load->model('products_model');
        $this->load->model('admin_model');
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

    public function index() {
		$this->check_slider_expire();

        // sending data to view
		$data['home_link'] = TRUE;
		$data["date"]= time();
		
	 	$data["sliders"] = $this->admin_model->GetAllActiveSliders();
        $data["video"] = $this->admin_model->GetRandomVideos();
       // $data["cats"] = $this->cats_model->GetAllCats();
		$base_url = base_url() . '	home/index/';
		$total_rows = $this->cats_model->count_cat();
		$per_page = '3';
		$uri_segment= '3';

		$data['cats'] = $this->cats_model->GetAllCats($per_page,$this->uri->segment(3));
		$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
        // view
      
        // view
        $this->load->view('index_view', $data);
    }
	
    public function pages($id = '') {
        // sending data to view
		$data['pages_link'] = TRUE;

        if ($id && $this->pages_model->GetpageByID($id)) {
            $data["pages"] = $this->pages_model->GetpageByID($id);
			if ($data["pages"]) {
				$data['pages_link_id'] = $data["pages"][0]->page_id;
				$data['title'] = $data["pages"][0]->title.' - KSA SHopping';
            }else { 
			    $data['title']="KSA SHopping";
			} 
        } else {
			$data['title']="KSA SHopping";
        }
      
        //view
        $this->load->view("pages_view", $data);
    }
	
	
    function contact() {
        // sending data to view
		$data['contact_link'] = TRUE;
		$data['title']="Contact us - KSA SHopping";
        $data["details"] = $this->contact_model->GetcontactData();
            
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[50]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|max_length[2000]|xss_clean');
      
        if ($this->form_validation->run() == FALSE){ 
             $this->load->view('contact_view' , $data);
        }else{
   
			$name = strip_tags($this->input->post("name"));
			$mobile = strip_tags($this->input->post("mobile"));
			$email = $this->input->post("email");
			$title = strip_tags($this->input->post("title"));
			$message = strip_tags($this->input->post("message"));
			$submit = $this->input->post("submit");
		  
			$data['response'] = $this->contact_model->insert_message($name, $mobile, $email, $title, $message);
			//view
			
        
            $headers = 'From: '.$name.'<'.$email.'>' . "\n";
				$headers .= 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
                //$message .= ' ' . $email;
                $msg = '<table>
                <tr>
                <td>الاسم:</td><td>'.$name.'</td>
                </tr>
                <tr>
                <td>الايميل:</td><td>'.$email.'</td>
                </tr>
                <tr>
                <td>الرساله:</td><td>'.$message.'</td>
                </tr>

                </table>';
                if(mail('info@ksashopping.com', $title, $msg , $headers)) {
				    $data['msg'] = 'لقد تم ارسال رسالتك بنجاح ...';
					$this->load->view('contact_view' , $data);
                }else{
                    $data['msg'] = 'لم يتم ارسال الرساله ...';
                    $this->load->view('contact_view',$data);
                }

        }
    }

    function newsletter() {
        // sending data to view
		$data['contact_link'] = TRUE;
		$data['title']="Contact us - KSA SHopping";
		$data["details"] = $this->contact_model->GetcontactData();

        
         $this->load->library('form_validation');

        
        $this->form_validation->set_rules('name_news', 'Name', 'required');
        $this->form_validation->set_rules('email_news', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE){ 
			$this->load->view('contact_view' , $data);
        }else{
        
        $name = strip_tags($this->input->post("name_news"));
        $email = $this->input->post("email_news");
        $submit = $this->input->post("submit");

        $data['response'] = $this->contact_model->insert_email_newsletter($name, $email);
        //view
        
		if ($data['response']== 'FALSE') {
			$data['msg_news_false'] = 'عفوا هذا البريد الالكتروني مسجل من قبل .....';
			$this->load->view('contact_view' , $data);
        }else{
        
        
			$headers = 'From: '.$name.'<'.$email.'>' . "\n";
				$headers .= 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
                $msg = '<table>
                <tr>
                <td>الاسم:</td><td>'.$name.'</td>
                </tr>
                <tr>
                <td>الايميل:</td><td>'.$email.'</td>
                </tr>
                <tr>
                </tr>

                </table>';
                if (mail('info@ksashopping.com', 'newsletter', $msg , $headers)) {
                    
                      
                $data['msg_news'] = 'لقد تم ارسال رسالتك بنجاح ...';
                $this->load->view('contact_view' , $data);
                }else{
                   
                    $data['msg_news'] = 'لم يتم ارسال الرساله ...';
                    $this->load->view('contact_view',$data);
                }

                
		}   
    }
}

	function paypal() {
			// sending data to view
			$data['contact_link'] = TRUE;
			$data['title'] = "Paypal - KSA SHopping";
			
			$data["products"] = $this->products_model->GetAllProducts();
			$data["cats"] = $this->cats_model->GetAllCats();
			
			//view
			$this->load->view('paypal_view', $data);
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