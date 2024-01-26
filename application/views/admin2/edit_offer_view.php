<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'includes/head.php'; ?>
        <title>لوحة التحكم | تعديل عرض</title>
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
 
$('#fixed-from').DatePicker({
	format:'Y-m-d',
	date: '<?php echo $date;?>',
	current: '<?php echo $date;?>',
	starts: 1,
	position: 'r',
	onChange: function(formated, dates){
		$('#fixed-from').val(formated);
		
		
	}
});
$('#fixed-to').DatePicker({
	format:'Y-m-d',
	date: '<?php echo $date;?>',
	current: '<?php echo $date;?>',
	starts: 1,
	position: 'r',
	onChange: function(formated, dates){
		$('#fixed-to').val(formated);
		
		
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
                                            <?php include 'includes/control_panel.php'; ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="75%" valign="top" align="right" style="padding-right: 5px;padding-top:45px;">
                                                                        <div class="module">
                                                                            <h2><span>تعديل عرض</span></h2>
                                                                            <form action="<?php echo base_url() ;?>webadmin/offer/edit/<?php echo  $this_ad[0]->ad_id ;?>" method="post" enctype="multipart/form-data">
                                                                                <div class="module-body">
																				<p><b><?php echo validation_errors(); ?></b></p>
																				<?php if (!empty($upload)) {?>
																				<p><b><?php echo $upload; ?></b></p>
																				<?php }?>
                                                                                     <p>
                                                                                        <label>عنوان العرض</label>
                                                                                        <input type="text" class="input-medium" name="ad_name" id="username" value="<?php echo $this_ad[0]->ad_name ;?>"/>
                                                                                    </p>
                                                                                    
																					<p>
                                                                                <label>تفاصيل العرض</label>
                                                                                <textarea id="editor" name="content" rows="15" cols="75" style="width: 75%"><?php echo $this_ad[0]->content ;?></textarea>
                                                                                <script type="text/javascript">
                                                                                    //<![CDATA[

                                                                                    // Replace the <textarea id="editor"> with an CKEditor
                                                                                    // instance, using the "bbcode" plugin, shaping some of the
                                                                                    // editor configuration to fit BBCode environment.
                                                                                    CKEDITOR.replace( 'editor',
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
                                                                                        <label>تاريخ العرض</label>
																						
																						<div id="home-date" >
																					من : <input type="text" name="home_from" id="home-from" class="input-short" value="<?php echo $this_ad[0]->home_from ;?>" /> إلى : <input type="text" name="home_to" id="home-to" class="input-short" value="<?php echo $this_ad[0]->home_to ;?>" />

																					</div>
																					
																					
																					</p>
                                                                                    <p>
                                                                                        <label>الصورة</label>
                                                                                        <input type="file" name="ad_image" id="username" />
                                                                                    </p>
                                                                                    <p> <img src="<?php echo base_url() ;?><?php echo $this_ad[0]->ad_image ;?>" width="100" height="100" /></p>
                                                                                    <p>أبعاد الصورة لابد أن تكون
                                                                                        عرض :699 * طول: 309</p>
                                                                                    <p>
                                                                                        <input type="submit" value="تعديل" class="submit-green"/>
                                                                                        <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo base_url() ;?>webadmin/offer/';" />
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
                            </td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </body></html>