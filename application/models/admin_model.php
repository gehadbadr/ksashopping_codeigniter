<?php

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_login($username, $password) {
        $md5_password = md5($password);
        $query_str = "SELECT * FROM admins WHERE username = ? AND password = ?";
        $result = $this->db->query($query_str, array($username, $md5_password));
        if ($result->num_rows() == 1) {
            return $result->row(0)->admin_id;
        } else {
            return FALSE;
        }
    }
	
// start forgetpass 
	
	 function check_email($email) {
        $query = $this->db->get_where("admins", array("email" => $email));
        $res = $query->result();
        if ($res) {
            return $res;
        }else
            return FALSE;
    }
	
	function update_admin_password($id,$newpassword){
		$this->db->where('admin_id',$id);
		if($this->db->update('admins',array("password" => $newpassword)))
		{
			return TRUE;
		}else{

			return FALSE;
		}
	}

//end forgetpass	
	
	

// start slider 	
	
	function GetAllSliders($limit=0,$offset=0) {
	    $this->db->order_by("slider_id", "desc");
		if($limit!=0){
			$query = $this->db->get('sliders',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('sliders');
			$res = $query->result();
			return $res;
        }
	
    }
  
    
    function count_slider() { 
    return $this->db->count_all_results('sliders'); 
    }
	
    function GetAllActiveSliders() {
       $query = $this->db->get_where("sliders", array("statue" => '1'));
        $res = $query->result();
        return $res;
    }

    function GetsliderByID($id) {
       $query = $this->db->get_where("sliders", array("slider_id" => $id));
        $res = $query->result();
        return $res;
    }

    function edit_slider($id, $slider_name, $slider_url, $path, $thumb,$slider_expire,$statue) {
		$path_to_images = $this->db->get_where('sliders', array('slider_id' => $id), 1);
				foreach ($path_to_images->result() as $row ) {
					$old_path = $row->slider_image;
					$old_thumb = $row->thumb;
				
						if($path!= $old_path ){
							unlink($old_path);
							unlink($old_thumb);
						}
				}
        $this->db->where('slider_id', $id);
        $this->db->update("sliders", array('slider_name' => $slider_name, 'slider_url' => $slider_url, 'slider_image' => $path, 'thumb' => $thumb, 'slider_expire' => $slider_expire,'statue' => $statue));
        $this->db->query("update sliders set date_now = NOW() where slider_id = $id");
	}
	/*
	function update_slider_bydate($d1) {
        $this->db->query("update sliders set statue = 0 WHERE  datetime <= $d1  && datetime  <> '#'");
	}
	*/
	function update_statue_start_slider($id) {
        $this->db->query("update sliders set statue = 1 WHERE  slider_id = $id  ");
	}
	
	function update_statue_expire_slider($id) {
        $this->db->query("update sliders set statue = 0 WHERE  slider_id = $id  ");
	}

    function delete_slider($id) {
		$path_to_images = $this->db->get_where("sliders", array("slider_id" => $id));
        foreach ($path_to_images->result() as $row) {
					$image = $row->slider_image;
					$thumb = $row->thumb;
					unlink($image);
					unlink($thumb);
		}
        $this->db->delete("sliders", array("slider_id" => $id));
    }

    function add_slider($slider_name, $slider_url, $path,$thumb,$slider_expire,$statue) {
        $this->db->insert("sliders", array("slider_name" => $slider_name, "slider_url" => $slider_url, "slider_image" => $path,'thumb' => $thumb, 'slider_expire' => $slider_expire,'statue' => $statue));
         $query = $this->db->get("sliders");
        $slider_id = end($query->result());
        $this->db->query("update sliders set date_now = NOW() where slider_id = $slider_id->slider_id");
       
	}

//end slider	

// start ad 	
	
  
	 function GetAllAds($limit=0,$offset=0) {
	    $this->db->order_by("ad_id", "desc");
		if($limit!=0){
			$query = $this->db->get('ads',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('ads');
			$res = $query->result();
			return $res;
        }
	
    }
	
	
    
 function count_ads() { 
    return $this->db->count_all_results('ads'); 
    }
	
	function GetAllAdstosite($limit=0) {
	   if($limit!=0){
		    $query = $this->db->query("SELECT * FROM ads where ad_image <> '' && statue = 1 order by ad_id  desc LIMIT  $limit");
			$res = $query->result();
			return $res;
		}else{
		    $query = $this->db->query("SELECT * FROM ads where ad_image <> '' && statue = 1 order by ad_id  desc");
			$res = $query->result();
			return $res;
		}
    }

    function GetAdByID($id){
        $query = $this->db->get_where("ads", array("ad_id" => $id));
        $res = $query->result();
        return $res;
    }

    function edit_ad($id, $ad_name, $ad_url, $path,$thumb,$ad_start,$ad_expire,$statue){
		
		 $path_to_images = $this->db->get_where('ads', array('ad_id' => $id), 1);
				foreach ($path_to_images->result() as $row ) {
					$old_path = $row->ad_image;
					$old_thumb = $row->thumb;
				
						if($path!= $old_path ){
							unlink($old_path);
							unlink($old_thumb);
						}
				}
        $this->db->where('ad_id', $id);
        $this->db->update("ads", array('ad_name' => $ad_name, 'ad_url' => $ad_url, 'ad_image' => $path, 'thumb' => $thumb, 'ad_start' => $ad_start, 'ad_expire' => $ad_expire, 'statue' => $statue,'date' =>date("Y-m-d h:i:s")));
	}
	
	function update_statue_start_ad($id) {
        $this->db->query("update ads set statue = 1 WHERE  ad_id = $id  ");
	}
	
	function update_statue_expire_ad($id) {
        $this->db->query("update ads set statue = 0 WHERE  ad_id = $id  ");
	}
	
    function delete_ad($id) {
		$path_to_images = $this->db->get_where("ads", array("ad_id" => $id));
        foreach ($path_to_images->result() as $row) {
					$image = $row->ad_image;
					$thumb = $row->thumb;
					unlink($image);
					unlink($thumb);
		}
        $this->db->delete("ads", array("ad_id" => $id));
    }

    function add_ad($ad_name, $ad_url, $path,$thumb,$ad_start,$ad_expire,$statue) {
        $this->db->insert("ads", array("ad_name" => $ad_name, "ad_url" => $ad_url, "ad_image" => $path, 'thumb' => $thumb,'ad_start' => $ad_start, 'ad_expire' => $ad_expire,'statue' => $statue,'date' =>date("Y-m-d h:i:s")));

       
	}

//end ad
	
// start videos 
	function GetAllvideos($limit=0,$offset=0) {
	    $this->db->order_by("video_id", "desc");
		if($limit!=0){
			$query = $this->db->get('videos',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('videos');
			$res = $query->result();
			return $res;
        }
	
    } 
    

	function count_video() { 
		return $this->db->count_all_results('videos'); 
    }

    function GetvideoByID($id) {
        $query = $this->db->get_where("videos", array("video_id" => $id));
        $res = $query->result();
        return $res;
    }
	
	function GetRandomVideos() {
	     $query = $this->db->query("SELECT * FROM videos ORDER BY RAND() LIMIT 1  ");
        $res = $query->result();
        return $res;
    }

    function edit_video($id, $name, $url, $path) {
        $this->db->where('video_id', $id);
        $this->db->update("videos", array('name' => $name, 'url' => $url, 'image' => $path,"date"=>date("Y-m-d h:i:s")));
    }

    function delete_video($id) {
        $this->db->delete("videos", array("video_id" => $id));
    }

    function add_video($name, $url, $path) {
        $this->db->insert("videos", array("name" => $name, "url" => $url, "image" => $path,"date"=>date("Y-m-d h:i:s")));
		
    }
	
	
//end videos


// start face 
	function add_face($facebook, $twitter,$youtube) {
        $query = $this->db->get('face');
        $res = $query->result();
        if ($res) {
            $id = $res[0]->face_id;
            $this->db->update('face', array('facebook' => $facebook,'twitter' => $twitter,'youtube' => $youtube,"date"=>date("Y-m-d h:i:s")), array('face_id' => $id));
            $this->db->query("update face set date = NOW() where face_id = '$id'");
        } else {
            if ($this->db->insert('face', array('facebook' => $facebook,'twitter' => $twitter,'youtube' => $youtube,"date"=>date("Y-m-d h:i:s")))) {
               
            }
        }
    }
   

    function GetfaceData() {
        $query = $this->db->get('face');
        $res = $query->result();
        return $res;
    }	
//end face	
/*
// start country 
	 
    function add_country($name) {
        if (!$name) {
            
        } else {
            $this->db->insert('country', array('name' => $name), 1);
        }
    }
    
   
    function delete_country($id) {
	
	      $query = $this->db->get_where("users", array("country_id_fk" => $id));
	
		foreach ($query->result() as $row ) {
		   $row->user_id;
		   
		     	$this->db->where('user_id', $row->user_id);
				$this->db->update("users", array('country_id_fk' => '0'));   
				   
		
		}
		
		  $query1 = $this->db->get_where("buyers", array("country_id_fk" => $id));
	
		foreach ($query1->result() as $row ) {
		   $row->buyer_id;
		   
		     	$this->db->where('buyer_id', $row->buyer_id);
				$this->db->update("buyers", array('country_id_fk' => '0'));   
				   
		
		}
		
		  $query2 = $this->db->get_where("city", array("country_id_fk" => $id));
	
		foreach ($query2->result() as $row ) {
		   $row->city_id;
		   $this->admin_model->delete_city($row->city_id);
		
		}
        $this->db->query("delete from country where country_id = '$id'");
        
    }

    function edit_country($id, $name) {
        $this->db->where('country_id', $id);
        $this->db->update("country", array('name' => $name));
    }
	
	
	
	 function GetAllcountrys($limit=0,$offset=0) {
	    $this->db->order_by("country_id", "desc");
		if($limit!=0){
			$query = $this->db->get('country',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('country');
			$res = $query->result();
			return $res;
        }
	
    }
	
	
    
 function count_country() { 
    return $this->db->count_all_results('country'); 
    }
	
	
	
	
    function GetcountryByID($id) {
        $query = $this->db->get_where('country',array('country_id' => $id));
        $res = $query->result();
        return $res;
    }

//end country	

// start city 
	 
    function add_city($name,$country_id_fk) {
        if (!$name) {
            
        } else {
            $this->db->insert('city', array('name' => $name,'country_id_fk' => $country_id_fk), 1);
        }
    }
    
   
    function delete_city($id) {
	
	      $query = $this->db->get_where("users", array("city_id_fk" => $id));
	
		foreach ($query->result() as $row ) {
		   $row->user_id;
		   
		     	$this->db->where('user_id', $row->user_id);
				$this->db->update("users", array('city_id_fk' => '0'));
                
		
		}
		
		  $query2 = $this->db->get_where("buyers", array("city_id_fk" => $id));
	
		foreach ($query2->result() as $row ) {
		   $row->buyer_id;
		   
		     	$this->db->where('buyer_id', $row->buyer_id);
				$this->db->update("buyers", array('city_id_fk' => '0')); 				
				   
		
		}
        $this->db->query("delete from city where city_id = '$id'");
        
    }

    function edit_city($id, $name,$country_id_fk) {
        $this->db->where('city_id', $id);
        $this->db->update("city", array('name' => $name,'country_id_fk' => $country_id_fk));
    }
	
	 function GetAllcitys($limit=0,$offset=0) {
	    $this->db->order_by("city_id", "desc");
        if($limit!=0){
			$query = $this->db->get('city',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('city');
			$res = $query->result();
			return $res;
        }
    }
	

	
	
    
 function count_city() { 
    return $this->db->count_all_results('city'); 
    }
	
	
	
	
    function GetcityByID($id) {
        $query = $this->db->get_where('city',array('city_id' => $id));
        $res = $query->result();
        return $res;
    }

	function GetCityByCountry($id) {
        $query = $this->db->get_where('city',array('country_id_fk' => $id));
        $res = $query->result();
        return $res;
    } 
	
//end city
*/


	
// start admins 
  	function GetAllAdmins($limit=0,$offset=0) {
	    $this->db->order_by("admin_id", "desc");
		if($limit!=0){
			$query = $this->db->get('admins',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('admins');
			$res = $query->result();
			return $res;
        }
	}
	
	function count_admins() { 
		return $this->db->count_all_results('admins'); 
    }

  
	function add_admin($username, $password, $email) {
		if (!$this->check_email($email)) {
            $res =$this->db->insert("admins", array('username' => $username, 'password' => $password, 'email' => $email,"date"=>date("Y-m-d")));
		    return $res;
		} else {
            return FALSE;
        }
    }

    function delete_admin($id) {
        $this->db->delete("admins", array("admin_id" => $id));
    }

    function GetAdminByID($id) {
        $check = $this->db->get_where('admins', array('admin_id' => $id));
        if ($check->result()) {
            $query = $this->db->get_where('admins', array('admin_id' => $id));
            $res = $query->result();
            return $res;
        }else
            return false;

    }

    function edit_admin($id,$username, $password, $email) {
		$query = $this->db->get_where("admins", array("admin_id" => $id));
		$old_email =$query->row(0)->email;
        $data['this_admin'] = $this->check_email($email);
		$anthor_email = $data['this_admin'][0]->email;
		if($old_email == $anthor_email){
			$this->db->where('admin_id', $id);
		    $res = $this->db->update('admins', array('username' => $username, 'password' => $password, 'email' => $email,"date"=>date("Y-m-d")));
				return $res;
			
		}else{
			if (!$this->check_email($email)) {		
				    $this->db->where('admin_id', $id);
				$res =	$this->db->update('admins', array('username' => $username, 'password' => $password, 'email' => $email));
				return $res;
			} else {
				return FALSE;
			}
		}	
    }

  
  
 //end admins	
	
// start newsletter
	function GetALLNewsletter($limit=0,$offset=0) {
	    $this->db->order_by("newsletter_id", "desc");
		if($limit!=0){
			$query = $this->db->get('newsletter',$limit,$offset);
			$res = $query->result();
			return $res;

        }else{
			$query = $this->db->get('newsletter');
			$res = $query->result();
			return $res;
        }
	}	
	    
	function count_Newsletter() { 
		return $this->db->count_all_results('newsletter'); 
    }

   	function delete_newsletter($id) {
        $this->db->delete("newsletter", array("newsletter_id" => $id));
    }
	
   /* function export_newsletter2() {
         $table = 'newsletter';
        $file = 'export';
        $csv_output = '';

        $result = mysql_query("SHOW COLUMNS FROM " . $table . "");
        $i = 0;
        if (mysql_num_rows($result) > 0) {
            $csv_output .= 'email';
        }
        $csv_output .= "\n";

        $values = mysql_query("SELECT * FROM " . $table . "");
        while ($rowr = mysql_fetch_row($values)) {

		    $csv_output .= $rowr[0] . "\t ";
            $csv_output .= $rowr[1] . "\t";
            $csv_output .= $rowr[2] . "\t";
			$csv_output .= $rowr[3] . "\t";
            $csv_output .= "\n";
        }

        $filename = $file . "_" . date("Y-m-d_H-i", time());
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: csv" . date("Y-m-d") . ".csv");
        header("Content-disposition: filename=" . $filename . ".csv");
        print $csv_output;
        exit;
    }*/
	
	function export_newsletter() {
        $file = 'export';
        $csv_output = '';
        $tab = "\t";
		
		$result = $this->db->query("SHOW COLUMNS FROM newsletter");

		foreach($result->result() as $columns){
                $csv_output .= $columns->Field . $tab;
               
            }
       // }
        $csv_output .= "\n";
            
		$values =  $this->db->query("SELECT * FROM newsletter");

		foreach ($values->result() as $row ) {
     
                $csv_output .= $row->newsletter_id . $tab;
                $csv_output .= $row->email . $tab;
                $csv_output .= $row->name . $tab;
                $csv_output .= $row->date . $tab;
   
            $csv_output .= "\n";
        }

        $filename = $file . "_" . date("Y-m-d_H-i", time());
        
		header("Content-type: application/octet-stream"); 
		header("Content-Disposition: attachment; filename=" . $filename . ".xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
        echo $csv_output;
        exit;
    }
	
	

  //  function bb2html($text , $usertags = ""){
	
	function bb2html($tmpText){
	/*[b]*/ 	$tmpText = preg_replace('#\[b\](.*)\[/b\]#isU', '<strong>$1</strong>', $tmpText);
	/*[i]*/	 	$tmpText = preg_replace('#\[i\](.*)\[/i\]#isU', '<em>$1</em>', $tmpText);
	/*[s]*/	 	$tmpText = preg_replace('#\[s\](.*)\[/s\]#isU', '<del>$1</del>', $tmpText);
	/*[br]*/	$tmpText = preg_replace('#\[br\]#isU', '<br />', $tmpText);
	/*[u]*/	 	$tmpText = preg_replace('#\[u\](.*)\[/u\]#isU', '<span style="text-decoration:underline">$1</span>', $tmpText);
	/*[color]*/ $tmpText = preg_replace('#\[color=(.*)\](.*)\[\/color\]#isU', '<span style="color:$1;">$2</span>', $tmpText);
	/*[size]*/ 	$tmpText = preg_replace('#\[size=([0-9]{1,2})\](.*)\[\/size\]#isU', '<span style="font-size:$1px;">$2</span>', $tmpText);
	/*[font]*/ 	$tmpText = preg_replace('#\[font=(.*)\](.*)\[\/font\]#isU', '<span style="font-family:$1;">$2</span>', $tmpText);
	/*[url=]*/	$tmpText = preg_replace('#\[url=(.*)\](.*)\[\/url\]#isU', '<a href="$1" target="">$2</a>', $tmpText);
	/*[url]*/	$tmpText = preg_replace('#\[url\](.*)\[\/url\]#isU', '<a href="$1" target="">$1</a>', $tmpText);
	/*[img]*/	$tmpText = preg_replace('#\[img\](.*)\[\/img\]#isU', '<img src="$1" alt="Bild" />', $tmpText);
	/*[align]*/ $tmpText = preg_replace('#\[align=(.*)\](.*)\[\/align\]#isU', '<div style="text-align:$1">$2</div>', $tmpText); 
	/*[center]*/$tmpText = preg_replace('#\[center\](.*)\[\/center\]#isU', '<div style="text-align:center">$1</div>', $tmpText);
	/*[right]*/ $tmpText = preg_replace('#\[right\](.*)\[\/right\]#isU', '<div style="text-align:right">$1</div>', $tmpText);
	/*[left]*/ 	$tmpText = preg_replace('#\[left\](.*)\[\/left\]#isU', '<div style="text-align:left">$1</div>', $tmpText);
	/*[code]*/ 	$tmpText = preg_replace('#\[code\](.*)\[\/code\]#isU', '<code>$1</code>', $tmpText);
	/*[quote]*/ $tmpText = preg_replace('#\[quote\](.*)\[\/quote\]#isU', '<table width=100% bgcolor=lightgray><tr><td bgcolor=white>$1</td></tr></table>', $tmpText);
	/*[quote=]*/$tmpText = preg_replace('#\[quote=(.*)\](.*)\[\/quote\]#isU', '<table width=100% bgcolor=lightgray><tr><td bgcolor=white>$1<blockquote>$2</blockquote></td></tr></table>', $tmpText);
	/*[mail=]*/	$tmpText = preg_replace('#\[mail=(.*)\](.*)\[\/mail\]#isU', '<a href="mailto:$1">$2</a>', $tmpText);
	/*[mail]*/ 	$tmpText = preg_replace('#\[mail\](.*)\[\/mail\]#isU', '<a href="mailto:$1">$1</a>', $tmpText);
	/*[email=]*/$tmpText = preg_replace('#\[email=(.*)\](.*)\[\/email\]#isU', '<a href="mailto:$1">$2</a>', $tmpText);
	/*[email]*/ $tmpText = preg_replace('#\[email\](.*)\[\/email\]#isU', '<a href="mailto:$1">$1</a>', $tmpText);
	/*[list]*/
		while(preg_match('#\[list\](.*)\[\/list\]#is', $tmpText)){
			$tmpText = preg_replace_callback('#\[list\](.*)\[\/list\]#isU',
				create_function('$str',"return str_replace(array(\"\\r\",\"\\n\"),'','<ul>'.preg_replace('#\[\*\](.*)\$#isU',
				'<li>\$1</li>',preg_replace('#\[\*\](.*)(\<li\>|\$)#isU','<li>\$1</li>\$2',preg_replace('#\[\*\](.*)(\[\*\]|\$)#isU',
				'<li>\$1</li>\$2',\$str[1]))).'</ul>');"), $tmpText);
			$tmpText = preg_replace('#<ul></li>(.*)</ul>(<li>|</ul>)#isU', '<ul>$1</ul></li>$2', $tmpText); // Validitäts-Korrektur
		}

	/*[list=]*/
		while(preg_match('#\[list=.\](.*)\[\/list\]#is', $tmpText)){
			$tmpText = preg_replace_callback('#\[list=.\](.*)\[\/list\]#isU',
				create_function('$str',"return str_replace(array(\"\\r\",\"\\n\"),'','<ul><ol>'.preg_replace('#\[\*\](.*)\$#isU',
				'<li>\$1</li>',preg_replace('#\[\*\](.*)(\<li\>|\$)#isU','<li>\$1</li>\$2',preg_replace('#\[\*\](.*)(\[\*\]|\$)#isU',
				'<li>\$1</li>\$2',\$str[1]))).'</ol></ul>');"), $tmpText);
			$tmpText = preg_replace('#<ul></li>(.*)</ul>(<li>|</ul>)#isU', '<ul>$1</ul></li>$2', $tmpText); // Validitäts-Korrektur
		}
		
	return nl2br($tmpText, true);
	
	}
	
	function parse_youtube_url($url,$return='embed',$width='',$height='',$rel=0){ 
    $urls = parse_url($url); 
     
    //expect url is http://youtu.be/abcd, where abcd is video iD 
    if($urls['host'] == 'youtu.be'){  
        $id = ltrim($urls['path'],'/'); 
    } 
    //expect  url is http://www.youtube.com/embed/abcd 
    else if(strpos($urls['path'],'embed') == 1){  
        $id = end(explode('/',$urls['path'])); 
    } 
     //expect url is abcd only 
    else if(strpos($url,'/')===false){ 
        $id = $url; 
    } 
    //expect url is http://www.youtube.com/watch?v=abcd 
    else{ 
        parse_str($urls['query']); 
        $id = $v; 
    } 
    //return embed iframe 
    if($return == 'embed'){ 
        return '<iframe class="video_wrap" width="'.($width?$width:'100%').'" height="'.($height?$height:285).'" src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" allowfullscreen></iframe>'; 
    } 
    //return normal thumb 
    else if($return == 'thumb'){ 
        return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg'; 
    } 
    //return hqthumb 
    else if($return == 'hqthumb'){ 
        return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg'; 
    } 
    // else return id 
    else{ 
        return $id; 
    } 
}
	
	
	
	
	
	
	
	
	
	/*

    function GetPratsByID($id) {
        $query = $this->db->get_where('part',array('program_id_fk' => $id));
        $res = $query->result();
        return $res;
    }
    function GetPratByID($id) {
        $query = $this->db->get_where('part',array('id' => $id));
        $res = $query->result();
        return $res;
    }
    
 
*/
    
   

}

?>