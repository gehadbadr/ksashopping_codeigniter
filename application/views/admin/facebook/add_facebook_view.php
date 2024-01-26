<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | صفحات التواصل الاجتماعي</title>
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
			<p class="top"  style="text-align:right;">صفحات التواصل الاجتماعي</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="" method="post" >
						
						<p>
							<label><h3>Facebook</h3></label>
							<input type="text" class="form-control input-medium" name="facebook" value="<?php if($details){echo $details[0]->facebook;}?>"/><?php echo form_error("facebook") ;?>
						</p>
						<p>
							<label><h3>Twitter</h3></label>
							<input type="text" class="form-control input-medium" name="twitter" value="<?php if($details){echo $details[0]->twitter;}?>"/><?php echo form_error("twitter") ;?>
						</p>
						<p>
							<label><h3>Youtube</h3></label>
							<input type="text" class="form-control input-medium" name="youtube" value="<?php if($details){echo $details[0]->youtube;}?>"/><?php echo form_error("youtube") ;?>
						</p>
						<p>
							<input type="submit" value="تعديل" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/facebook/';" />
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