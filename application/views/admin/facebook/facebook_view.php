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
	
		<div class="button ">
			<p class="m-5"></p>
		</div>
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
					<a class=" float-right" href="<?php echo base_url(); ?>webadmin/facebook/add">
						<button class="button-item">تعديل الصفحات<img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" /></button>
					</a>

					<br />
					<div class="clearfix"></div>
					<!-- .pagnation -->
			</div>
		</div>
	</div>			
	<?php  $this->load->view('admin/includes/footer.php'); ?>       
 
    </div>
</body>

</html>