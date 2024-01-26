<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>

<title>لوحة التحكم | تعديل صفحة</title></head>
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
			<p class="top"  style="text-align:right;">تعديل صفحة</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url() ;?>webadmin/pages/edit/<?php echo $this_page[0]->page_id ; ?>" method="post" enctype="multipart/form-data">
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
							<label>عنوان الصفحة</label>
							<input type="text" class="form-control input-medium" name="page_title" value="<?php echo $this_page[0]->title  ;?>"/><?php echo form_error("page_title") ;?>
						</p>
						<p>
							<label>تفاصيل طريقة الدفع</label>
							<textarea cols="80" class="editor" name="page_content" rows="10"><?php echo $this_page[0]->content  ;?></textarea><?php echo form_error("page_content") ;?>
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
							<label>الصورة الرئيسية</label>
							<input type="file"  name="image" size="35"/><br /><br />
							<?php if(!empty($this_page[0]->thumb)){?>
							<img src="<?php echo base_url().$this_page[0]->thumb  ;?>" alt="" width="120" height="120" />
                            <?php }?>
						</p>
						<p>
							<input type="submit" value="تعديل" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/pages/';" />
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