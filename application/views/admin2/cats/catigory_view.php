<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
      <title>لوحة التحكم | الأقسام الرئيسية</title>
    </head>
    <body><table align="center" border="0" width="1000" cellpadding="0" cellspacing="0" dir="rtl">
            <tr>
                <td><table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                                <td>
                                    <table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0" dir="rtl">
                                        <tbody><tr>
                                                <td>

                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" dir="rtl">
                                                        <tbody><tr>
                                                                <td valign="top" width="100%" background="<?php echo base_url(); ?>images/admin/h-bg.gif">
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody><tr>
                                                                                <td class="adminTop" height="39">
                                                                                   <?php  $this->load->view('admin/includes/admin_top.php'); ?>   
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                        });
                        $("#check_all").live('click',function(){
                            if($(this).attr('checked')==true)
                            {
                                $("input[name=chk[]]").attr('checked',true);
                            }else{
                                $("input[name=chk[]]").attr('checked',false);
                            }
                        });
							/*$(".delete").live('click',function(){
									del=confirm('هل تريد حذف هذه التصنيف حقاً؟');
								if(del)
								{
							
							
							
							var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
								
							$.ajax({
							url: "<?php echo base_url();?>webadmin/catigory/delete",
						  type:'post',
						  data:"id="+$t,
						  success: function(){
							$('div #img-'+id).remove(); 
							
								
						  }
							});
	
								}
									});*/
                       $(".delete").live('click',function(){
                            del=confirm('هل تريد حذف هذه التصنيف حقاً؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/catigory/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').size()==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد تصنيفات حالياً</td></tr>');
                                    }
                                });
                            }
                        });
                        $("#acts").live('change',function(){
                            action=$(this).val();
                            if(action!="-1")
                            {
                                if($("input['name=chk[]']:checked").length==0)
                                {
                                    alert("اختر عنصر واحد على الأقل");
                                }else{

                                    del=confirm('هل تريد إجراء العملية على التصنيفات المختارة؟');
                                    if(del)
                                    {
                                        $('#forn').submit();
                                        $(this).val('-1');
                                    }
                                }
                            }
                        });
                    </script>
					
					<script type="text/javascript">
							$(document).ready(function(){
							
							$(".slidingDiv").hide(); 
                            							
							$(".write").show();    
							
							var sortInput = jQuery('#sort_order');
							var messageBox = jQuery('#message-box');
							var list = jQuery('#myTable');
							
							
							
							$('.write').click(function(){
							var $t=$(this).attr('rel');
							$(".slidingDiv").slideToggle();
                            $(".write").hide(); 
                            						
							
                            var row = $(this).parents("tr:first");
							
								    $("button:#Get").click(function () {
                                    $n=$('.input_gray').val();
									$('.cat_id').val($t);
                                    $('#msg').html($n);

							;
							 
									$("#form").submit();
									return true;
															
							});
								
							});
							
							$('.up1').click(function(){
							$('*').css('cursor', 'wait');
							var row = $(this).parents("tr:first");
							var $t=$(this).attr('rel');
							$.post('<?php echo base_url(); ?>webadmin/catigory/sort_up/'+$t,function(data){
                               });
							   row.insertBefore(row.prev());
									$("#forn").submit();
									return true;
								
							});
							
							$('.down1').click(function(){
							$('*').css('cursor', 'wait');
							var row = $(this).parents("tr:first");
							var $t=$(this).attr('rel');
							$.post('<?php echo base_url(); ?>webadmin/catigory/sort_down/'+$t,function(data){
                               });
							   row.insertAfter(row.next());
									$("#forn").submit();
									return true;
								
							});
												
							
							
							
							});
					</script>
                    <table dir="rtl" width="96%" align="center" border="0" cellpadding="0" cellspacing="0" height="70%">
                        <tr class="addCategory">
                            <td width="25%" valign="top" style="padding-top:45px" >
                                <link href="<?php echo base_url(); ?>css/jquery.treeview.rtl.css" rel="stylesheet" type="text/css"/>
                                <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.treeview.js"></script>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#browser").treeview({

                                        });
                                    });
                                </script>
                                <div class="module">
                                    <h2><span>القائمة الرئيسية</span></h2>
                                    <div class="module-body">
                                        <ul id="browser" class="filetree treeview-famfamfam">
                                            <?php $this->load->view('admin/includes/control_panel.php'); ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="75%" valign="top" align="right" style="padding-right: 5px;">


                                                                        <div class="bottom-spacing">

                                                                            <!-- Button -->
                                                                            <div class="float-left">

                                                                                <a class="button" href="<?php echo base_url(); ?>webadmin/catigory/add/">
                                                                                    <span>تصنيف جديد <img height="9" width="12" alt="New article" src="<?php echo base_url(); ?>images/admin/plus-small.gif"/></span>
                                                                                </a>
                                                                            </div>

                                                                            <div style="clear:both"></div>
                                                                        </div>
                                                                        <div class="module">
                                                                            <h2><span>الاقسام</span></h2>
																			<div class="slidingDiv" style="BACKGROUND-COLOR: #6BD091 ;">
																				<form action="<?php echo base_url(); ?>webadmin/catigory/sort" id="form" method="post">

																				
																					<h4>اكتب الترتيب :</h4> <input type="text" class="input_gray" name="sort" value="" />
																											 <input type="hidden" class="cat_id" name="cat_id" value="" />
																					<button id="Get">رتب</button>
																					   
																					<p><?php echo validation_errors(); ?></p>
																				</form>
																			</div>
                                                                            <div class="module-table-body">
                                                                                <form action="<?php echo base_url(); ?>webadmin/catigory/do_operation" id="forn" method="post" >
                                                                                    <table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th style="width:5%">#</th>
                                                                                                <th style="width:30%">عنوان التصنيف</th>
                                                                                                <td style="width:10%" class="no"><input type="checkbox" id="check_all" value="" /></th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                    <tbody>
																			<?php 
																				if(!empty($cats)){
													                                for ($i = 0; $i < count($cats); $i++) {
                                                                                        echo '<tr id="' . $cats[$i]->cat_id . '">';
                                                                                        echo '<td class="align-center">' . $cats[$i]->cat_id . '</td>';
																						echo '<td><a href="' . base_url() . 'webadmin/catigory/edit/' . $cats[$i]->cat_id . '">' . $cats[$i]->name . '</a></td>';
                                                                                        echo '<td>';
                                                                                        echo '<input type="checkbox" name="chk[]" value="' . $cats[$i]->cat_id . '" />';
                                                                                        echo '<a class="up1" href="#" rel="' . $cats[$i]->cat_id . '"><img border="0" src="' . base_url() . '/images/admin/navigate_up.png" width="20" height="20"></a>';
                                                                                        echo '<a class="down1" href="#" rel="' . $cats[$i]->cat_id . '"><img border="0" src="' . base_url() . '/images/admin/navigate_down.png" width="20" height="20" ></a>';
																						echo '<a class="write" href="#" rel="' . $cats[$i]->cat_id . '"><img border="0" src="' . base_url() . '/images/admin/k-write.png" width="20" height="20"></a>';
																						echo '<a href="' . base_url() . 'webadmin/catigory/edit/' . $cats[$i]->cat_id . '" title="تعديل"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
                                                                                        echo '<a href="javascript:;" class="delete" title="حذف" rel="' . $cats[$i]->cat_id . '">';
                                                                                        echo '<img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                                                                        echo '</td>';
                                                                                        echo '</tr>';
                                                                                    }
																				}else{
																					 echo '<tr >';
																					 echo '<td class="align-center"></td>';
																					 echo '<td><strong>لا يوجد تصنيفات حاليا</strong></td>';
																					 echo '<td>';
																					 echo '</td>';
																					 echo '</tr>';
																				}							
																																									
																			?>
													<input type="hidden" name="sort_order" id="sort_order" value="1,2" />

                                                </tbody>
                                            </table>
											<div class="align-center">
											<?php echo $this->pagination->create_links(); ?>
											</div><!-- .pagnation -->
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
									    <div style="clear: both"></div>
                                    </div> <!-- End .module-table-body -->
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php  $this->load->view('admin/includes/footer.php'); ?>   

                </td>
            </tr>
        </table>
    </body>
</html>