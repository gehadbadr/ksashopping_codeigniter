<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | تسجيل الدخول</title>
</head>
<body>
	<div class="container">	
		<header>
			<div class="adminTop">
			</div>
		</header> 
	
	
		<div class="row no-gutters">
			<div class="col-lg-4 col-md-6 col-sm-9 col-9  content">
			  <p class="top">تسجيل الدخول</p>
				<div class="card-body">
					<form id="form" name="form" method="post" action="<?php echo base_url().'webadmin/login'; ?>">
						<div class="form-group">
						  <label for="usr">اسم المستخدم</label>
						  <input type="text" class="form-control input-login" id="usr" name="username" value="<?php echo set_value("username") ;?>" /><?php echo form_error("username") ;?>
						</div>
						<div class="form-group">
						  <label for="pwd">كلمة المرور</label>
						  <input type="password" class="form-control input-login" id="pwd" name="password" value="<?php echo set_value("password") ;?>" /><?php echo form_error("password") ;?>
						</div>
						<div class="form-check">
						  <label class="form-check-label">
							<input type="checkbox" class="form-check-input" value="" name="remember" style="position: relative;margin-left:0;" >&nbsp;&nbsp;تذكرني
						  </label>
						</div>
						<div  align="center" >
							<a href="<?php echo base_url() . 'webadmin/forget'; ?>">نسيت كلمة المرور ؟</a>
						</div>
						<div style="background-color: #D0D0D0">
						<?php
							if ($this->session->flashdata('login_error')){
								echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
								echo "</div>";
							}
						?>	  
						</div>
						<div  align="center" >
							<input type="submit" class="submit-green" value="تسجيل الدخول" />
						</div>
					</form>
					
				</div> 	
			</div>
		</div>
		<?php  $this->load->view('admin/includes/footer.php'); ?>       
    </div>
</body>
</html>