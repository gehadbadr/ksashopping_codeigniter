<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | تعديل منتج</title>
</head>
<script type="text/javascript" src="<?php echo base_url() ;?>js/jquery.MultiFile.js"></script>
<script type="text/javascript">
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

});	
</script>
<link href="<?php echo base_url(); ?>css/tablesorter.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
                        $(document).ready(function() {
                            $("#myTable")
                            .tablesorter({
                                // zebra coloring
                                widgets: ['zebra'],
                                // pass the headers argument and assing a object
                                headers: {
                                    // assign the sixth column (we start counting zero)
                                    3: {
                                        // disable it by setting the property sorter to false
                                        sorter: false
                                    }
                                }
                            })
                   		$('.delete').click(function(){
                            del=confirm('هل تريد حذف هذا الفيديو؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/pvideo/delete/<?php echo $this_product[0]->product_id ?>/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').length==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد فيديوهات</td></tr>');
                                    }
                                });
                            }
                        });
						$("#myTable_color")
                            .tablesorter({
                                // zebra coloring
                                widgets: ['zebra'],
                                // pass the headers argument and assing a object
                                headers: {
                                    // assign the sixth column (we start counting zero)
                                    3: {
                                        // disable it by setting the property sorter to false
                                        sorter: false
                                    }
                                }
                            })
                   		$('.delete_color').click(function(){
                            del=confirm('هل تريد حذف هذا اللون ؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/pcolor/delete/<?php echo $this_product[0]->product_id ?>/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable_color > tbody > tr').length==0)
                                    {
                                        $('#myTable_color > tbody').html('<tr><td colspan="5" alig="center">لا يوجد الوان</td></tr>');
                                    }
                                });
                            }
                        });
						$("#myTable_size")
                            .tablesorter({
                                // zebra coloring
                                widgets: ['zebra'],
                                // pass the headers argument and assing a object
                                headers: {
                                    // assign the sixth column (we start counting zero)
                                    3: {
                                        // disable it by setting the property sorter to false
                                        sorter: false
                                    }
                                }
                            })
                   		$('.delete_size').click(function(){
                            del=confirm('هل تريد حذف هذا المقاس ؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/psize/delete/<?php echo $this_product[0]->product_id ?>/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable_size > tbody > tr').length==0)
                                    {
                                        $('#myTable_size > tbody').html('<tr><td colspan="5" alig="center">لا يوجد مقاسات</td></tr>');
                                    }
                                });
                            }
                        });
						$('.delete_image').click(function(){
                            del=confirm('هل تريد حذف هذة الصورة ؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/image/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable_image > tbody > tr').length==0)
                                    {
                                        $('#myTable_image > tbody').html('<tr><td colspan="5" alig="center">ا يوجد صور حاليا</td></tr>');
                                    }
                                });
                            }
                        });
						});
                    </script>
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
			<p class="top"  style="text-align:right;"><?php echo $this_product[0]->name ;?></p>

			<div class="module-body">																		
				<div class="module-table-body w-100">
					<div class="" style="">
						<form action="<?php echo  base_url(); ?>webadmin/comment/product"  method="post">
							<input type="hidden" name="product_code" class="form-control input-short" size="3" value="<?php echo $this_product[0]->product_id;?>"  /></b>
							<input type="submit" value="التعليقات الخاصة بالمنتج" class=""  />
							<p><?php echo validation_errors(); ?></p>
						</form>
					</div>
					<form action="<?php echo base_url() ;?>webadmin/product/edit/<?php echo $this_product[0]->product_id ;?>" method="post" enctype="multipart/form-data">
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
						<?php 	
							if($this_product[0]->statue == 1){
								 echo  '<img src="' . base_url() . 'images/admin/offer.jpg"  width="30%" height="150" alt="edit" style="float:left;margin-left:20px;" />';
							}  
						?>	
						<p>
							<label class="pb-2"><b>كود المنتج : <?php echo $this_product[0]->product_id ;?></b></label>
						</p>
						<p>
							<label>اسم المنتج</label>
							<input type="text" class="form-control input-medium " name="name" value="<?php echo $this_product[0]->name ;?>"/><?php echo form_error("name") ;?>
						</p>
						<p>
							<label>القسم الرئيسى</label>
							<select name="cat_id" class="form-control input-medium">
								<option value="">اختار التصنيف</option>
								<?php
									for ($i = 0; $i < count($cats); $i++) {
										if ($this_product[0]->cat_id_fk == $cats[$i]->cat_id) {
											echo "<option value='" . $cats[$i]->cat_id . "' selected=''>" . $cats[$i]->name . "</option>";
										} else {
											echo "<option value='" . $cats[$i]->cat_id . "'>" . $cats[$i]->name . "</option>";
										}
									}
								?>
							</select><?php echo form_error("cat_id") ;?>
						</p>
					
						<p>
							<label>تفاصيل المنتج</label>
							<textarea class="editor" name="details" ><?php echo $this_product[0]->details ;?></textarea><?php echo form_error("details") ;?>
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
						<?php
							if(empty ($pvideo)){
								echo 'لا يوجد فيديوهات لهذا المنتج';
								echo  '  <p>اضافة فيديوهات للمنتج<br/>  ';                                                              
							}else{ 
								echo  '<p>تعديل فيديوهات المنتج  <br/> ';
							}	
						?>
						
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
						<?php	if(!empty ($pvideo)){  ?>	
							<table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
								<thead>
									<tr>
										<th style="width:5%">#</th>
										<th style="width:30%">الفيديو</th>
										<th style="width:10%"></th>
									</tr>
								</thead>
								<tbody>
								<?php
									for ($i = 0; $i < count($pvideo); $i++) {
										echo '<tr id="' . $pvideo[$i]->video_id . '">';
										echo '<td class="align-center">' . ($i+1). '</td>';
										echo '<td><a href="' . base_url() . 'webadmin/pvideo/edit/' . $this_product[0]->product_id . '/'.$pvideo[$i]->video_id.'">' . $pvideo[$i]->url . '</a></td>';
										echo '<td>';
										echo '<a href="' . base_url() . 'webadmin/pvideo/edit/' . $this_product[0]->product_id . '/'.$pvideo[$i]->video_id. '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
										echo '<a href="javascript:;" class="delete" rel="' . $pvideo[$i]->video_id . '"><img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
										echo '</td>';
										echo '</tr>';
									}
								?>
								</tbody>
							</table>
						</p>
						<?php	}?>
						</div>
						<div class="product_table">
						<p>
						<?php
							if(empty ($pcolor)){
								echo 'لا يوجد الوان لهذا المنتج';
								echo  '  <p>اضافة الوان المنتج<br/>  ';                                                              
							}else{ 
								echo  '<p>تعديل الوان المنتج  <br/> ';
							}	
						?>
						
						<script type="text/javascript"><!--
							var gFiles = 0;
							function addcolor() {
								var li = document.createElement('li');
								li.setAttribute('id', 'file-' + gFiles);
								li.innerHTML = '<input type="text" name="pcolor[]" class="input-medium"><span onclick="removecolor(\'file-' + gFiles + '\')" style="cursor:pointer;">حذف</span>';
								document.getElementById('color-root').appendChild(li);
								gFiles++;
							}
							function removecolor(aId) {
								var obj = document.getElementById(aId);
								obj.parentNode.removeChild(obj);
							}
						--></script>
						<span onclick="addcolor()" style="cursor:pointer;">أضافة  لون اخر</span><img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" />
						<ol id="color-root">
							<li><input class="form-control input-medium" type="text" name="pcolor[]"/>
						</ol>
						</p>
						<?php	if(!empty ($pcolor)){  ?>	
							<table width="99%" class="tablesorter" id="myTable_color" style="background-position:center;">
								<thead>
									<tr>
										<th style="width:5%">#</th>
										<th style="width:30%">الوان المنتج</th>
										<th style="width:10%"></th>
									</tr>
								</thead>
								<tbody>
								<?php
									for ($i = 0; $i < count($pcolor); $i++) {
										echo '<tr id="' . $pcolor[$i]->color_id . '">';
										echo '<td class="align-center">' . ($i+1). '</td>';
										echo '<td>' . $pcolor[$i]->color . '</td>';
										echo '<td>';
										echo '<a href="javascript:;" class="delete_color" rel="' . $pcolor[$i]->color_id . '"><img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
										echo '</td>';
										echo '</tr>';
									}
								?>
								</tbody>
							</table>
						</p>
						<?php	}?>
						</div>
						
						<div class="product_table">
						<?php
							if(empty ($psize)){
								echo 'لا يوجد مقاسات  لهذا المنتج';
								echo  '  <p>اضافة مقاسات المنتج<br/>  ';                                                              
							}else{ 
								echo  '<p>تعديل مقاسات المنتج  <br/> ';
							}	
						?>
						
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
						<span onclick="addsize()" style="cursor:pointer;">أضافة  مقاس اخر</span><img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" />
						<ol id="size-root">
							<li><input class="form-control input-medium" type="text" name="psize[]"/>
						</ol>
						</p>
						<?php	if(!empty ($psize)){  ?>	
							<table width="99%" class="tablesorter" id="myTable_size" style="background-position:center;">
								<thead>
									<tr>
										<th style="width:5%">#</th>
										<th style="width:30%">مقاسات المنتج</th>
										<th style="width:10%"></th>
									</tr>
								</thead>
								<tbody>
								<?php
									for ($i = 0; $i < count($psize); $i++) {
										echo '<tr id="' . $psize[$i]->size_id . '">';
										echo '<td class="align-center">' . ($i+1). '</td>';
										echo '<td>' . $psize[$i]->size . '</td>';
										echo '<td>';
										echo '<a href="javascript:;" class="delete_size" rel="' . $psize[$i]->size_id . '"><img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
										echo '</td>';
										echo '</tr>';
									}
								?>
								</tbody>
							</table>
						</p>
						<?php	}?>
						</div>
						<div class="product_table">
						<p>
							<label>السعر</label>
							<input type="text" class="form-control input-short" name="price" value="<?php echo intval($this_product[0]->price) ;?>"/>  <?php echo form_error("price") ;?>
							<select class="form-control input-short" name="currency" >
								<option value="le" >جنيه</option>
							</select>
						</p>
						<p>
							<label>سعر العرض</label>
							<input type="text" class="form-control input-short" name="offer_price" value="<?php echo intval($this_product[0]->offer_price) ;?>"/><?php echo form_error("offer_price") ;?>
						</p>
						<p>
							<label>تاريخ  العرض</label>
							<div id="home-date" >
							 من : <input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control input-medium"  name="offer_start" value="<?php echo $this_product[0]->offer_start ;?>"><?php echo form_error("offer_start") ;?>
							<br/> إلى : <input type="date" data-date-format="dd-mm-yyyy" max="3000-12-31"   min="1000-01-01" class="form-control input-medium" name="offer_expire" value="<?php echo $this_product[0]->offer_expire ;?>"><?php echo form_error("offer_expire") ;?>
							</div>
						</p>
						<p>
							<label>مصاريف الشحن</label>
							<input type="text" class="form-control input-short" name="shipping" value="<?php echo intval($this_product[0]->shipping) ;?>"/><?php echo form_error("shipping") ;?>
						</p>
						</div>
						<p>
							<label>الصورة الرئيسية</label>
							<input multiple="multiple" data-maxsize="1024" type="file"  name="photo_thumb" size="35" id="main_image"/><br />
							<img src="<?php echo base_url().$product_main_image[0]->image_thumb  ;?>" alt="" width="120" height="120" />
						</p>
						<p>
							<label>صور المنتج</label>
							  <table class="tablesorter" id="myTable_image" style="border:1px solid #fff; width:27%;">
								<?php for ($i = 0; $i < count($product_images); $i++) {?>
								<tr id="<?php echo $product_images[$i]->image_id ;?>">
									<td><img src="<?php echo base_url().$product_images[$i]->image_thumb  ;?>" alt="" width="120" height="120" /></td>
									<td style="padding-top:53px;">
										<a href="javascript:;" class="delete_image" title="حذف" rel="<?php echo $product_images[$i]->image_id ;?>">
										<img src="<?php echo base_url();?>images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>
									</td>
								</tr>
								<?php   } ?>
						      </table>
							<input  multiple="multiple" data-maxsize="2024" type="file"  name="photo[]" size="35"  id="mui"   /><br />
							<p style="color:#686868; margin:0; margin-top:-10px;">يمكنك إضافة حتى 3  صور نوع jpg أو gif أو png</p>
						</p>			
						<p>
							<input type="submit" value="تعديل" class="submit-green"/>
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