<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | المنتجات</title>
</head>
<body>

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
							
							$('#check_all').click(function() {
								var checked = $(this).prop('checked');
								$('input:checkbox').prop('checked', this.checked);    
							});
						
						$('.delete').click(function(){
                            del=confirm('هل تريد حذف هذا المنتج ؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/product/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').length==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد منتجات  حاليا</td></tr>');
                                    }
                                });
                            }
                        });
						$('#acts').click(function(){
                            action=$(this).val();
                            if(action!="-1")
                            {
                                if($('[name="chk[]"]:checked').length=='0')
                                {
                                    alert("اختر عنصر واحد على الأقل");
                                }else{

                                    del=confirm('هل تريد اجراء هذة العملية علي المنتجات المختارة ؟');
                                    if(del)
                                    {
                                        $('#forn').submit();
                                        $(this).val('-1');
                                    }
                                }
                            }
                        });
						jQuery("#cats").change(function () {
							location.href = jQuery(this).val();
						});
						});
                    </script>
					
		
	<div class="container">
		<header>
		<?php  $this->load->view('admin/includes/admin_top.php'); ?>
		</header> 
		<div class="pr-2 w-50" style="float:right;">
			<form action="" id="fcate" method="post">						
				<b>  اختار التصنيف : </b>
				<select name="cat_id" class="form-control input-medium" style="width:auto;" id="cats" >
					<?php  if(empty($cat_id)){
								echo'<option value="<?php echo  base_url(); ?>webadmin/product" selected="">الكل</option>';
							}else{
								echo'<option value="<?php echo  base_url(); ?>webadmin/product">الكل</option>';
							}?>		
					<?php
							for ($i = 0; $i < count($cats); $i++) {
								if (!empty($cat_id) && $cat_id == $cats[$i]->cat_id) {
									echo "<option value='" .base_url()."webadmin/pcat/". $cats[$i]->cat_id . "' selected=''>" . $cats[$i]->name. "</option>";
								} else {
									echo "<option value='" .base_url()."webadmin/pcat/". $cats[$i]->cat_id . "'>" . $cats[$i]->name . "</option>";
								}
							}
					?>
				</select>
			</form>
			<form action="<?php echo  base_url(); ?>webadmin/pcode"  method="post">
				<b>  ادخل كود المنتج الذي تريد البحث عنه : </b>
				<input type="text" name="product_code" class="form-control input-short" size="3" value=""  />
				<input type="submit" value="بحث" class="submit-green"  />
				<?php echo form_error("product_code") ;?>
			</form>
		</div>	
		<div class="button ">
			<b>
				<a href="<?php echo base_url() ;?>webadmin/product/add">
					<button class="button-item">منتج جديد<img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" /></button>
				</a>
			</b>
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
			<p class="top"  style="text-align:right;">المنتجات</p>
			<div class="module-body">	
			<?php if (!empty(form_error("sort"))|| !empty($this->session->flashdata('login_error'))) {?>
	        <div class="slidingDiv" style="BACKGROUND-COLOR: #3333 ;" id="">
				<?php }else{?>
			
	        <div class="slidingDiv collapse navbar-collapse" style="BACKGROUND-COLOR: #3333 ;" id="slidingDiv">
			<?php }?>				

				<form action="<?php echo base_url(); ?>webadmin/pcat/sort" id="form" method="post">
						<h4>اكتب الترتيب :</h4> <input type="text" id="sort" name="sort" value="" />
				<?php if (!empty(form_error("sort"))) {?>
						<input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ; ?>" />
				<?php }elseif (!empty($this->session->flashdata('login_error'))){?>
						<input type="hidden" id="product_id" name="product_id" value="<?php echo $this->session->flashdata('product_id'); ?>" />
				<?php }else{?>
						<input type="hidden" id="product_id" name="product_id" value="" />
				<?php }?>
				<?php if(!empty($cat_id)){
							echo'<input type="hidden"  name="cat_id" value="'.$cat_id.'" />';
						}
				?>		
						<input type="submit" class="add_to_cart" value="رتب"/>
						<p><?php echo form_error("sort") ;?></p>
						<p>
							<?php if ($this->session->flashdata('login_error')){
									echo "<div class='form_error'>";
									echo $this->session->flashdata('login_error');
									echo "</div>";
								}?>
						</p>
					</form>
				</div>	
				<div class="module-table-body w-100">
					<form action="<?php echo base_url(); ?>webadmin/pcat/do_sort" id="do_sort_form" method="post">
					</form>
					<form action="<?php echo base_url(); ?>webadmin/product/do_operation" id="forn" method="post">
						<table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
							<thead>
								<tr>
									<th style="width:5%">#</th>
									<th class="w-50">اسم المنتج</th>
									<td class="w-25" style="background-color:#EEEEEE; padding: 4px;" class="no"><input type="checkbox" id="check_all" value="" /></th>
								</tr>
							</thead>
							<tbody>
							 <?php
								 if(!empty($products)){
									for ($i = 0; $i < count($products); $i++) {
										echo '<tr id="' . $products[$i]->product_id . '">';
										echo '<td class="align-center">' . $products[$i]->product_id . '</td>';
										echo '<td><a href="' . base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '">' . $products[$i]->name . '</a> ';
										if($products[$i]->statue==1){
											echo '<a href="' . base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '"><img src="' . base_url() . 'images/admin/offer.jpg"  width="16" height="16" alt="edit" /></a>';
										}
										echo '</td>';
										echo '<td>';
										echo '<input type="checkbox" name="chk[]" value="' . $products[$i]->product_id . '" />';
										if(!empty($pcat)){
										echo '<a class="up" href="#" rel="' . $products[$i]->product_id  . '"><img border="0" src="' . base_url() . '/images/admin/navigate_up.png" width="20" height="20"></a>';
										echo '<a class="down" href="#" rel="' . $products[$i]->product_id  . '"><img border="0" src="' . base_url() . '/images/admin/navigate_down.png" width="20" height="20" ></a>';
										echo '<a class="navbar-toggler write p-0" href="#" rel="' . $products[$i]->product_id . '" data-toggle="collapse" data-target="#slidingDiv"><img border="0" src="' . base_url() . '/images/admin/k-write.png" width="20" height="20"></a>';
										}
										echo '<a href="' . base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '" title="تعديل"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
										echo '<a href="javascript:;" class="delete" title="حذف" rel="' . $products[$i]->product_id . '">';
										echo '<img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
										echo '</td>';
										echo '</tr>';
									}
								}else{
										echo '<tr >';
										echo '<td class="align-center"></td>';
										echo '<td><strong>لا يوجد منتجات  حاليا</strong></td>';
										echo '<td>';
										echo '</td>';
										echo '</tr>';							
								}			
							?> 
						 </tbody>
						</table>
						<div class="table-apply">
							<div>
								<span>اختار عملية ليتم تطبيقها على الذى تم اختياره:</span>
								<select class="form-control input-medium" id="acts" name="operation" style="width:auto;">
									<option value="-1" selected="selected">اختار عملية </option>
									<option value="delete">حذف</option>
								</select>
							</div>
						</div>
                    </form>
					<br />
					<div class="clearfix"></div>
					<?php echo $this->pagination->create_links(); ?>
					<!-- .pagnation -->
				</div> <!-- End .module-table-body -->
			</div>
		</div>
	</div>			
	<?php  $this->load->view('admin/includes/footer.php'); ?>       
 
    </div>
				<script type="text/javascript">
						$(document).ready(function(){
							$("body").css("cursor", "auto");
							
							$('.up').click(function(){
							   $('*').css('cursor', 'wait');

								var row = $(this).parents("tr:first");
								var $t=$(this).attr('rel');
							
								$.post('<?php echo base_url(); ?>webadmin/pcat/sort_up/'+$t,function(data){
								   });
							   row.insertBefore(row.prev());
									$("#do_sort_form").submit();
								
							});
							
							
							$('.down').click(function(){
							
								$('*').css('cursor', 'wait');
			 
								var row = $(this).parents("tr:first");
								var $t=$(this).attr('rel');
								$.post('<?php echo base_url(); ?>webadmin/pcat/sort_down/'+$t,function(data){
								   });
								row.insertAfter(row.next());
									$("#do_sort_form").submit();
							});
																
						});


					$('.write').click(function(){
							
						var $t=$(this).attr('rel');
						document.getElementById("product_id").value = $t;
							
					});
					</script>
</body>

</html>