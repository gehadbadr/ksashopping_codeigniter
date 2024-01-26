<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>

<title>تسجيل دخول - KSA SHopping</title>
<?php  $this->load->view('includes/head.php'); ?>
</head>
<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">


	<?php  $this->load->view('includes/navigator.php'); ?>
<div class="row no-gutters ">	
	<div class="col-md-7 col-12">
		<div class="box contact_col ml-md-3" style="min-height:380px;">
			<h2>تسجيل الدخول</h2>
			<div class="inside">
			<p class="login_p"><b>مرحباً بك. سجل الدخول الى حسابك ...</b></p>
		   <table class="contact_table">
				<form  name="form" method="post" action="<?php echo base_url().'customer/login'; ?>">
				<?php
							if ($this->session->flashdata('login_error')){
								echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
								echo "</div>";
							}
						?>
					<tr>
						<td width="30%">البريد الالكتروني:</td>
						<td width="70%"><input type="text" class="form-control"  name="email" value="<?php echo set_value("email") ;?>"/><?php echo form_error("email") ;?></td>
					</tr>
					<tr>
						<td>كلمة المرور:</td>
						<td><input type="password" class="form-control"  name="password" value="<?php echo set_value("password") ;?>"/><?php echo form_error("password") ;?></td>
					</tr>
					<tr>
						<td class="form-check">
							  <label class="form-check-label">
								<input type="checkbox" class="form-check-input" value="" name="remember" style="position: relative;margin-left:0;" >&nbsp;&nbsp;تذكرني
							  </label>
						</td>
					</tr>	
					<tr>
						<td><br><a href="<?php echo base_url();?>customer/forget" style="font-weight: bolder;" >نسيت كلمة المرور؟</a></td>
					</tr>
					<tr>
						<td><br><a href="<?php echo base_url();?>customer/register" style="color:#a10000;font-weight: bolder;" >انشئ حساب جديد</a></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="تسجيل دخول" class="red_button"/></td>
					</tr>
				<form/>
			</table>
			</div><!-- .inside -->
			
		</div><!-- .box -->
	</div><!-- .col -->

	<div class="col-md-5 col-12 " >
		
		<div class="box" style="min-height:404px;">
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