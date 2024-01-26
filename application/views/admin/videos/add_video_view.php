<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | إضافة فيديو</title>
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
			<p class="top"  style="text-align:right;">إضافة فيديو</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url() ;?>webadmin/video/add" method="post" enctype="multipart/form-data">
						
						<p>
							<label>عنوان الفيديو</label>
							<input type="text" class="form-control input-medium" name="video_name" value="<?php echo set_value("video_name") ;?>"/><?php echo form_error("video_name") ;?>
						</p>
						<p>
							<label>الرابط</label>
							<input type="text" class="form-control input-medium" name="video_url" value="<?php echo set_value("video_url") ;?>"/><?php echo form_error("video_url") ;?>
						</p>
						<p>
							<input type="submit" value="إضافة" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/video/';" />
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