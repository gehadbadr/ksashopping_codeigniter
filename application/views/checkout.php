<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title><?php echo $title ;?></title>
<?php  $this->load->view('includes/head.php'); ?>
</head>
<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">
<?php  $this->load->view('includes/navigator.php'); ?>
<form action="<?php echo base_url() ;?>cart/checkout" method="post">
<div class="row no-gutters ">
	<div class="col-md-6 col-12">
		<div class="box invoice_col">
			<h2>معلومات المشتري</h2>
			<div class="inside">
				<table class="form_table">
					<tr>
						<td width="30%">الاسم:</td>
						<td width="70%"><input type="text" class="form-control" name="name" value="<?php echo set_value("name") ;?>"/><?php echo form_error("name") ;?></td>
					</tr>
					<tr>
						<td>البريد الإلكتروني:</td>
						<td><input type="text" class="form-control" name="email" value="<?php echo set_value("email") ;?>"/><?php echo form_error("email") ;?></td>
					</tr>
					<tr>
						<td>الجوال:</td>
						<td><input type="text" class="form-control" name="mobile" value="<?php echo set_value("mobile") ;?>"/><?php echo form_error("mobile") ;?></td>
					</tr>
					<tr>
						<td>المدينة:</td>
						<td><input type="text" class="form-control" name="city" value="<?php echo set_value("city") ;?>" /><?php echo form_error("city") ;?></td>
					</tr>
					<tr>
						<td>الحي / المنطقة:</td>
						<td><input type="text" class="form-control" name="address" value="<?php echo set_value("address") ;?>"/><?php echo form_error("address") ;?></td>
					</tr>
					<tr>
						<td>ملاحظات:</td>
						<td><textarea cols="20" rows="6" class="form-control" name="notes" ><?php echo set_value("notes") ;?></textarea><?php echo form_error("notes") ;?></td>
					</tr>
				   
				</table>

			</div><!-- .inside -->
		
		</div><!-- .box -->
	</div><!-- .right_col -->

	<div class="col-md-6 col-12">
		<div class="box invoice_col mr-md-3">

			<h2>طرق الدفع</h2>
			 <div class="inside">
        	
				<p><input type="radio" name="payment_method" value="delivery" /> <?php echo "الدفع عند الاستلام" ;?></p>
				<p><input type="radio" name="payment_method" value="bank" /> <?php echo ("الدفع عن طريق حواله بنكيه") ;?></p>
				<p><input type="radio" name="payment_method" value="online" /> <?php echo ("الدفع اونلاين") ;?></p>
				<?php echo form_error("payment_method") ;?>
				<input type="submit" class="invoice_submit" value="ارسال الطلب" />
			</div><!-- .inside -->
		</div><!-- .box -->
	</div><!-- .left_col -->
</div><!-- .row -->
</form>

	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>