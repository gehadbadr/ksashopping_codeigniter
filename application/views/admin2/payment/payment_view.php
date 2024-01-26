<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
        <title>لوحة التحكم | طرق الدفع</title>
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
                        $(".delete").live('click',function(){
                            del=confirm('هل تريد حذف هذة الطريقة؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/payment/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').size()==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد طرق للدفع حاليا</td></tr>');
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

                                    del=confirm('هل تريد اجراء هذة العملية علي طرق الدفع المختارة');
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
							$("body").css("cursor", "auto");
							$(".slidingDiv").hide(); 
                            							
							$(".write").show();  

							var sortInput = jQuery('#sort_order');
							var messageBox = jQuery('#message-box');
							var list = jQuery('#myTable');
							
							$('.up1').click(function(){
							   $('*').css('cursor', 'wait');

							var row = $(this).parents("tr:first");
							var $t=$(this).attr('rel');
							
							$.post('<?php echo base_url(); ?>webadmin/payment/sort_up/'+$t,function(data){
                               });
							   row.insertBefore(row.prev());
									$("#forn").submit();
									return true;
								
							});
							
							$('.write').click(function(){
							
							var $t=$(this).attr('rel');
							$(".slidingDiv").slideToggle();
                            $(".write").hide(); 
                            						
							
                            var row = $(this).parents("tr:first");
							
								    $("button:#Get").click(function () {
                                    $n=$('.input_gray').val();
									$('.payment_id').val($t);
                                    $('#msg').html($n);

							;
							   

									$("#form").submit();
									return true;
															
							});
								
							});
							
							$('.down1').click(function(){
							
                            $('*').css('cursor', 'wait');
         
							var row = $(this).parents("tr:first");
							var $t=$(this).attr('rel');
							$.post('<?php echo base_url(); ?>webadmin/payment/sort_down/'+$t,function(data){
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

                                                                                <a class="button" href="<?php echo base_url(); ?>webadmin/payment/add/">
                                                                                    <span>طريقة دفع جديدة <img height="9" width="12" alt="New article" src="<?php echo base_url(); ?>images/admin/plus-small.gif"/></span>
                                                                                </a>
                                                                            </div>

                                                                            <div style="clear:both"></div>
                                                                        </div>
                                                                        <div class="module">
                                                                            <h2><span>طرق الدفع</span></h2>
																			<div class="slidingDiv" style="BACKGROUND-COLOR: #6BD091 ;">
																				<form action="<?php echo base_url(); ?>webadmin/payment/sort" id="form" method="post">

																				
																					<h4>اكتب الترتيب :</h4> <input type="text" class="input_gray" name="sort" value="" />
																											 <input type="hidden" class="payment_id" name="payment_id" value="" />
																					<button id="Get">رتب</button>
																					   
																					<p><?php echo validation_errors(); ?></p>
																				</form>
																			</div>
                                                                            <div class="module-table-body">
																				
										
                                                                                <form action="<?php echo base_url(); ?>webadmin/payment/do_operation" id="forn" method="post">
                                                                                    <table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th style="width:5%">#</th>
                                                                                                <th style="width:30%">عنوان طريقة الدفع</th>
                                                                                                

                                                                                                <td style="width:10%" class="no"><input type="checkbox" id="check_all" value="" /></th>
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
                                                                                        echo '<a class="up1" href="#" rel="' . $payment[$i]->payment_id  . '"><img border="0" src="' . base_url() . '/images/admin/navigate_up.png" width="20" height="20"></a>';
                                                                                        echo '<a class="down1" href="#" rel="' . $payment[$i]->payment_id  . '"><img border="0" src="' . base_url() . '/images/admin/navigate_down.png" width="20" height="20" ></a>';
																						echo '<a class="write" href="#" rel="' . $payment[$i]->payment_id . '"><img border="0" src="' . base_url() . '/images/admin/k-write.png" width="20" height="20"></a>';
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
										
                                        <div style="clear: both"></div>
										<div class="align-center">
											<?php echo $this->pagination->create_links(); ?>
											</div><!-- .pagnation -->
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