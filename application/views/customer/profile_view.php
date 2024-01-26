<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?php
    if ($this->session->userdata('customer_logged')) {
		$id=$this->session->userdata('customer_id');
		$this_customer = $this->customers_model->GetCustomerByID($id);	
        echo $this_customer[0]->fname." - KSA SHopping";
	}else{
		echo "KSA SHopping";
	}		
?></title>
<?php $this->load->view('includes/head.php');?>

</head>

<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">
	
    	<?php $this->load->view('includes/navigator.php');?>
    <div class="clear"></div>
	
<div class="row no-gutters ">
    	<?php include'customer_menu.php';?>

	<div class="col-md-8 col-12">
	<?php if (!empty($this_customer)) {
	    foreach ($this_customer as $row): ?>	
		<div class="box" style="min-height: 514px;">
			<h2>إعدادات الحساب</h2>
			<div class="contact_info">
				<strong style="w">معلومات الحساب
				<br>تفاصيل حسابك مشتركة بين سوق وامازون. ستنعكس التغييرات هنا على اسمك أو بريدك الإلكتروني أو رقم هاتفك أو كلمة المرور على حسابك في امازون أيضاً.</strong>
				<form  name="form" method="post" action="<?php echo base_url().'customer/edit'; ?>" class="p-3">
					<p><strong >الاسم الاول : </strong><span><?php echo $row->fname;?></span></p>
					<p><strong >اسم العائلة : </strong><span><?php echo $row->lname;?></span></p>
					<p><strong >البريد الإلكتروني : </strong><span><?php echo $row->email;?></span></p>
					<p><strong >كلمة المرور : </strong><span>********</span><a href="<?php echo base_url(); ?>customer/edit_password" class="customer_edit"><img src="<?php echo base_url(); ?>images/admin/pencil.gif"  width="20" height="20" alt="edit" /></a></p>
					<p><strong >الموبايل : </strong><span><?php if($row->mobile){echo $row->mobile;}else{echo '<a href="'.base_url().'customer/edit" class="customer_edit"> تعديل</a>';}?></span></p>
					<p><a href="<?php echo base_url(); ?>customer/edit" class="red_button m-3" style="float: left; padding: 0 16px;" >تعديل الحساب<a/></p>
					<p><strong >الجنس : </strong><span><?php if($row->gender){if($row->gender=='1'){echo "ذكر";}elseif($row->gender=='2'){echo "انثي";}}else{echo '<a href="'.base_url().'customer/edit" class="customer_edit"> تعديل</a>';}?></span></p>
					<p><strong >تاريخ الميلاد : </strong><span><?php if($row->dob && $row->dob!='0000-00-00'){echo $row->dob;}else{echo '<a href="'.base_url().'customer/edit" class="customer_edit"> تعديل</a>';}?></span></p>
			</div><!-- .contact_info -->
		</div><!-- .box -->
	<?php   endforeach;
        }?> 	
		
	</div><!-- .col -->
</div><!-- .row -->

<?php $this->load->view('includes/footer.php');?>
</div><!-- .wrapper -->
</body>
</html>