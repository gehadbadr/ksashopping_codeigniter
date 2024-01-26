<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | صندوق الرسائل</title>
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
                            del=confirm('هل تريد حذف هذه الرسالة؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/inbox/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').length==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد رسائل حاليا</td></tr>');
                                    }
                                });
                            }
                        });
						$('#acts').click(function(){
                       // $("#acts").on('change',function(){
                            action=$(this).val();
                            if(action!="-1")
                            {
                                if($('[name="chk[]"]:checked').length=='0')
                                {
                                    alert("اختر عنصر واحد على الأقل");
                                }else{

                                    del=confirm('هل تريد اجراء هذة العملية علي الرسائل المختارة');
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
			<p class="top"  style="text-align:right;">صندوق الرسائل</p>
			<div class="module-body">																		
				<div class="module-table-body w-100">
					<form action="<?php echo base_url(); ?>webadmin/inbox/do_operation" id="forn" method="post">
						<table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
							<thead>
								<tr>
									<th style="width:5%">#</th>
									<th class="w-50">عنوان الرساله</th>
									<td class="w-25" style="background-color:#EEEEEE; padding: 4px;" class="no"><input type="checkbox" id="check_all" value="" /></th>
								</tr>
							</thead>
							<tbody>
							 <?php
								if(!empty($messages)){
									for ($i = 0; $i < count($messages); $i++) {
                                        echo '<tr id="' . $messages[$i]->message_id . '">';
										echo '<td class="align-center">' . $messages[$i]->message_id . '</td>';
										echo '<td><a href="' . base_url() . 'webadmin/inbox/show/' . $messages[$i]->message_id . '">' . $messages[$i]->title . '</a></td>';
										echo '<td>';
										echo '<input type="checkbox" name="chk[]" value="'.$messages[$i]->message_id.'" />';
										echo '<a href="' . base_url() . 'webadmin/inbox/show/' . $messages[$i]->message_id . '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
										echo '<a href="javascript:;" class="delete" rel="' . $messages[$i]->message_id . '"><img src="'.base_url().'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                        echo '</td>';
										echo '</tr>';
										}
									}else{
										echo '<tr >';
										echo '<td class="align-center"></td>';
										echo '<td><strong>لا يوجد رسائل حاليا</strong></td>';
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
</body>

</html>