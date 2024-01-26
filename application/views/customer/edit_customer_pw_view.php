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
				 <table class="contact_table">
				<form  name="form" method="post" action="<?php echo base_url().'customer/edit_password'; ?>">
					<?php
							if ($this->session->flashdata('login_error')){
								echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
								echo "</div>";
							}
						?>		   
					<tr>
						<td>الإيميل:</td>
						<td><?php echo $row->email ;?><td>
					</tr>
					<tr>
						<td>كلمة المرور:</td>
						<td><input type="password" class="form-control" name="password" value=""/><?php echo form_error("password") ;?></td>
					</tr>
					<tr>
						<td>اعادة كتابة كلمة السر:</td>
						<td><input type="password" class="form-control" name="repassword" value=""/><?php echo form_error("repassword") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="تعديل" class="red_button"/></td>
					</tr>
					<form/>
				</table>
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