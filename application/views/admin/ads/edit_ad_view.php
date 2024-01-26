<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | تعديل اعلان</title></head>

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
			<p class="top"  style="text-align:right;">تعديل اعلان</p>

			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url() ;?>webadmin/ads/edit/<?php echo  $this_ad[0]->ad_id ;?>" method="post" enctype="multipart/form-data">
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
							<label>عنوان الاعلان</label>
							<input type="text" class="form-control input-medium " name="ad_name" value="<?php echo $this_ad[0]->ad_name ;?>"/><?php echo form_error("ad_name") ;?>
						</p>
						<p>
							<label>الرابط</label>
							<input type="text" class="form-control input-medium" name="ad_url" value="<?php echo $this_ad[0]->ad_url ;?>"/><?php echo form_error("ad_url") ;?>
						</p>
						<p>
							<label>تاريخ  العرض</label>
							<div id="home-date" >
							 من : <input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control input-medium"  name="ad_start" value="<?php echo $this_ad[0]->ad_start ;?>"><?php echo form_error("ad_start") ;?>
							<br/> إلى : <input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control input-medium" name="ad_expire" value="<?php echo $this_ad[0]->ad_expire ;?>"><?php echo form_error("ad_expire") ;?>
							</div>
						</p>
						<p>
							<label>الصورة</label>
							<input type="file"  name="ad_image" size="35"/><br /><br />							
						</p>
						<p> <img src="<?php echo base_url() ;?><?php echo $this_ad[0]->thumb ;?>" width="100" height="100" /></p>
						<p>
							<input type="submit" value="تعديل" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/ads/';" />
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