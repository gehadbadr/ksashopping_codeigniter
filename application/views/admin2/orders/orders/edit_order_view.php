<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
        <title>لوحة التحكم  | الطلبات</title>
        <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
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
                                                                <td valign="top" width="100%" background="<?php echo base_url(); ?>images/admin/h-bg.gif">
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
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

                                del=confirm('هل تريد حقا حذف هذا الجزء؟');

                                if(del)

                                {

                                    var $t=$(this).attr('rel');

                                    var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';

                                    $('tr#'+$t).html($v);

                                    $.post('<?php echo base_url(); ?>webadmin/part/delete/'+$t,function(data){

                                        $('tr#'+$t).remove();

                                        if($('#myTable > tbody > tr').size()==0)

                                        {

                                            $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد أى بريد إلكترونى</td></tr>');

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

                                        alert("لابد من اختيار عنصر واحد على الأقل");

                                    }else{



                                        del=confirm('هل تريد إجراء هذه العملية');

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
                                                                    <td width="75%" valign="top" align="right" style="padding-right: 5px;padding-top:45px;">
                                                                        <div class="module">
                                                                            <h2><span>مشاهدة الطلب</span></h2>
                                                                            <form action="<?php echo base_url(); ?>webadmin/order/edit/<?php echo $this_message[0]->order_id ;?>" method="post" >
                                                                                <div class="module-body">
																				<p><b><?php echo validation_errors(); ?></b></p>
                                                                                    <p><?php $data["buyer"] = $this->buyer_model->GetbuyerByID($this_message[0]->buyer_id_fk);
																					$fname= str_replace(" ", "-", $data['buyer'][0]->fname);
																					$lname= str_replace(" ", "-", $data['buyer'][0]->lname);
																					$fullname = $fname."-".$lname;?>
                                                                                        <label>الاسم </label>
                                                                                        <a href="<?php echo base_url(); ?>buyer/profile/<?php echo $data["buyer"][0]->buyer_id ;?>/<?php echo $fullname  ;?>" target="_blank" ><?php echo $data["buyer"][0]->fname.' '.$data["buyer"][0]->lname ;?></a>
                                                                                    </p>
																					<p>
                                                                                        <label>البريد الالكتروني</label>
                                                                                        <?php echo $data["buyer"][0]->email  ;?>
                                                                                    </p>
																					<p>
                                                                                        <label>الجوال</label>
                                                                                        <?php echo $data["buyer"][0]->mobile ;?>
                                                                                    </p>
																				<!-- 	 <p>
																						<label><b>الدولة</b></label>
																						<?php if ($data["buyer"][0]->country_id_fk!='0'){
																						$data["country"] = $this->admin_model->GetcountryByID($data["buyer"][0]->country_id_fk);
																						echo'<label>'.$data["country"][0]->name.'</label>';
																						}else{echo'<label>غير معروف</label>';}
																						?>
																						
																						
																				   </p>
																					<p>
                                                                                        <label>المدينة</label>
                                                                                       <?php if ($data["buyer"][0]->city_id_fk!='0'){
																							$data["city"] = $this->admin_model->GetcityByID($data["buyer"][0]->city_id_fk);
																							echo'<label>'.$data["city"][0]->name.'</label>';
																							}else{echo'<label>غير معروف</label>';}?>
                                                                                    </p> -->
																					<p>
                                                                                        <label>الحي</label>
                                                                                        <textarea id="editor" name="address" rows="4" cols="60" style="width: 60%"><?php echo $this_message[0]->address  ;?>"</textarea>
                                                                                    </p>
																					
																					<p>
																						<label>المنتجات</label>
																						<?php $data['details']=$this->orders->GetorderuserID($this_message[0]->order_id);
																						for ($i = 0; $i < count($data['details']); $i++){
																																														
																							$user=$this->user_model->GetuserByID($data['details'][$i]->user_id_fk);
																							$username= str_replace(" ", "-",$user[0]->username);
																							echo'<a href="'.base_url().'user/profile/'. $user[0]->user_id .'/'. $username .'" target="_blank"><strong>'.$user[0]->username.'   </strong></a>';
																							echo'<br/>';
																							echo'<br/>';
																							
																							
																							$sum=0;
																							$data['content']=$this->orders->GetordersdetailsByuserID($data['details'][$i]->user_id_fk,$this_message[0]->order_id);
																							for ($x = 0; $x < count($data['content']); $x++){
																							if($data['content'][$x]->statue==1){
																							     echo'<p style="background:#E5E5E5;color:#a10000;">';
																								  echo'<strong>تم الغاء ما يخص  العضو '.$user[0]->username.' في هذا الطلب</strong>';
																								    echo'<br />';
																								 echo'<strong>'.$data['content'][$x]->name.'   </strong>';
																								 echo'<br/>';
																								 $number = $data['content'][$x]->price ;
																								 $price = str_replace(",", "", $number);
																								 $qty = $data['content'][$x]->qty;
																								 $total = $price * $qty;
																								 echo'العدد : &nbsp;'.$data['content'][$x]->qty.'&nbsp;&nbsp;&nbsp;سعر القطعة : '.$price .'  ريال&nbsp;&nbsp;&nbsp; الاجمالي : '.$this->cart->format_number($total).'&nbsp;ريال';
																								 echo'<br/>';
																								 $sum = $sum + $total;
																							     echo'</p>';
																							 }else{
																								 echo'<strong>'.$data['content'][$x]->name.'   </strong>';
																								 echo'<br/>';
																								 $number = $data['content'][$x]->price ;
																								 $price = str_replace(",", "", $number);
																								 $qty = $data['content'][$x]->qty;
																								 $total = $price * $qty;
																								 echo'العدد : &nbsp;'.$data['content'][$x]->qty.'&nbsp;&nbsp;&nbsp;سعر القطعة : '.$price .'  ريال&nbsp;&nbsp;&nbsp; الاجمالي : '.$this->cart->format_number($total).'&nbsp;ريال';
																								 echo'<br/>';
																								 $sum = $sum + $total;
																							 }}
																							 if($data['details'][$i]->statue==1){
																							 echo'<br/>';
																							 echo'<p style="background:#E5E5E5;color:#a10000;">';
																							 echo'<strong> الاجمالي : '.$this->cart->format_number($sum).' ريال </strong>';
																							 echo'</p>';
																							 echo'<br/>';
																							 echo'<br/>';
																							  }else{
																							  echo'<br/>';
																							 echo'<strong> الاجمالي : '.$this->cart->format_number($sum).' ريال </strong>';
																							 echo'<br/>';
																							 echo'<br/>';
																							 }
																						}
																						?>
																				    </p>
																					<p>
																						<label>الاجمالي</label>
																						<textarea id="editor" name="total" rows="4" cols="60" style="width: 60%"><?php echo $this_message[0]->total ;?></textarea>
                                                                                	</p>
																					<p>
																						<label>ملاحظات عن العميل</label>
																						<textarea id="editor" name="notes" rows="4" cols="60" style="width: 60%"><?php echo $this->admin_model->bb2html($this_message[0]->notes) ;?></textarea>
																					   
																					</p>
																					
										<!--                                            <p>
																						<label>صور المنتج</label>
																						<input type="file"  name="photo[]" size="35"  id="mui"   /><br />
																						<p style="color:#686868; margin:0; margin-top:-10px;">يمكنك إضافة حتى 4 صورة نوع jpg أو gif أو png</p>
																					</p>-->
																					<p>
																						<input type="submit" value="تعديل" class="submit-green"/>
																						<input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/order';" />
																					</p>
                                                                        </div>
                                                                    </form>
                                                                   
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