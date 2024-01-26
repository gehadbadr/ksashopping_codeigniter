<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>لوحة التحكم | المنتجات</title>
    </head>
    <body><table align="center" border="0" width="1000" cellpadding="0" cellspacing="0" dir="rtl">
            <tr>
                <td><table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0">
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
                                                                <td valign="top" width="100%" background="<?php echo  base_url(); ?>images/admin/h-bg.gif">
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="adminTop" height="39">
                                                                                    <?php include 'includes/admin_top.php';?>
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
                            del=confirm('هل تريد حذف هذه المنتج حقاً؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo  base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo  base_url(); ?>webadmin/product/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').size()==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد منتجات حالياً</td></tr>');
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
                                    del=confirm('هل تريد اجراء هذة العملية علي المنتجات المختارة؟');
                                    if(del)
                                    {
                                        $('#forn').submit();
                                        $(this).val('-1');
                                    }
                                }
                            }
                        });
						
						
						
						function goto(form) { var index=form.cat_id.selectedIndex
                        if (form.cat_id.options[index].value != "0") {
                        location=form.cat_id.options[index].value;}}

						
						
						
					/*	$("#scode").live('click',function(){
                           $n=$('#yy').val();
								$.post('<?php echo  base_url(); ?>webadmin/product/<?php echo $webadmin_id;?>/scode/'+$n,function(data){
                                    
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوج<?php echo $scode[0]->name;?>د منتجات حالياً</td></tr>');
                                    
                        });*/
						
						
                    </script>
					
					
					
					
                    <table dir="rtl" width="96%" align="center" border="0" cellpadding="0" cellspacing="0" height="70%">

                        <tr class="addCategory">



                            <td width="25%" valign="top" style="padding-top:45px" >
                                <link href="<?php echo  base_url(); ?>css/jquery.treeview.rtl.css" rel="stylesheet" type="text/css"/>
                                <script type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.treeview.js"></script>
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
                                            <?php include 'includes/control_panel.php';?>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td width="75%" valign="top" align="right" style="padding-right: 5px;">
                                <div class="bottom-spacing" style="min-height:25px;">
                                    
                                    <div class="float-left" >
                                       <!-- <a class="button" href="<?php echo  base_url(); ?>webadmin/product/add">
                                            <span>منتج جديد <img height="9" width="12" alt="New article" src="<?php echo  base_url(); ?>images/admin/plus-small.gif"></span>
                                        </a>-->
                                    </div>
									<!--<div>
									 <form action="<?php echo  base_url(); ?>webadmin/cat/do_operation" id="fcate" method="post">
                                            <?php if(!empty($cat_id)){
									  echo'
                                             <input type="hidden" class="he" name="tt" value="' .base_url().'webadmin/cat/cat/'.$cat_id.'" />										
											
											 <input type="hidden" class="er" name="" value="' .$cat_id.'" />';}?>											
											<select name="cat_id" class="input-medium" style="width:auto;" id="cat" ONCHANGE="goto(this.form)">
                                                <option value="">اختار التصنيف</option>
                                                    <?php
                                                       for ($i = 0; $i < count($cats); $i++) {
                                                         if ($this_product[0]->cat_id_fk == $cats[$i]->cat_id) {
                                                            echo "<option value='" .base_url()."webadmin/cat/cat/". $cats[$i]->cat_id . "' selected=''>" . $cats[$i]->name . "</option>";
                                                         } else {
                                                            echo "<option value='" .base_url()."webadmin/cat/cat/".$cats[$i]->cat_id . "'>" . $cats[$i]->name . "</option>";
                                                         }
                                                       }
                                                    ?>
                                                   </select>
                                    </form>
									<form action="<?php echo  base_url(); ?>webadmin/scode/scode" id="fornm" method="post">
                                      <span>  ادخل كود المنتج الذي تريد البحث عنه : </span>
								
                                             <input type="text" name="scode" size="3" value="" id="yy" /></b>
                                             <input type="submit" value="بحث" class="submit-green" id="scode" />
											 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											 <p><?php echo validation_errors(); ?></p>
											</form>
									
								  </div>
                                    <div style="clear:both"></div>-->
                                </div>
								
                                <div class="module">
                                    <h2><span>المنتجات الخاصة بالعميل <?php echo $this_user[0]->username;?></span></h2>
                                    <div class="module-table-body">
                                        <form action="<?php echo  base_url(); ?>webadmin/product/do_operation" id="forn" method="post">
                                            <table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">#</th>
                                                        <th style="width:30%">عنوان المنتج</th>
                                                        <td style="width:10%" class="no"><input type="checkbox" id="check_all" value="" /></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
													
													if(!empty($catt)){
													
													if(!empty($products)){
												
                                                    for($i=0;$i<count($products);$i++){
                                                        echo '<tr id="' . $products[$i]->product_id . '">';
                                                        echo '<td class="align-center">' . $products[$i]->product_id . '</td>';
                                                        echo '<td><a href="' .  base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '">' .  $products[$i]->name . '</a></td>';
                                                        echo '<td>';
                                                        echo '<input type="checkbox" name="chk[]" value="' . $products[$i]->product_id . '" />';
                                                        echo '<a class="up1" href="#" rel="' . $products[$i]->product_id . '"><img border="0" src="' . base_url() . '/images/admin/navigate_up.png" width="20" height="20"></a>';
                                                        echo '<a class="down1" href="#" rel="' . $products[$i]->product_id . '"><img border="0" src="' . base_url() . '/images/admin/navigate_down.png" width="20" height="20" ></a>';
														echo '<a class="up2" href="#" rel="' . $products[$i]->product_id . '"><img border="0" src="' . base_url() . '/images/admin/k-write.png" width="20" height="20"></a>';
														echo '<a href="' . base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
                                                        echo '<a href="javascript:;" class="delete" rel="' . $products[$i]->product_id . '"><img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                                        echo '</td>';
                                                        echo '</tr>';
													

                                                    }}else{
													   echo '<tr >';
													   echo '<td class="align-center"></td>';
                                                        echo '<td><strong>لا يوجد منتجات</strong></td>';
                                                        echo '<td>';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                    
                                                      
                                                      
                                                    }}else{if(!empty($products)){
												
                                                    for($i=0;$i<count($products);$i++){
                                                        echo '<tr id="' . $products[$i]->product_id . '">';
                                                        echo '<td class="align-center">' . $products[$i]->product_id . '</td>';
                                                        echo '<td><a href="' .  base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '">' .  $products[$i]->name . '</a></td>';
                                                        echo '<td>';
                                                        echo '<input type="checkbox" name="chk[]" value="' . $products[$i]->product_id . '" />';
                                                        echo '<a href="' . base_url() . 'webadmin/product/edit/' . $products[$i]->product_id . '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
                                                        echo '<a href="javascript:;" class="delete" rel="' . $products[$i]->product_id . '"><img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                    }}else{
													    echo '<tr >';
													   echo '<td class="align-center"></td>';
                                                        echo '<td><strong>لا يوجد منتجات</strong></td>';
                                                        echo '<td>';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                    
                                                      
                                                      
                                                    }}
                                                    ?>
                                                </tbody>
                                            </table>
											<div class="align-center">
											<?php echo $this->pagination->create_links(); ?>
											</div><!-- .pagnation -->
<!--                                            <div class="pagination">
                                                <span class="current">1</span>&nbsp;<a href="<?php echo  base_url(); ?>webadmin/product/<?php echo $webadmin_id;?>/index/10">2</a>
                                                <div class="button">
                                                    <span>
                                                        <img height="9" width="12" alt="Next"  style="float:right;" src="<?php echo  base_url(); ?>images/admin/arrow-000-small.gif"/>
                                                        <a href="<?php echo  base_url(); ?>webadmin/product/<?php echo $webadmin_id;?>/index/10">التالى</a>
                                                    </span>
                                                </div><div style="clear: both;">
                                                </div>
                                            </div>-->
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
                    <table align="center" width="100%">
                        <tr>
                            <td colspan="11" align="center" style="padding-top:5px">Copyright © 2011 <a href="http://2windesign.com/" target="_blank">2win Design Company</a> All Rights Reserved</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>