<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pro extends CI_Controller {

    function pro() {
        parent::__construct();
        
        $this->load->model('cats_model');
		$this->load->model('pages_model');
        $this->load->model('products_model');
        $this->load->model('payment_model');
		$this->load->model('customers_model');
//      $this->load->model('admin_model');
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
        // sending data to view
		$data['cat_link'] = TRUE;
		$data['title'] = "Products - KSA SHopping";
		
		$base_url = base_url() . '	pro/index/';
		$total_rows = $this->cats_model->count_cat();
		$per_page = '3';
		$uri_segment= '3';

		$data['cats'] = $this->cats_model->GetAllCats($per_page,$this->uri->segment(3));
		$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
				
        // view
        $this->load->view('categories_view', $data);
    }
	
	public function pcat($id = '') {
        // sending data to view
		$data['cat_link'] = TRUE;
        $data["cats"] = $this->cats_model->GetAllCats();
        
        if ($id && $this->cats_model->ProductsOfCatigory($id)) {
            $data['products1'] = $this->cats_model->ProductsOfCatigory($id);
            $data['exact_cat'] = $this->cats_model->GetCatByID($id);
			$data['title'] = $data["exact_cat"][0]->name.' - KSA SHopping';
        
					$config['base_url'] = base_url().'pro/pcat/'.$id.'/';
					$config['total_rows'] =  $this->products_model->count_GetAllProductscat($id);
					$config['per_page'] = '10';
					$config['uri_segment'] = '4';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';
               
				$data['cat_id']=$id;
				$data['products'] = $this->products_model->GetAllProductscat($id,$config['per_page'],$this->uri->segment(4));
				$this->pagination->initialize($config);
				
		} else {
           $data['title'] = "Products - KSA SHopping"; 
        }
        //view
        $this->load->view('pcat_view', $data);
		
    }
	
	public function offers($id = '') {
	    $this->check_products_offer_expire();

        // sending data to view
		$data['offer_link'] = TRUE;
        $data["cats"] = $this->cats_model->GetAllCats();
        
        if ($id && $this->cats_model->GetCatByID($id)){
            $data['exact_cat'] = $this->cats_model->GetCatByID($id);
			$data['title'] = 'Offers of '.$data["exact_cat"][0]->name.' - KSA SHopping';
        
			$this->load->library('pagination');
					$config['base_url'] = base_url().'pro/offers/'.$id.'/';
					$config['total_rows'] =  $this->products_model->count_GetAllProductsOffers($id);
					$config['per_page'] = '2';
					$config['uri_segment'] = '4';
					$config['num_links'] = '8';
					$config['full_tag_open'] = '<div ">';
					$config['full_tag_close'] = '</div>';
					
					  
					$config['next_link'] = '&gt;&gt;'; 
					$config['prev_link'] = '&lt;&lt;';
               
				$data['cat_id']=$id;
				$data['products'] = $this->products_model->GetAllProductsOffers($id,$config['per_page'],$this->uri->segment(4));
				$this->pagination->initialize($config);
				$this->load->view('offers_by_cat_view', $data);

				
		} else {
           $data['title'] = "Offers - KSA SHopping"; 
		   $this->load->view('offers_view', $data);

        }
        //view
    }


	public function product_detail($id = ''){
		$this->check_products_offer_expire();
        // sending data to view
		$data['cat_link'] = TRUE;
        $data["products"] = $this->products_model->GetAllProducts();
        $data["cats"] = $this->cats_model->GetAllCats();

        if ($id && $this->products_model->GetProductByID($id)) {

            $data["product_detail"] = $this->products_model->GetProductByID($id);
			
			$data['title'] = $data["product_detail"][0]->name.' - KSA SHopping';
			$data['product_images'] = $this->products_model->GetProductImages($id);
            $data["product_main_img"] = $this->products_model->GetProductMainImage($id);
			$data["product_comment"] = $this->products_model->GetProductcomment($id);
			$data["product_video"] = $this->products_model->GetpvideoByproduct($id);
			$data["product_color"] = $this->products_model->GetpcolorByproduct($id);
			$data["product_size"] = $this->products_model->GetpsizeByproduct($id);
            $data["product_views"] = $this->products_model->GetProductViews($id);
            $data["product_cat"] = $this->cats_model->GetCatByID($data["product_detail"][0]->cat_id_fk);
			
			$sort = $data["product_detail"][0]->sort;
			$data['prev'] = $this->products_model->Getprev($sort,$data["product_detail"][0]->cat_id_fk);
			$data['next'] = $this->products_model->Getnext($sort,$data["product_detail"][0]->cat_id_fk);
         
        } else {
			$data['title']="Product - KSA SHopping";
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('comment', 'Comment','trim|required|max_length[50]|xss_clean');
        
      
        if ($this->form_validation->run() == FALSE){ 
			 
             $this->load->view('product_detail_view' , $data);
        }else{
            if ($id) {
				$name = strip_tags($this->input->post("name"));
				$comment =  strip_tags($this->input->post("comment"));
				//$name = $this->input->post("name");
				//$comment = $this->input->post("comment");
				$submit = $this->input->post("submit");
			  
				$data['response'] = $this->products_model->add_product_comment($id,$name, $comment);
				
				$data["product_comment"] = $this->products_model->GetProductcomment($id);
				$title= "المعلق ".$name;
				$headers =  'From: '.$name.'<info@ksatest.com>' . "\n";
					$headers .= 'MIME-Version: 1.0' . "\n";
					$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
					$msg = '<table>
						<tr>
						<td>?????:</td><td>'.$name.'</td>
						</tr>
						<tr>
						<td>???????:</td><td>'.$comment.'</td>
						</tr>
					
						</table>';
						
					if(mail('info@ksashopping.com', $title, $msg , $headers)) {
					    
						$data['msg'] = 'لقد تم ارسال التعليق بنجاح';
						$this->load->view('product_detail_view' , $data);
					}else{
						$data['msg'] = 'عفوا لم يتم ارسال التعليق بنجاح';
						$this->load->view('product_detail_view',$data);
					}
            }
        }
        //view
      
    }
	

	
	function payment_methods($id='1') {
	
	        // sending data to view
		$data['pay_link'] = TRUE;	
		$data['title'] = "Bank Details - KSA SHopping";
		
		$base_url = base_url() . 'pro/payment_methods/';
		$total_rows = $this->payment_model->count_payment();
		$per_page = '3';
		$uri_segment= '3';
				
			$data['payment'] = $this->payment_model->GetAllpayment($per_page,$this->uri->segment(3));
			$this->pagination->initialize($this->set_pagination_configs($base_url,$total_rows,$per_page,$uri_segment));
		
        $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|max_length[50]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]|xss_clean');
        $this->form_validation->set_rules('bank', 'Bank','trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('dname', 'Depost Name', 'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required|max_length[50]|xss_clean');
        $this->form_validation->set_rules('note', 'Note', 'trim|required|max_length[50]|xss_clean');
      
        if ($this->form_validation->run() == FALSE){ 
             $this->load->view('payment_methods' , $data);
        }else{
   
			$name = strip_tags($this->input->post("name"));
			$mobile = $this->input->post("mobile");
			$email = $this->input->post("email");
			$bank = strip_tags($this->input->post("bank"));
			$date = strip_tags($this->input->post("date"));
			$dname = strip_tags($this->input->post("dname"));
			$payment = strip_tags($this->input->post("payment"));
			$note = strip_tags($this->input->post("note"));
			$submit = strip_tags($this->input->post("submit"));
		  
			$data['response'] = $this->payment_model->insert_message_pay($name, $mobile, $email, $bank, $date, $dname, $payment, $note);
			
			
            $title= 'الراسل'.$name;
            $headers = 'From: '.$name.'<'.$email.'>' . '\n';
				$headers .= 'MIME-Version: 1.0' . '\n';
				$headers .= 'Content-type: text/html; charset=utf-8' .'\r\n'; 
                $msg = '<table>
					<tr>
					<td>???/td><td>'.$name.'</td>
					</tr>
					<tr>
					<td>???:</td><td>'.$email.'</td>
					</tr>
					<tr>
					<td>???:</td><td>'.$mobile.'</td>
					</tr>
					<tr>
					<td>???????:</td><td>'.$bank.'</td>
					</tr>
					<tr>
					<td>????</td><td>'.$date.'</td>
					</tr>
					<tr>
					<td>????:</td><td>'.$dname.'</td>
					</tr>
					<tr>
					<td>???</td><td>'.$payment.'</td>
					</tr>
					<tr>
					<td>????:</td><td>'.$note.'</td>
					</tr>
				
					</table>';
					
			    if(mail('info@ksashopping.com', $title, $msg , $headers)) {
				    $data['msg'] = 'لقد تم الارسال بنجاح';
					$this->load->view('payment_methods' , $data);
                }else{
                    $data['msg'] = 'عفوا لم يتم الارسال بنجاح....';
                    $this->load->view('payment_methods',$data);
                }

        }	
    }
	

    function submitRating(){    
            // This was sent by JS, which question was rated and how.
            $rating = (int)$_POST['rating'];
            $id = (int)$_POST['id'];
        
            // get from database this one question
            $records =  $this->products_model->GetProductByID($id);
                        
            foreach ($records as $product_row)
            {            
                if($rating > 5 || $rating < 1) 
                {
                        echo"Rating cant be more than 5 or less than 1";
                        break;
                }
                // If you have already voted
               
                
                // Set coockie, that you have voted
               // setcookie("rated".$id, $id, time()+60*60*24*365);
				
				//$rate = $product_row->rating; 
				$sum_of_votes = $product_row->sum_of_votes; 
				$number_of_voting = $product_row->number_of_voting; 
				
				$nov= $number_of_voting+1;
				$sum = $sum_of_votes + $rating; 
				$rating = $sum / $nov;
				//sum_of_votes/number_of_voting
            
                $this->products_model->updateRating($id,$nov,$sum);
               // echo 'done';
                
                //Show stars again, but this time, dont allow vote
                
                // get Product and its rating from db again
                $records  = $this->products_model->GetProductByID($id);
                foreach ($records as $product_row)
                {
                   // $rating = $product_row->rating;
                    $rating_round = round($rating,1);
					//$number_of_voting = $product_row->number_of_voting;
                }
                      ?>
			<script type="text/javascript">
$(document).ready(function() {

        $('[class^=star_]').mouseenter(
        function() {
            if($(this).parent().data('selected') == undefined) {
                var selectedStar = $(this).parent().find('.hover_star').length - 1;
                $(this).parent().data('selected', selectedStar)
            }
            $(this).children().addClass('hover_star');
            $(this).prevAll().children().addClass('hover_star');
            $(this).nextAll().children().removeClass('hover_star');
        });

    $('[id^=rating_]').mouseleave(
        function() {
            var selectedIndex = $(this).data('selected');
    
           /* if  (selectedIndex == -1)
            {*/
                $(this).children("[class^=star_]").children('img').removeClass("hover_star");
         /*   }
            
            var $selected = $(this).find('img').eq(selectedIndex).addClass('hover_star').parent();        
            $selected.prevAll().children().addClass('hover_star');
            $selected.nextAll().children().removeClass('hover_star');*/
    });


    $("[id^=rating_]").children("[class^=star_]").click(function(){
        var current_star = $(this).attr("class").split("_")[1];
        var rid = $(this).parent().attr("id").split("_")[1];

      $('#star_container_'+rid).load('<?php echo base_url() ?>pro/submitRating', {rating: current_star, id: rid});
       
    });
});

</script> 
		        	<div>
						<div id="star_container_<?php echo $id ;?>" style="">
							<div id="rating_<?php echo $id; ?>" style="text-align:left;direction:ltr;">
								<span class="star_1 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 0) { echo"class='hover_star_rated'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_2 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 1.5) { echo"class='hover_star_rated'";  } ?> style="vertical-align: text-top;" /></span>
								<span class="star_3 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 2.5) { echo"class='hover_star_rated'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_4 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 3.5) { echo"class='hover_star_rated'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_5 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 4.5) { echo"class='hover_star_rated'"; } ?> style="vertical-align: text-top;" /></span>
					
							</div>		
							<div class="star1_rating" style="text-align:left;">
								<?php echo $rating_round." حسب ".$nov." تقييم "; ?>
							</div>
					    </div>
			   	    </div>
				
			
                  
				
				
				
				
				
				
				
			
			
			<?php

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