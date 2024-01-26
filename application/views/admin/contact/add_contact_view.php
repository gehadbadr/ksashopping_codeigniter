<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>

        <title>لوحة التحكم | معلومات الاتصال</title>
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
			<p class="top"  style="text-align:right;">معلومات الاتصال</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="" method="post" enctype="multipart/form-data">
					<p><b><?php echo validation_errors(); ?></b></p>

						<p>
							<label><h3>تفاصيل معلومات الاتصال<h3></label>
							<textarea cols="80" class="editor" name="contact_details" rows="10">
								<?php 	if($details){
											foreach ($details as $row){
												echo $row->contact_details;
											}
										}  ?>
							</textarea>
							<script src="<?php echo  base_url(); ?>ckeditor5/build/ckeditor.js"></script>
  <script>
        ClassicEditor
            .create( document.querySelector( '.editor' ) , {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'fontColor',
						'fontBackgroundColor',
						'fontFamily',
						'fontSize',
						'alignment',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'imageInsert',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'htmlEmbed'
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
                console.error( error );
            } );
			document.querySelector( '.submit-green' ).addEventListener( 'click', () => {
    const editorData = editor.getData();

    // ...
} );
    </script>
						</p>
						<p>
							<input type="submit" value="تعديل" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/contact/';" />
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