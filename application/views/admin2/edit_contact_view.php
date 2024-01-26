<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>لوحة التحكم | معلومات الاتصال</title>
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
                    <table width="96%" align="center" border="0" cellpadding="0" cellspacing="0" height="70%">
                        <tr class="addCategory">
                            <td width="25%" valign="top" style="padding-top:19px;padding-right:20px;" >
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
                                                                    <td width="75%" valign="top"  style="padding-right: 5px;">
                                                                        <div class="bottom-spacing">
                                                                        </div>
                                                                        <!-- Button -->
                                                                        <div class="module">
                                                                            <h2 style="font-weight: 900"><span>معلومات الاتصال</span></h2>
                                                                            <div class="module-table-body"><?php   foreach ($details as $row):  ?>
                                                                                <form action="" method="post" >
																				<p><b><?php echo validation_errors(); ?></b></p>
                                                                                    <p>
                                                                                        <label style="font-size: 20px;font-weight: 900;">تفاصيل معلومات الاتصال</label>
                                                                                        <textarea id="editor1" name="elm1" rows="15" cols="80" style="width: 75%"><?php echo $row->about_full  ; ?></textarea>
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
                                                                                    </p><hr/>
                                                                                    <p><?Php /*
                                                                                        <label style="font-size: 20px;font-weight: 900;">الوصف الجانبى</label>
                                                                                        <textarea id="editor2" name="elm2" rows="15" cols="80" style="width: 75%"><?php  isset($details[0]->about_short) ?  $details[0]->about_short : '';?></textarea>
                                                                                        <script type="text/javascript">
                                                                                    //<![CDATA[

                                                                                    // Replace the <textarea id="editor"> with an CKEditor
                                                                                    // instance, using the "bbcode" plugin, shaping some of the
                                                                                    // editor configuration to fit BBCode environment.
                                                                                    CKEDITOR.replace( 'editor2',
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
                                                                                    </p>*/?>
                                                                                    <p>
                                                                                        <input type="submit" value="تعديل" class="submit-green"/>
                                                                                        <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url();?>webadmin/contact';" />
                                            </p>
                                        </form><?php   endforeach;  ?>
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