<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | إضافة مستخدم</title>
</head>
<body>

	<div class="container">
		<header>
		<?php  $this->load->view('admin/includes/admin_top.php'); ?>
		</header> 
		
		<div class="button m-5"></div>
		<div class="clearfix"></div>

		<div class="row no-gutters mb-4">
		<div class="col-3 d-none d-md-block sidebar">
			<p class="top">القائمة الرئيسية</p>
			<div class="module-body" >
				<?php  $this->load->view('admin/includes/control_panel.php'); ?>
			</div>
		</div>
			<div class="col-md-8 col-12 mr-md-2 wrapper" >
			<p class="top"  style="text-align:right;">إضافة مستخدم</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url() ;?>webadmin/admins/add" method="post" enctype="multipart/form-data">
						<p>
						<div style="background-color: #D0D0D0">																																													
							<?php
								if ($this->session->flashdata('login_error')){
									echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
									echo "</div>";
								}
							?>	
						</div>
						</p>
						<p>
							<label>اسم المستخدم</label>
							<input type="text" class="form-control input-medium" name="username" value="<?php echo set_value("username") ;?>"/><?php echo form_error("username") ;?>
						</p>
						<p>
							<label>كلمة المرور</label>
							<input type="password" class="form-control input-medium"  name="password" value="" /><?php echo form_error("password") ;?>
						</p>
						<p>
							<label>إعادة كتابة كلمة المرور</label>
							<input type="password" class="form-control input-medium"  name="repassword" value="" /><?php echo form_error("repassword") ;?>
						</p>
						<p>
							<label>البريد الإلكترونى</label>
							<input type="text" class="form-control input-medium"  name="email" value="<?php echo set_value("email") ;?>" /><?php echo form_error("email") ;?>
						</p>
						<p>
							<input type="submit" value="إضافة" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/admins/';" />
						</p>
					</form>
				</div> <!-- End .module-table-body -->
			</div>
		</div>
	</div>
	
	<?php  $this->load->view('admin/includes/footer.php'); ?>       
 
    </div>
</body>

</html>