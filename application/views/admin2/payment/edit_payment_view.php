<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
		<script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
       
        <title>لوحة التحكم | طرق الدفع</title>
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
                                    <div class="float-left" style="margin-top: 25px;">
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                                <div class="module">
                                    <h2><span>تعديل طريقة الدفع</span></h2>
                                    <form action="<?php echo base_url(); ?>webadmin/payment/edit/<?php echo $payment[0]->payment_id;?>" method="post" enctype="multipart/form-data">
                                        <div class="module-body">
										
                                            <p>
                                                <label>اسم الطريقة</label>
                                                <input class="input-medium" name="payment_name" id="username" value="<?php echo $payment[0]->name;?>" type="text"/>
                                            </p>
											<p>
                                                <label>تفاصيل طريقة الدفع</label>
                                                <textarea id="editor1" name="content" rows="8" cols="60"><?php echo $payment[0]->content;?></textarea>
                                                <script type="text/javascript">
                                                                                    //<![CDATA[

                                                                                    // Replace the <textarea id="editor"> with an CKEditor
                                                                                    // instance, using the "bbcode" plugin, shaping some of the
                                                                                    // editor configuration to fit BBCode environment.
                                                                                    CKEDITOR.replace( 'editor1',
                                                                                    {
                                                                                        extraPlugins : 'bbcode',
                                                                                        // Remove unused plugins.
                                                                                        removePlugins : 'bidi,button,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,indent,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
                                                                                        // Width and height are not supported in the BBCode format, so object resizing is disabled.
                                                                                        disableObjectResizing : true,
                                                                                        // Define font sizes in percent values.
                                                                                        fontSize_sizes : "30/30%;50/50%;100/100%;120/120%;150/150%;200/200%;300/300%",
                                                                                        toolbar :
                                                                                            [
                                                                                            ['Source', '-', 'Save','NewPage','-','Undo','Redo'],
                                                                                            ['Find','Replace','-','SelectAll','RemoveFormat'],
                                                                                            ['Link', 'Unlink', 'Image', 'Smiley','SpecialChar'],
                                                                                            '/',
                                                                                            ['Bold', 'Italic','Underline'],
                                                                                            ['FontSize'],
                                                                                            ['TextColor'],
                                                                                            ['NumberedList','BulletedList','-','Blockquote'],
                                                                                            ['Maximize']
                                                                                        ],
                                                                                        // Strip CKEditor smileys to those commonly used in BBCode.
                                                                                        smiley_images :
                                                                                            [
                                                                                            'regular_smile.gif','sad_smile.gif','wink_smile.gif','teeth_smile.gif','tounge_smile.gif',
                                                                                            'embaressed_smile.gif','omg_smile.gif','whatchutalkingabout_smile.gif','angel_smile.gif','shades_smile.gif',
                                                                                            'cry_smile.gif','kiss.gif'
                                                                                        ],
                                                                                        smiley_descriptions :
                                                                                            [
                                                                                            'smiley', 'sad', 'wink', 'laugh', 'cheeky', 'blush', 'surprise',
                                                                                            'indecision', 'angel', 'cool', 'crying', 'kiss'
                                                                                        ]
                                                                                    } );

                                                                                    //]]>
                                                                                </script>
                                            </p>
											<p>
                                                 <label>صورة طريقة الدفع</label>
                                                 <input type="file"  name="photo_thumb" size="35"/><br />
                                            </p> 
											 <p> <img src="<?php echo base_url() ;?><?php echo $payment[0]->thumb ;?>" width="100" height="100" /></p>

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
                                            <p>
                                                <input value="تعديل" class="submit-green" type="submit"/>
                                                <input value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/payment';" type="button"/>
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