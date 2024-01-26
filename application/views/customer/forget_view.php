<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>

<title>استعادة كلمة السر - KSA SHopping</title>
<?php  $this->load->view('includes/head.php'); ?>
</head>
<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">


	<?php  $this->load->view('includes/navigator.php'); ?>
<div class="row no-gutters ">	
	<div class="col-md-7 col-12">
		<div class="box contact_col ml-md-3">
			<h2>نسيت كلمة المرور</h2>
			<div class="inside">
			<p class="login_p"><b>استعادة كلمة المرور .....</b></p>
		   <table class="contact_table">
				<form  name="form" method="post" action="<?php echo base_url().'customer/forget'; ?>">
					<?php
							if ($this->session->flashdata('login_error')){
								echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
								echo "</div>";
							}
						?>		   
					<tr>
						<td>الإيميل:</td>
						<td><input type="text" class="form-control" name="email" value="<?php echo set_value("email") ;?>"/><?php echo form_error("email") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="استعادة كلمة المرور" class="red_button"/></td>
					</tr>
					<form/>
				</table>
			</div><!-- .inside -->
			
		</div><!-- .box -->
	</div><!-- .col -->

	<div class="col-md-5 col-12 " >
		
		<div class="box" style="min-height:470px;">
		<h2>مواقع التواصل الاجتماعي</h2>
			<div class="inside">
				<p class="login_p"><b>يمكنك التسجيل السريع عن طريق</b></p>
				 <br>
				<input type="submit" value="تسجيل دخول" class="red_button"/>
				 <br> <br>
				<input type="submit" value="تسجيل دخول" class="red_button"/>
				 <br> <br>
				<input type="submit" value="تسجيل دخول" class="red_button"/>
				 <br> <br>
		    </div><!-- .inside -->
		</div><!-- .box -->
		
	
	</div><!-- .col -->
</div><!-- .row -->
	
   	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>