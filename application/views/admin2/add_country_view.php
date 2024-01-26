<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>لوحة التحكم | الدول</title>
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
                                                                <td valign="top" width="100%" background="<?php echo base_url(); ?>images/admin/h-bg.gif">
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
                                            <?php include 'includes/control_panel.php'; ?>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td width="75%" valign="top" align="right" style="padding-right: 5px;">
                                <div class="bottom-spacing">
                                    <!-- Button -->
                                    <div class="float-left" style="margin-top: 25px;">
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="module">
                                    <h2><span>إضافة دولة</span></h2>

                                    <form action="<?php echo base_url(); ?>webadmin/country/add" method="post" enctype="multipart/form-data">
                                        <div class="module-body">
										<p><b><?php echo validation_errors(); ?></b></p>
										<?php if (!empty($upload)) {?>
										<p><b><?php echo $upload; ?></b></p>
										<?php }?>
                                            <p>
                                                <label>اسم الدولة</label>
                                                <input type="text" class="input-medium" name="catigory_name" id="username" value=""/>
                                            </p>
											
                                            <p>
                                                <input type="submit" value="إضافة" class="submit-green"/>
                                                    <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/country';" />
                                            </p>
											
                                        </div>
                                    </form>
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