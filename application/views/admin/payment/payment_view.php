<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | طرق الدفع</title>
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
                            del=confirm('هل تريد حذف هذة الطريقة؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/payment/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').length==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد طرق دفع حاليا</td></tr>');
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

                                    del=confirm('هل تريد اجراء هذة العملية علي طرق الدفع المختارة');
                                    if(del)
                                    {
                                        $('#forn').submit();
                                        $(this).val('-1');
                                    }
                                }
                            }
                        });
						});
                    </script>
					
		
	<div class="container">
		<header>
		<?php  $this->load->view('admin/includes/admin_top.php'); ?>
		</header> 

		<div class="button ">
			<b>
				<a href="<?php echo base_url() ;?>webadmin/payment/add">
					<button class="button-item">طريقة دفع جديدة<img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" /></button>
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
			<p class="top"  style="text-align:right;">طرق الدفع</p>
			<div class="module-body">	
			<?php
				$valid = validation_errors();
				if (!empty($valid)|| !empty($this->session->flashdata('login_error'))) {?>
	        <div class="slidingDiv" style="BACKGROUND-COLOR: #3333 ;" id="">
				<?php }else{?>
			
	        <div class="slidingDiv collapse navbar-collapse" style="BACKGROUND-COLOR: #3333 ;" id="slidingDiv">
			<?php }?>				

				<form action="<?php echo base_url(); ?>webadmin/payment/sort" id="form" method="post">
						<h4>اكتب الترتيب :</h4> <input type="text" id="sort" name="sort" value="" />
				<?php
				$valid = validation_errors();
				if (!empty($valid)) {?>
						<input type="hidden" id="payment_id" name="payment_id" value="<?php echo $payment_id ; ?>" />
				<?php }elseif (!empty($this->session->flashdata('login_error'))){?>
						<input type="hidden" id="payment_id" name="payment_id" value="<?php echo $this->session->flashdata('payment_id'); ?>" />
				<?php }else{?>
						<input type="hidden" id="payment_id" name="payment_id" value="" />
				<?php }?>
						<input type="submit" class="add_to_cart" value="رتب"/>
						<p><?php echo validation_errors(); ?></p>
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
					<form action="<?php echo base_url(); ?>webadmin/payment/do_sort" id="do_sort_form" method="post">
					</form>
					<form action="<?php echo base_url(); ?>webadmin/payment/do_operation" id="forn" method="post">
						<table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
							<thead>
								<tr>
									<th style="width:5%">#</th>
									<th class="w-50">اسم طريقة الدفع</th>
									<td class="w-25" style="background-color:#EEEEEE; padding: 4px;" class="no"><input type="checkbox" id="check_all" value="" /></th>
								</tr>
							</thead>
							<tbody>
							 <?php
								 if(!empty($payment)){
									for ($i = 0; $i < count($payment); $i++) {
										echo '<tr id="' . $payment[$i]->payment_id . '">';
										echo '<td class="align-center">' . $payment[$i]->payment_id . '</td>';
										echo '<td><a href="' . base_url() . 'webadmin/payment/edit/' . $payment[$i]->payment_id . '">' . $payment[$i]->name . '</a></td>';
										echo '<td>';
										echo '<input type="checkbox" name="chk[]" value="' . $payment[$i]->payment_id . '" />';
										echo '<a class="up" href="#" rel="' . $payment[$i]->payment_id  . '"><img border="0" src="' . base_url() . '/images/admin/navigate_up.png" width="20" height="20"></a>';
										echo '<a class="down" href="#" rel="' . $payment[$i]->payment_id  . '"><img border="0" src="' . base_url() . '/images/admin/navigate_down.png" width="20" height="20" ></a>';
										echo '<a class="navbar-toggler write p-0" href="#" rel="' . $payment[$i]->payment_id . '" data-toggle="collapse" data-target="#slidingDiv"><img border="0" src="' . base_url() . '/images/admin/k-write.png" width="20" height="20"></a>';
										echo '<a href="' . base_url() . 'webadmin/payment/edit/' . $payment[$i]->payment_id . '" title="تعديل"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
										echo '<a href="javascript:;" class="delete" title="حذف" rel="' . $payment[$i]->payment_id . '">';
										echo '<img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
										echo '</td>';
										echo '</tr>';
									}
								}else{
										echo '<tr >';
										echo '<td class="align-center"></td>';
										echo '<td><strong>لا يوجد طرق دفع حاليا</strong></td>';
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
								<select class="input-medium" id="acts" name="operation" style="width:auto;">
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
							
								$.post('<?php echo base_url(); ?>webadmin/payment/sort_up/'+$t,function(data){
								   });
							   row.insertBefore(row.prev());
									$("#do_sort_form").submit();
								
							});
							
							
							
							$('.down').click(function(){
							
								$('*').css('cursor', 'wait');
			 
								var row = $(this).parents("tr:first");
								var $t=$(this).attr('rel');
								$.post('<?php echo base_url(); ?>webadmin/payment/sort_down/'+$t,function(data){
								   });
								row.insertAfter(row.next());
									$("#do_sort_form").submit();
							});
												

							
							
							});


					$('.write').click(function(){
							
						var $t=$(this).attr('rel');
						document.getElementById("payment_id").value = $t;
							
									
							});
					</script>
</body>

</html>