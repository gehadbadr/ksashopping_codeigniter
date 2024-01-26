<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>لوحة التحكم | نسيت كلمة المرور</title>
    </head>
    <body><table align="center" border="0" width="1000" cellpadding="0" cellspacing="0" dir="rtl">
            <tr>
                <td><table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                                <td>
                                    <table style="margin-bottom: 3px;" width="100%" border="0" cellpadding="0" cellspacing="0" dir="rtl">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" dir="rtl">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" width="100%" background="<?php echo base_url() ; ?>images/admin/h-bg.gif">
                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="adminTop" height="39">
                                                                                    <b>
                                                                                    </b>
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
                    <table height="211" border="0" align="center" dir="rtl" style="background:#FFF;" width="40%" >
                        <tr>
                            <td align="center">
                                <div class="module">
                                    <h2><span>نسيت كلمة المرور</span></h2>
                                    <div class="module-body">
                                        <form id="form1" name="form1" method="post" action="<?php echo base_url() ; ?>webadmin/forget" >
                                            <table height="211" border="0" align="center" dir="rtl" style="background:#FFF;border:none;">
                                                <tr>
                                                    <td >
                                                        <label>البريد الإلكترونى</label>
                                                        <input type="text" class="input-login" name="email" id="username"/>
                                                    </td>
													
                                                </tr>
												<tr>
                                                    <td>
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
														<div style="background-color: #D0D0D0">
                                                            
														</div>
                                                    </td>
                                                </tr>	
                                                <tr>
                                                    <td  align="center">
                                                        <input type="submit" class="submit-green" value="إرسال" />
													    <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url();?>webadmin/login';" />

                                                    </td>
												
                                                </tr>
												
                                            </table>
                                        </form>
                                    </div>
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