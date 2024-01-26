<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
        <title>لوحة التحكم | اضافة اعلان</title>
<link type="text/css" href="<?php echo base_url(); ?>css/datepicker.css" rel="stylesheet" media="screen" />
<script type="text/javascript" language="javascript" src="<?php echo base_url() ;?>js/datepicker.js"></script>
<script> 
$(document).ready(function(){
 <?php $date=date('Y-m-d');?>
$('#home-from').DatePicker({
	format:'Y-m-d',
	date: '<?php echo $date;?>',
	current:'<?php echo $date;?>',
	starts: 1,
	position: 'r',
	onChange: function(formated, dates){
		$('#home-from').val(formated);
		
		
	}
});
$('#home-to').DatePicker({
	format:'Y-m-d',
	date: '<?php echo $date;?>',
	current: '<?php echo $date;?>',
	starts: 1,
	position: 'r',
	onChange: function(formated, dates){
		$('#home-to').val(formated);
		
		
	}
});
 
});
</script>

		
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
                        </tbody></table>
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
                                            <?php $this->load->view('admin/includes/control_panel.php'); ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="75%" valign="top" align="right" style="padding-right: 5px;padding-top:45px;">
                                                                        <div class="module">
                                                                            <h2><span>اضافة اعلان</span></h2>
                                                                            <form action="<?php echo base_url() ;?>webadmin/ad/add/" method="post" enctype="multipart/form-data">
                                                                                <div class="module-body">
																				<p><b><?php echo validation_errors(); ?></b></p>
																				<?php if (!empty($upload)) {?>
																				<p><b><?php echo $upload; ?></b></p>
																				<?php }?>
                                                                                    <p>
                                                                                        <label>عنوان الاعلان</label>
                                                                                        <input type="text" class="input-medium" name="ad_name" id="username" value=""/>
                                                                                    </p>
                                                                                    <p>
                                                                                        <label>الرابط</label>
                                                                                        <input type="text" class="input-medium" name="ad_url" id="username" value=""/><b dir="ltr">http://</b>
                                                                                    </p>
																					<p>
                                                                                        <label>تاريخ العرض</label>
																					
																					<div id="home-date" >
																					من : <input type="text" name="ad_start" id="home-from" class="input-short" value="" /> إلى : <input type="text" name="ad_expire" id="home-to" class="input-short" value="" />

																					</div>
																					
																					</p>
                                                                                    <p>
                                                                                        <label>الصورة</label>
                                                                                        <input type="file" name="ad_image" id="username" />
                                                                                    </p>
																					<p>
																						<div style="background-color: #D0D0D0">
																						<?php

																						echo validation_errors(); 
																																										
																						?>
																																												
																						<?php
																						if ($this->session->flashdata('login_error')){
																						echo "<div '>";
																						echo $this->session->flashdata('login_error');
																						echo "</div>";
																						}
																						?>	  
																						</div>
																					</p>
                                                                                    
                                                                                        <input type="submit" value="اضافه" class="submit-green"/>
                                                                                        <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url() ;?>webadmin/ad/';" />
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