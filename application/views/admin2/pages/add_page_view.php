<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php  $this->load->view('admin/includes/head.php'); ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
        <title>لوحة التحكم | اضافة صفحة</title>
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
                                    <h2><span>اضافة صفحة</span></h2>
									<?php $data['x'] = $this->pages_model->count_pages();
                                     if($data['x']<4){?>
                                    <form action="<?php echo base_url(); ?>webadmin/pages/add" method="post" enctype="multipart/form-data">
                                        <div class="module-body">
										<?php if (!empty($upload)) {?>
										<p><b><?php echo $upload; ?></b></p>
										<?php }?>
                                            <p>
                                                <label>عنوان الصفحة</label>
                                                <input type="text" class="input-medium" name="page_title" id="username" value=""/>
                                            </p>
                                            <p>
                                                <label>محتوي الصفحة</label>
                                                <textarea id="editor1" name="page_content" rows="8" cols="60"></textarea>
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
                                                <label>الصورة</label>
                                                <input type="file" name="image" id="username" />
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
                                            <p>
                                                <input type="submit" value="إضافة" class="submit-green"/>
                                                <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/pages';" />
                                            </p>
                                        </div>
                                    </form
									<?php }else{?>
									 <br /><br /><br />
									 <p style="min-height:50px;" align="center">عفوا لا يمكن اضافة اكتر من اربع صفحات</p>
									 <?php }?>
                                  
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