<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | اضافة طريقة دفع</title></head>
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
			<p class="top"  style="text-align:right;">اضافة طريقة دفع</p>

			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url() ;?>webadmin/payment/add" method="post" enctype="multipart/form-data">
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
							<label>اسم طريقة الدفع</label>
							<input type="text" class="form-control input-medium" name="payment_name" value="<?php echo set_value("payment_name") ;?>"/><?php echo form_error("payment_name") ;?>
						</p>
						<p>
							<label>تفاصيل طريقة الدفع</label>
							<textarea cols="80" class="editor" name="content" rows="10"></textarea><?php echo form_error("content") ;?>
							<script src="<?php echo  base_url(); ?>ckeditor5/build/ckeditor.js"></script>
<script>ClassicEditor
			.create( document.querySelector( '.editor' ), {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'fontBackgroundColor',
						'fontColor',
						'fontFamily',
						'fontSize',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'imageInsert',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'htmlEmbed',
						'alignment'
					]
				},
				language: 'ar',
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				
			} )
			.then( editor => {
				window.editor = editor;
	
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: 46qbestze5qk-galmdvau5rec' );
				console.error( error );
			} );
	
	</script>
						</p>
						<p>
							<label>الصورة الرئيسية</label>
							<input type="file"  name="photo_thumb" size="35"/><br /><br />
						</p>
						<p>
							<input type="submit" value="إضافة" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/payment/';" />
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