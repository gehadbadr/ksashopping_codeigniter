<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>لوحة التحكم | تعديل عميل</title>
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
                        </tbody>
                    </table>
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
                            <td width="75%" valign="top" align="right" style="padding-right: 5px;padding-top:45px;">
                                <div class="module">
                                    <h2><span>تعديل عميل</span></h2>
                                    
                                    
                                    <form action="<?php echo base_url();?>webadmin/users/edit/<?php echo $this_user[0]->user_id ;?>" method="post" enctype="multipart/form-data">
                                        <div class="module-body">
										<p><b><?php echo validation_errors(); ?></b></p>
                                            <p>
                                                <label><b>اسم المتجر</b></label>
												<label><?php echo $this_user[0]->username;?></label>
                                             </p>
                                            

                                            <p>
                                                <label><b>الايميل</b></label>
												<label><?php echo $this_user[0]->email;?></label>
                                           </p>
										   
										   <p>
                                                <label><b>تليفون</b></label>
												<label><?php echo $this_user[0]->mobile;?></label>
                                           </p>
										  
										   <p>
                                                <label><b>الدولة</b></label>
												<?php if ($this_user[0]->country_id_fk!='0'){
												$data["country"] = $this->admin_model->GetcountryByID($this_user[0]->country_id_fk);
												echo'<label>'.$data["country"][0]->name.'</label>';
												}else{echo'<label>غير معروف</label>';}
												?>
												
												
                                           </p>
										   <p>
                                                <label><b>المدينة</b></label>
												<?php if ($this_user[0]->city_id_fk!='0'){
												$data["city"] = $this->admin_model->GetcityByID($this_user[0]->city_id_fk);
												echo'<label>'.$data["city"][0]->name.'</label>';
												}else{echo'<label>غير معروف</label>';}
												?>
												
                                           </p>
										   <p>
                                                <label><b>العنوان الرئيسي</b></label>
												<label><?php echo $this->admin_model->bb2html($this_user[0]->address);?></label>
                                           </p>
											<?php if (!empty($phone)) {
											if (count($phone)==1) {
											?>
													<p>
														<label width="125"><b>التليفون:</b></label>
													 
													   <label> <?php echo $phone[0]->phone;?></label>
													   
																								
													</p>
													<?php 
											}else {
											?>
											<?php $n=1; for ($i = 0; $i < count($phone); $i++) {?> 
													<p>
														<label width="125"><b>التليفون <?php echo $n;?> :</b></label>
													 
													   <label> <?php echo $phone[$i]->phone;?></label>
													   
																								
													</p>
													<?php $n++;}?> 
											 <?php }}else{ ?>		
													<p>
														<label width="125"><b>التليفون:</b></label>
													  
													   <label>لا يوجد تليفون</label>
													   
																								
													</p>
											<?php }?>
											<?php if (!empty($branch)) {
											if (count($branch)==1) {
											?>
													<p>
														<label width="125"><b>الفرع:</b></label>
													 
													   <label> <?php echo $this->admin_model->bb2html($branch[0]->branch);?></label>
													   
																								
													</p>
													<?php 
											}else {
											?>
											<?php $n=1; for ($i = 0; $i < count($branch); $i++) {?> 
													<p>
														<label width="125"><b>الفرع <?php echo $n;?> :</b></label>
													 
													   <label> <?php echo $this->admin_model->bb2html($branch[$i]->branch);?></label>
													   
																								
													</p>
													<?php $n++;}?> 
											 <?php }}else{ ?>		
													<p>
														<label width="125"><b>الفرع:</b></label>
													  
													   <label>لا يوجد فروع اخري</label>
													   
																								
													</p>
											<?php }?>				
										   
										   <p>
                                                <label><b>الوصف</b></label>
												<label><?php echo $this->admin_model->bb2html($this_user[0]->content);?></label>
                                           </p>
										   <p>
                                                <label><b> اللوجو</b></label>
												<label><img src="<?php echo base_url() ;?><?php echo $this_user[0]->path;?>" width="100" height="100" /></label>
                                           </p>
										   
										   <p>
                                                <label><b> منتجات العميل</b></label>
												<label><a href="<?php echo base_url(); ?>webadmin/users/show_product/<?php echo $this_user[0]->user_id ;?>" target="_blank"> اضغط هنا لرؤية منتجات العميل</a><label>
                                           </p>
										   <p>
                                                <label><b>طرق الدفع الخاصة بالعميل</b></label>
												<label><a href="<?php echo base_url(); ?>webadmin/users/show_payment/<?php echo $this_user[0]->user_id ;?>" target="_blank"> اضغط هنا لرؤية طرق الدفع الخاصة بالعميل</a><label>
                                           </p>
										   <p>
                                                <label><b>العروض الخاصة بالعميل</b></label>
												<label><a href="<?php echo base_url(); ?>webadmin/users/show_offer/<?php echo $this_user[0]->user_id ;?>" target="_blank"> اضغط هنا لرؤية العروض الخاصة بالعميل</a><label>
                                           </p>
										   
											
											<p>
												<label><b>العضوية</b></label>
												
												<label><input type="radio"  name="membership"  <?php if($this_user[0]->authority==1){echo'checked="checked" '; }?> value="1" id="normal"> عضوية عادية</label>
											 
												<label><input type="radio"  name="membership"  <?php if($this_user[0]->authority==2){echo'checked="checked" '; }?> value="2" id="gold"> عضوية ذهبية</label>
											 
												<label><input type="radio"  name="membership" <?php if($this_user[0]->authority==0){echo'checked="checked" '; }?> value="0" > تعليق العضوية</label>
																			
											
											</p>
											<p>
                                             <label>عرض العميل في الرئيسية</label>
                                                 <?php  if ($this_user[0]->statue=='on'){?>
                                                 <?php echo '<input type="checkbox" name="statue" checked =""/>';?>
                                                 <?php }else{ echo '<input type="checkbox" name="statue" />';}?>
                                            </p>

                                            <p>
                                                <input type="submit" value="تعديل" class="submit-green"/>
                                                <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url();?>webadmin/users';" />
                                            </p>
                                        </div>

                                    </form>
                                    
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