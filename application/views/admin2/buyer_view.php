<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <?php include 'includes/head.php'; ?>

        <title>لوحة التحكم | المشتريون</title>

    </head>

    <body>

        <table align="center" border="0" width="1000" cellpadding="0" cellspacing="0" dir="rtl">

            <tr>

                <td>

                    <table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0">

                        <tbody>

                            <tr>

                                <td>

                                    <table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0" dir="rtl">

                                        <tbody>

                                            <tr>

                                                <td>

                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" dir="rtl">

                                                        <tbody>

                                                            <tr>

                                                                <td valign="top" width="100%" background="<?php echo base_url() ;?>images/admin/h-bg.gif">

                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">

                                                                        <tbody>

                                                                            <tr>

                                                                                <td class="adminTop" height="39">

                                                                                    <?php include 'includes/admin_top.php'; ?>

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

                        </tbody></table><script type="text/javascript">

                            $(document).ready(function() {

                                $("#myTable")

                                .tablesorter({

                                    // zebra coloring

                                    widgets: ['zebra'],

                                    // pass the headers argument and assing a object

                                    headers: {

                                        // assign the sixth column (we start counting zero)

                                        2: {

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

                                del=confirm('هل تريد حذف هذا العميل حقا؟');

                                if(del)

                                {

                                    var $t=$(this).attr('rel');

                                    var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url() ;?>images/admin/loadingAnimation.gif"/></td>';

                                    $('tr#'+$t).html($v);

                                    $.post('<?php echo base_url() ;?>webadmin/buyers/delete/'+$t,function(data){

                                        $('tr#'+$t).remove();

                                        if($('#myTable > tbody > tr').size()==0)

                                        {

                                            $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد مستخدمين حالياً</td></tr>');

                                        }

                                    });

                                }

                            });
							
                          

                            $('.block').live('click',function(){
							var $t=$(this).attr('rel');
							$.post('<?php echo base_url(); ?>webadmin/buyers/block/'+$t,function(data){
                               });
							   
									$("#forn").submit();
									return true;
								
							});
							
							 $('.confirm').live('click',function(){
							var $t=$(this).attr('rel');
							$.post('<?php echo base_url(); ?>webadmin/confirm_buyer/confirm/'+$t,function(data){
                               });
							   
									$("#forn").submit();
									return true;
								
							});
							

                            $("#acts").live('change',function(){

                                action=$(this).val();

                                if(action!="-1")

                                {

                                    if($("input['name=chk[]']:checked").length==0)

                                    {

                                        alert("اختر عنصر واحد على الأقل");

                                    }else{



                                        del=confirm('هل تريد إجراء العملية على العملاء المختارين؟');

                                        if(del)

                                        {

                                            $('#forn').submit();

                                            $(this).val('-1');

                                        }

                                    }

                                }

                            });

                    </script>

                    <table dir="rtl" width="96%" align="center" border="0" cellpadding="0" cellspacing="0" height="70%">

                        <tr class="addCategory">

                            <td width="25%" valign="top" style="padding-top:45px" >

                                <link href="<?php echo base_url() ;?>css/jquery.treeview.rtl.css" rel="stylesheet" type="text/css"/>

                                <script type="text/javascript" src="<?php echo base_url() ;?>js/jquery.treeview.js"></script>

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

                                            <?php include 'includes/control_panel.php'; ?>

                                                                                </ul>

                                                                            </div>

                                                                        </div>

                                                                    </td>

                                                                    <td width="75%" valign="top" align="right" style="padding-right: 5px;">

                                                                        <div class="bottom-spacing">

                                                                           

                                                                            <div class="float-left" style="min-height:25px;">

                                                                            <!--    <a class="button" href="<?php echo base_url() ;?>webadmin/buyers/add">

                                                                                    <span>عميل جديد<img height="9" width="12" alt="New article" src="<?php echo base_url() ;?>images/admin/plus-small.gif"/></span>

                                                                                </a>-->
																				

                                                                            </div>

                                                                            <div style="clear:both"></div>

                                                                        </div>

                                                                        <div class="module">

                                                                            <h2><span>المشترون</span></h2>

                                                                            <div class="module-table-body">

                                                                                <form action="<?php echo base_url() ;?>webadmin/<?php if(!empty($buyers)){ echo 'buyers';}else { echo 'confirm_buyer';}?>/do_operation" id="forn" method="post">

                                                                                    <table width="99%" class="tablesorter" id="myTable" style="background-position:center;">

                                                                                        <thead>

                                                                                            <tr>

                                                                                                <th style="width:5%">#</th>

                                                                                                <th style="width:30%">اسم العميل</th>

                                                                                                <?php if(!empty($buyers)){ 
																								
																								echo '<th style="width:30%">العضوية</th>';
																								} ?>
																								<td style="width:10%" class="no"><input type="checkbox" id="check_all" value="" /></th>
                                                                                                
																								

                                                                                            </tr>

                                                                                        </thead>

                                                                                        <tbody>

                                                    <?php
                                                                                if(!empty($buyers)){
                                                                                    for ($i = 0; $i < count($buyers); $i++) {

                                                                                        echo '<tr id="' . $buyers[$i]->buyer_id . '">';

                                                                                        echo '<td class="align-center">' . $buyers[$i]->buyer_id . '</td>';

                                                                                        echo '<td><a href="' . base_url() . 'webadmin/buyers/edit/' . $buyers[$i]->buyer_id . '">' . $buyers[$i]->fname.' '.$buyers[$i]->lname . '</a></td>';

                                                                                        echo '<td>';

																						if($buyers[$i]->authority == 0){
																						$text='موقوف';
																						}elseif($buyers[$i]->authority == 1){
																						$text='عادية';
																						}elseif($buyers[$i]->authority == 2){
																						$text='ذهبية';
																						}
                                                                                        
                                                                                        echo '<a href="'.base_url().'webadmin/buyers/edit/'.$buyers[$i]->buyer_id.'">' . $text . '</a></td>';
																						
																						echo '<td><input type="checkbox" name="chk[]" value="' . $buyers[$i]->buyer_id  . '" />';
                                                                                        
																						echo '<a href="' . base_url() . 'webadmin/buyers/edit/' . $buyers[$i]->buyer_id . '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
                                                                                       
																					   if($buyers[$i]->authority == 0){
																					   
																	                   echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
 
                                                                                        }else{
																						echo '&nbsp;<a href="javascript:;" class="block" rel="' . $buyers[$i]->buyer_id . '"><img src="' . base_url() . 'images/admin/notification-slash.gif"  width="16" height="16" alt="block" /></a>';
 
                                                                                        }

                                                                                        echo '&nbsp;<a href="javascript:;" class="delete" rel="' . $buyers[$i]->buyer_id . '"><img src="'.base_url().'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                                                                        
																						

                                                                                        echo '</td>';

                                                                                        echo '</tr>';

                                                                                    }
																				}
																				if(!empty($confirm_buyer)){
                                                                                    for ($i = 0; $i < count($confirm_buyer); $i++) {

                                                                                        echo '<tr id="' . $confirm_buyer[$i]->buyer_id . '">';

                                                                                        echo '<td class="align-center">' . $confirm_buyer[$i]->buyer_id . '</td>';

                                                                                        echo '<td><a href="' . base_url() . 'webadmin/buyers/edit/' . $confirm_buyer[$i]->buyer_id . '">' . $confirm_buyer[$i]->fname.' '.$confirm_buyer[$i]->lname . '</a></td>';

                                                                                       																
																						echo '<td><input type="checkbox" name="chk[]" value="' . $confirm_buyer[$i]->buyer_id  . '" />';
                                                                                        
																						echo '<a href="' . base_url() . 'webadmin/buyers/edit/' . $confirm_buyer[$i]->buyer_id . '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
                                                                                       
																					  
																						echo '&nbsp;<a href="javascript:;" class="confirm" rel="' . $confirm_buyer[$i]->buyer_id . '"><img src="' . base_url() . 'images/admin/tick-circle.gif"  width="16" height="16" alt="confirm" /></a>';
 

                                                                                        echo '&nbsp;<a href="javascript:;" class="delete" rel="' . $confirm_buyer[$i]->buyer_id . '"><img src="'.base_url().'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                                                                        
																						

                                                                                        echo '</td>';

                                                                                        echo '</tr>';

                                                                                    }
																				}	  

                                                    ?> 

                                                </tbody>

                                            </table>
											<div class="align-center">
											<?php echo $this->pagination->create_links(); ?>
											</div><!-- .pagnation -->

                                            <div class="table-apply">

                                                <div>

                                                    <span>اختار عملية ليتم تطبيقها على الذى تم اختياره:</span>

                                                    <select class="input-medium" id="acts" name="operation">

                                                        <option value="-1" selected="selected">اختار عملية </option>

                                                        <option value="delete">حذف</option>
                                                        
                                                    </select>

                                                </div>

                                            </div>

                                        </form>

                                        <div style="clear: both"></div>

                                    </div> <!-- End .module-table-body -->

                                </div>

                            </td>

                        </tr>

                    </table>

                    <table align="center" width="100%">

                        <tr>

                            <td colspan="11" align="center" style="padding-top:5px">

  		Copyright © 2011 <a href="http://2windesign.com/" target="_blank">2win Design Company</a> All Rights Reserved

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

        </table>

    </body>

</html>