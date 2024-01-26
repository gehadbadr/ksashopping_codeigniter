<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | نسيت كلمة المرور</title>
</head>
<body>
	<div class="container">	
		<header>
			<div class="adminTop">
			</div>
		</header> 
	
	
		<div class="row no-gutters">
			<div class="col-lg-4 col-md-6 col-sm-9 col-9  content">
			  <p class="top">نسيت كلمة المرور</p>
				<div class="card-body">
					<form id="form" name="form" method="post" action="<?php echo base_url().'webadmin/forget'; ?>">
						<div class="form-group">
						  <label for="usr">البريد الإلكترونى</label>
						  <input type="text" class="form-control input-login" id="usr" name="email" value="<?php echo set_value("email") ;?>" /><?php echo form_error("email") ;?>
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
							<input type="submit" class="submit-green" value="إرسال" />
						</div>
					</form>
					
				</div> 	
			</div>
		</div>
		<?php  $this->load->view('admin/includes/footer.php'); ?>       
    </div>
</body>
</html>