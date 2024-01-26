<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php  $this->load->view('admin/includes/head.php'); ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
        <title>لوحة التحكم | تعديل منتج</title>
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
                    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.MultiFile.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){ // wait for document to load
                            $('#mui').MultiFile({
                                accept:'png|gif|jpg',
                                STRING: {
                                    remove: '<img src="<?php echo base_url(); ?>images/admin/cross-on-white.gif" height="16" width="16" alt="x"/>'
                                }
                            });
                        });
                    </script>
<!--                    <script src="http://topstore1.com/store/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
                    <script type="text/javascript" src="http://topstore1.com/store/assets/ckfinder/ckfinder.js"></script>-->
                    <style>
                        .scrollbox {
                            background: none repeat scroll 0 0 #FFFFFF;
                            border: 1px solid #CCCCCC;
                            height: 100px;
                            overflow-y: scroll;
                            width: 350px;
                        }
                        .scrollbox div.even {
                            background: none repeat scroll 0 0 #FFFFFF;
                        }
                        .scrollbox div.odd {
                            background: none repeat scroll 0 0 #E4EEF7;
                        }
                        .scrollbox div {
                            padding: 3px;
                        }
                    </style>
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
										        <?php  $this->load->view('admin/includes/control_panel.php'); ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="75%" valign="top" align="right" style="padding-right: 5px;padding-top:45px;">
                                                                        <div class="module">
                                                                            <h2><span><?php echo $this_product[0]->name ?></span></h2>
                                                                            <form action="" method="post" >
                                                                                <div class="module-body">
																			<p>
                                                                            <label>تعديل فيديو</label>
                                                                            <input type="text" name="pvideo" value="<?php echo $pvideo[0]->url ;?>" size="35"/>
                                                                            </p>
																			<p>
																				<div style="background-color: #D0D0D0">
																					<?php
																						echo validation_errors(); 
																					?>
																				</div>
																			</p>
                                                                            <p>
                                                                                <input type="submit" value="تعديل" class="submit-green"/>
                                                                                <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/product/edit/<?php echo $this_product[0]->product_id ;?>';" />
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