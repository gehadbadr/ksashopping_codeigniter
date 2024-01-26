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
				<form  name="form" method="post" action="<?php echo base_url().'customer/edit'; ?>">
					<?php
							if ($this->session->flashdata('login_error')){
								echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
								echo "</div>";
							}
						?>		   
					<tr>
						<td width="30%">الاسم الاول:</td>
						<td width="70%"><input type="text" class="form-control" name="fname" value="<?php echo $row->fname ;?>"/><?php echo form_error("fname") ;?></td>
					</tr>
					<tr>
						<td width="30%">اسم العائلة:</td>
						<td width="70%"><input type="text" class="form-control" name="lname" value="<?php echo $row->lname ;?>"/><?php echo form_error("lname") ;?></td>
					</tr>
					<tr>
						<td>الإيميل:</td>
						<td><?php echo $row->email ;?><td>
					</tr>
					<tr>
						<td>الموبايل:</td>
						<td>+02 <input type="text" class="form-control w-75" name="mobile" value="<?php echo $row->mobile ;?>" /><?php echo form_error("mobile") ;?></td>
					</tr>
					<tr>
						<td>الجنس:</td>
						<td><select name="gender" class="form-control input-medium">
								<?php
										if ($row->gender == '1') {
											echo '<option value="0">اختار الجنس</option>';
											echo '<option value="1" selected="">ذكر</option>';
											echo '<option value="2" >انثي</option>';
										} elseif ($row->gender == '2') {
											echo '<option value="0">اختار الجنس</option>';
											echo '<option value="1" >ذكر</option>';
											echo '<option value="2" selected="">انثي</option>';
										} else {
											echo '<option value="0">اختار الجنس</option>';
								            echo '<option value="1" >ذكر</option>';
								            echo '<option value="2" >انثي</option>';
										}
									
								?>
							</select><?php echo form_error("gender") ;?></td>
					</tr>
					<tr>
						<td>تاريخ الميلاد:</td>
						<td><input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control" name="dob" value="<?php echo $row->dob ;?>"><?php echo form_error("dob") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="تعديل بيانات الحساب" class="red_button"/></td>
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