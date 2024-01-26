<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | إضافة منتج</title>
</head>
<script type="text/javascript" src="<?php echo base_url() ;?>js/jquery.MultiFile.js"></script>
<script type="text/javascript">
              /*          $(document).ready(function(){ // wait for document to load
                            $('#mui').MultiFile({
                                accept:'png|gif|jpg',
                                STRING: {
                                    remove: '<img src="admin/cross-on-white.gif" height="16" width="16" alt="x"/>'
                                }
                            });
                        });*/
/*$(function(){

	// invoke plugin
/*	$('#mui').MultiFile({
		onFileChange: function(){
			console.log(this, arguments);
		}
	});

});*/
$(function(){
  
  // up to 3 files can be selected
  // only images are allowed

  // invoke plugin
  $('#mui').MultiFile({
    max: 3, 
    accept: 'gif|jpg|png',
	STRING: {
			remove: '<img src="<?php echo base_url();?>images/admin/cross-on-white.gif" height="16" width="16" alt="x"/>'
	}
  });
  
    $('#main_image').MultiFile({
     accept: 'gif|jpg|png',
	
  });

});	</script>
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
			<p class="top"  style="text-align:right;">إضافة منتج</p>

			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url() ;?>webadmin/product/add" method="post" enctype="multipart/form-data">
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
							<label>اسم المنتج</label>
							<input type="text" class="form-control input-medium " name="name" value="<?php echo set_value("name") ;?>"/><?php echo form_error("name") ;?>
						</p>
						<p>
							<label>القسم الرئيسى</label>
							<select name="cat_id" class="form-control input-medium">
								<option value="">اختار التصنيف</option>
								<?php
									for ($i = 0; $i < count($cats); $i++) {
										echo "<option value='" . $cats[$i]->cat_id . "'>" . $cats[$i]->name . "</option>";
									}
								?>
							</select><?php echo form_error("cat_id") ;?>
						</p>
						<p>
							<label>تفاصيل المنتج</label>
							<textarea cols="80" class="editor" name="content" ><?php echo set_value("content") ;?></textarea><?php echo form_error("content") ;?>
<script src="<?php echo base_url(); ?>ckeditor5/build/ckeditor.js"></script>
<script>ClassicEditor
			.create( document.querySelector( '.editor' ), {
				
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
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: ojsj9jp71n04-gqdv78cg8kdd' );
				console.error( error );
			} );
	</script>
						</p>
						<div class="product_table">
							<p>
						اضافة فيديوهات للمنتج<br/>
						<script type="text/javascript"><!--
							var gFiles = 0;
							function addFile() {
								var li = document.createElement('li');
								li.setAttribute('id', 'file-' + gFiles);
								li.innerHTML = '<input type="text" name="pvideo[]" class="input-medium"><span onclick="removeFile(\'file-' + gFiles + '\')" style="cursor:pointer;">حذف</span>';
								document.getElementById('files-root').appendChild(li);
								gFiles++;
							}
							function removeFile(aId) {
								var obj = document.getElementById(aId);
								obj.parentNode.removeChild(obj);
							}
						--></script>
						<span onclick="addFile()" style="cursor:pointer;">أضافة أخر</span><img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" />
						<ol id="files-root">
							<li><input class="form-control input-medium" type="text" name="pvideo[]"/>
						</ol>
						</p>
						</div>
						<div class="product_table">
						<p>
						اضافة الوان المنتج<br/>
						<script type="text/javascript"><!--
							var gFiles = 0;
							function addcolor() {
								var li = document.createElement('li');
								li.setAttribute('id', 'file-' + gFiles);
								li.innerHTML = '<input type="text" name="pcolor[]" class="input-medium"><span onclick="removecolor(\'file-' + gFiles + '\')" style="cursor:pointer;">حذف</span>';
								document.getElementById('colors-root').appendChild(li);
								gFiles++;
							}
							function removecolor(aId) {
								var obj = document.getElementById(aId);
								obj.parentNode.removeChild(obj);
							}
						--></script>
						<span onclick="addcolor()" style="cursor:pointer;"> اضافة  لون اخر</span><img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" />
						<ol id="colors-root">
							<li><input class="form-control input-medium" type="text" name="pcolor[]"/>
						</ol>
						</p>
						</div>
						<div class="product_table">
						<p>
						اضافة مقاسات المنتج<br/>
						<script type="text/javascript"><!--
							var gFiles = 0;
							function addsize() {
								var li = document.createElement('li');
								li.setAttribute('id', 'file-' + gFiles);
								li.innerHTML = '<input type="text" name="psize[]" class="input-medium"><span onclick="removesize(\'file-' + gFiles + '\')" style="cursor:pointer;">حذف</span>';
								document.getElementById('size-root').appendChild(li);
								gFiles++;
							}
							function removesize(aId) {
								var obj = document.getElementById(aId);
								obj.parentNode.removeChild(obj);
							}
						--></script>
						<span onclick="addsize()" style="cursor:pointer;"> اضافة  مقاس  اخر</span><img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" />
						<ol id="size-root">
							<li><input class="form-control input-medium" type="text" name="psize[]"/>
						</ol>
						</p>
						</div>
						<div class="product_table">
						<p>
							<label>السعر</label>
							<input type="text" class="form-control input-short" name="price" value="<?php echo set_value("price") ;?>"/>  <?php echo form_error("price") ;?>
							<select class="form-control input-short" name="currency" >
								<option value="le" >جنيه</option>
							</select>
						</p>
						<p>
							<label>سعر العرض</label>
							<input type="text" class="form-control input-short" name="offer_price" value="<?php echo set_value("offer_price") ;?>"/><?php echo form_error("offer_price") ;?>
						</p>
						<p>
							<label>تاريخ  العرض</label>
							<div id="home-date" >
							 من : <input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control input-medium"  name="offer_start" value="<?php echo set_value("offer_start") ;?>"><?php echo form_error("offer_start") ;?>
							<br/> إلى : <input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control input-medium" name="offer_expire" value="<?php echo set_value("offer_expire") ;?>"><?php echo form_error("offer_expire") ;?>
							</div>
						</p>
						<p>
							<label>مصاريف الشحن</label>
							<input type="text" class="form-control input-short" name="shipping" value="<?php echo set_value("shipping") ;?>"/><?php echo form_error("shipping") ;?>
						</p>
						</div>
						<p>
							<label>الصورة الرئيسية</label>
							<input multiple="multiple" data-maxsize="1024" type="file"  name="photo_thumb" size="35" id="main_image"/><br />
						</p>
						<p>
							<label>صور المنتج</label>
							<input  multiple="multiple" data-maxsize="2024" type="file"  name="photo[]" size="35"  id="mui"   /><br />
							<p style="color:#686868; margin:0; margin-top:-10px;">يمكنك إضافة حتى 3  صور نوع jpg أو gif أو png</p>
						</p>
						<p>
							<input type="submit" value="إضافة" class="submit-green"/>
							<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/product/';" />
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