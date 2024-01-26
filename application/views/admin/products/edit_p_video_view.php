<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>

        <title>لوحة التحكم | تعديل الفيديو </title>
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
			<p class="top"  style="text-align:right;">تعديل الفيديو</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="" method="post" >
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
							<label>اسم التصنيف</label>
							<input type="text" class="form-control input-medium" name="pvideo" value="<?php echo $pvideo[0]->url ;?>"/><?php echo form_error("pvideo") ;?>
						</p>
						<p>
							<input type="submit" value="تعديل" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/product/edit/<?php echo $this_product[0]->product_id ;?>';" />
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