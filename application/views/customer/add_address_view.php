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
<div class="container" id="main">
	
    	<?php $this->load->view('includes/navigator.php');?>
    <div class="clear"></div>
	
<div class="row no-gutters ">	
	<?php include'customer_menu.php';?>

	<div class="col-md-8 col-12">
	<?php if (!empty($this_customer)) {
	    foreach ($this_customer as $row): ?>	
		<div class="box" style="min-height: 514px;">
			<h2>عناويـــــــــــني</h2>
			<div class="contact_info">
				<strong style="w">مرحبا <?php echo $row->fname ;?> برجاء ادخل بيانات عنوانك بعناية
				 <table class="contact_table">
				<form  name="form" method="post" action="<?php echo base_url().'customer/address/add'; ?>">
					<?php
							if ($this->session->flashdata('login_error')){
								echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
								echo "</div>";
							}
						?>		   
					<tr>
						<td width="30%">المحافظة :</td>
						<td width="70%"><input type="text" class="form-control" name="governorate" value="<?php echo set_value("governorate") ;?>"/><?php echo form_error("governorate") ;?></td>
					</tr>
					<tr>
						<td width="30%">المدينة :</td>
						<td width="70%"><input type="text" class="form-control" name="city" value="<?php echo set_value("city") ;?>"/><?php echo form_error("city") ;?></td>
					</tr>
					<tr>
						<td width="30%">المنطقة :</td>
						<td width="70%"><input type="text" class="form-control" name="region" value="<?php echo set_value("region") ;?>"/><?php echo form_error("region") ;?></td>
					</tr>
					<tr>
						<td width="30%">رقم او اسم الشارع :</td>
						<td width="70%"><input type="text" class="form-control" name="street" value="<?php echo set_value("street") ;?>"/><?php echo form_error("street") ;?></td>
					</tr>
					<tr>
						<td width="30%">رقم او اسم العمارة :</td>
						<td width="70%"><input type="text" class="form-control" name="building" value="<?php echo set_value("building") ;?>"/><?php echo form_error("building") ;?></td>
					</tr>
					<tr>
						<td width="30%">رقم الطابق :</td>
						<td width="70%"><input type="text" class="form-control" name="floor" value="<?php echo set_value("floor") ;?>"/><?php echo form_error("floor") ;?></td>
					</tr>
					<tr>
						<td width="30%">رقم الشقة :</td>
						<td width="70%"><input type="text" class="form-control" name="flat" value="<?php echo set_value("flat") ;?>"/><?php echo form_error("flat") ;?></td>
					</tr>
					<tr>
						<td>الموبايل :</td>
						<td>+02 <input type="text" class="form-control w-75" name="mobile" value="<?php echo set_value("mobile") ;?>" /><?php echo form_error("mobile") ;?></td>
					</tr>
					<tr>
						<td>الارضي :</td>
						<td>+02 <input type="text" class="form-control w-75" name="telephone" value="<?php echo set_value("telephone") ;?>" /><?php echo form_error("telephone") ;?></td>
					</tr>
					<tr>
						<td width="30%">نوع العنوان :</td>
						<td width="70%"><select name="type" class="form-control input-medium">
								<?php
									echo '<option value="">اختار النوع</option>';
						            echo '<option value="1" >منزل</option>';
									echo '<option value="2" >عمل</option>';						
								?>
							</select><?php echo form_error("type") ;?></td>
					</tr>
					<tr>
						<td width="30%">ملاحظات :</td>
						<td width="70%"><textarea cols="20" rows="6" class="form-control" name="notes" ><?php echo set_value("notes") ;?></textarea><?php echo form_error("notes") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="اضافة العنوان" class="red_button"/></td>
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