<?php
if (! function_exists('is_ajax'))
{
  function is_ajax() {
  return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
  ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
  }
}
if (! function_exists('set_msg'))
{
    function set_msg($msg,$type)
    {
        $CI =& get_instance();
        $CI->load->library('session');
		$message['msg']=$msg;
		$message['type']=$type;
		$j=$message;
        $CI->session->set_userdata('e_msg',$j);
    }
}
if (! function_exists('get_msg'))
{
    function get_msg()
    {
        $CI =& get_instance();
        $CI->load->library('session');
		$msg=$CI->session->userdata('e_msg');
		if(!empty($msg))
		{
		$text="<script>
		
$.jnotify('".$msg['msg']."','".$msg['type']."',4000);
</script>";
		
        
        $CI->session->unset_userdata('e_msg');
        return $text;
		}
    }
} 
 

?>