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
	
<div class="row no-gutters ">
	<div class="col-md-7 col-12">
		<div class="box bank_col ml-md-3">
		  <h2>الحسابات البنكية</h2>
		<?php if (!empty($payment)){?>
		  <?php   foreach ($payment as $row): ?>
			<div class="bank_title p-0"><img src="<?php echo base_url().$row->path ;?>" alt=""  width="100%" height="60"/></div>
			<div class="bank_info">
				<?php $text = $this->admin_model->bb2html($row->content);?>
				<p ><?php echo $text  ;?></p>
			</div><!-- .bank_info -->
			<?php endforeach;    ?>
	    <?php }else{
				  echo "<br /><br /><br /><br />";
	              echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	              echo "عفوا لا يوجد حسابات بنكية حاليا";
				
		}?>	
	<?php if (!empty($payment)) {?>
	<div class="pagination justify-content-center">
		<?php echo $this->pagination->create_links(); ?>
	</div><!-- .pagination -->
    <?php }?>
		</div><!-- .box -->
	</div><!-- .right_content -->

	<div class="col-md-5 col-12">
		<div class="box bank_col">

			<h2>طرق الدفع</h2>
			
			<div class="inside">
				<table class="small_form_tbl">
				<form method="post" action="<?php echo base_url().'pro/payment_methods';?>">
					<tr>
						<td width="30%">الاسم:</td>
						<td width="70%"><input type="text" class="form-control" name="name" value="<?php if(empty($msg)){echo set_value("name");} ?>"/><?php echo form_error("name") ;?></td>
					</tr>
					<tr>
						<td>الإيميل:</td>
						<td><input type="text" class="form-control" name="email" value="<?php if(empty($msg)){echo set_value("email");} ?>"/><?php echo form_error("email") ;?></td>
					</tr>
					<tr>
						<td>الجوال:</td>
						<td><input type="text" class="form-control" name="mobile" value="<?php if(empty($msg)){echo set_value("mobile");} ?>"/><?php echo form_error("mobile") ;?></td>
					</tr>
					<tr>
						<td>البنك المحول عليه:</td>
						<td><input type="text" class="form-control" name="bank" value="<?php if(empty($msg)){echo set_value("bank");} ?>"/><?php echo form_error("bank") ;?></td>
					</tr>
					<tr>
						<td>التاريخ:</td>
						<td><input type="text" class="form-control" name="date" value="<?php if(empty($msg)){echo set_value("date");} ?>"/><?php echo form_error("date") ;?></td>
					</tr>
					<tr>
						<td>اسم المودع:</td>
						<td><input type="text" class="form-control" name="dname" value="<?php if(empty($msg)){echo set_value("dname");} ?>"/><?php echo form_error("dname") ;?></td>
					</tr>
					<tr>
						<td>المبلغ: </td>
						<td><input type="text" class="form-control" name="payment" value="<?php if(empty($msg)){echo set_value("payment");} ?>"/><?php echo form_error("payment") ;?></td>
					</tr>
					<tr>
						<td valign="top">ملاحظات:</td>
						<td><textarea cols="20" rows="6" class="form-control" name="note"  ><?php if(empty($msg)){echo set_value("note");} ?></textarea><?php echo form_error("note") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="ارسال" /></td>
					</tr>
				</form>
            </table>
			
			<br />
		    <div align="center">
			  <?php if(!empty($msg)){
							echo $msg;
					  }
					?>
			</div>
			</div><!-- .inside -->
		
		</div><!-- .box -->
	</div><!-- .left_col -->
</div><!-- .row -->
	
	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>