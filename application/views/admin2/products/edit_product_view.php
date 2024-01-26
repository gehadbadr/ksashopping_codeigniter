<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
        <title>لوحة التحكم | تعديل منتج</title>
        <script type="text/javascript" src="<?php echo  base_url(); ?>ckeditor/ckeditor.js"></script>
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
                                                                <td valign="top" width="100%" background="<?php echo  base_url(); ?>images/admin/h-bg.gif">
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
                        $(".delete").live('click',function(){
                            del=confirm('هل تريد حذف هذة الصورة');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>webadmin/image/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').size()==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد صور حاليا</td></tr>');
                                    }
                                });
                            }
                        });
                    </script>
					<script type="text/javascript">

                            $(document).ready(function() {

                            $("#myTable1")
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

                           

                            $(".delete1").live('click',function(){
                                del=confirm('هل تريد حذف هذا الفيديو؟');
                                if(del)
                                {
                                    var $t=$(this).attr('rel');
                                    var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                    $('tr#'+$t).html($v);
                                    $.post('<?php echo base_url(); ?>webadmin/pvideo/delete/<?php echo $this_product[0]->product_id ?>/'+$t,function(data){
                                        $('tr#'+$t).remove();
                                        if($('#myTable1 > tbody > tr').size()==0)
                                        {
                                            $('#myTable1 > tbody').html('<tr><td colspan="5" alig="center">لا يوجد اي فيديو</td></tr>');
                                        }
                                    });
                                }
                            });
                          
                    </script>
                    <script type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.MultiFile.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){ // wait for document to load
                            $('#mui').MultiFile({
                                accept:'png|gif|jpg',
                                STRING: {
                                    remove: '<img src="<?php echo  base_url(); ?>images/admin/cross-on-white.gif" height="16" width="16" alt="x"/>'
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
                                <link href="<?php echo  base_url(); ?>css/jquery.treeview.rtl.css" rel="stylesheet" type="text/css"/>
                                <script type="text/javascript" src="<?php echo  base_url(); ?>js/jquery.treeview.js"></script>
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
                                                                            <h2><span><?php echo $this_product[0]->name ;?></span></h2>
                                                                            <form action="<?php echo  base_url(); ?>webadmin/product/edit/<?php echo $this_product[0]->product_id ;?>" method="post" enctype="multipart/form-data">
                                                                                <div class="module-body">
																			        <p>
																						<div style="background-color: #D0D0D0">
																							<?php echo validation_errors();?>
																																														
																							<?php
																								if ($this->session->flashdata('login_error')){
																								echo "<div '>";
																								echo $this->session->flashdata('login_error');
																								echo "</div>";
																								}
																							?>	  
																						</div>
																					</p>
																						<?php 	
																						if($this_product[0]->statue == 1){
																							echo  '<img src="' . base_url() . 'images/admin/offer.jpg"  width="100" height="100" alt="edit" />';
																						}  
																					?>	
                                                                                    <p>
                                                                                        <label>اسم المنتج</label>
                                                                                        <input type="text" class="input-medium" name="name" id="username" value="<?php echo $this_product[0]->name ;?>"/>
																					
                                                                                    </p>
																					
                                                                                    <p>
                                                                                        <label>القسم الرئيسى</label>
                                                                                        <select name="cat_id" class="input-medium">
																							<option value="">اختار التصنيف</option>
																							<?php
																								for ($i = 0; $i < count($cats); $i++) {
																									if ($this_product[0]->cat_id_fk == $cats[$i]->cat_id) {
																										echo "<option value='" . $cats[$i]->cat_id . "' selected=''>" . $cats[$i]->name . "</option>";
																									} else {
																										echo "<option value='" . $cats[$i]->cat_id . "'>" . $cats[$i]->name . "</option>";
																									}
																								}
																							?>
                                                                                </select>
                                                                            </p>
																			<p>
                                                                            <?php
                                                                            if(empty ($pvideo)){
                                                                                echo 'لا يوجد فيديوهات لهذا المنتج';
																				echo  '  <p>
                                                                                اضافة فيديوهات للمنتج<br/>  ';                                                              
                                                                            }else{ 
																			    echo  '<p>
                                                                                تعديل فيديوهات المنتج 
																				 <p> ';
																			}
   
																			   ?>
                                                                                
                                                                                <script type="text/javascript"><!--
                                                                                    var gFiles = 0;
                                                                                    function addFile() {
                                                                                        var li = document.createElement('li');
                                                                                        li.setAttribute('id', 'file-' + gFiles);
                                                                                        li.innerHTML = '<input type="text" name="pvideo[]" class="input-medium"><span onclick="removeFile(\'file-' + gFiles + '\')" style="cursor:pointer;">حذف</span>';
                                                                                        document.getElementById('files-root').appendChild(li);
                                                                                        gFiles++;
                                                                                    }
                                                                                    function removeFile(aId) {
                                                                                        var obj = document.getElementById(aId);
                                                                                        obj.parentNode.removeChild(obj);
                                                                                    }
                                                                                    --></script>
                                                                                <a><span onclick="addFile()" style="cursor:pointer;">اضافة فيديو</span></a>
                                                                                <ol id="files-root">
                                                                                    <li><input class="input-medium" type="text" name="pvideo[]"/>
                                                                                            </ol>
                                                                                            </p>
                                                                         
																				<?php
																					if(!empty ($pvideo)){                                                                             
   																			    ?>	
                                                                                <table width="99%" class="tablesorter" id="myTable1" style="background-position:center;">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="width:5%">#</th>
                                                                                            <th style="width:30%">الفيديو</th>
                                                                                            <th style="width:10%"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                        <?php
                                                                                    for ($i = 0; $i < count($pvideo); $i++) {
                                                                                        echo '<tr id="' . $pvideo[$i]->video_id . '">';
                                                                                        echo '<td class="align-center">' . ($i+1). '</td>';
                                                                                        echo '<td><a href="' . base_url() . 'webadmin/pvideo/edit/' . $this_product[0]->product_id . '/'.$pvideo[$i]->video_id.'">' . $pvideo[$i]->url . '</a></td>';
                                                                                        echo '<td>';
                                                                                        //echo '<input type="checkbox" name="chk[]" value="' . $pvideo[$i]->video_id . '" />';
                                                                                        echo '<a href="' . base_url() . 'webadmin/pvideo/edit/' . $this_product[0]->product_id . '/'.$pvideo[$i]->video_id. '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
                                                                                        echo '<a href="javascript:;" class="delete1" rel="' . $pvideo[$i]->video_id . '"><img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';
                                                                                        echo '</td>';
                                                                                        echo '</tr>';
                                                                                    }
                                                        ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </p>
                                                                                <?php
                                                                            }
                                                                                ?>
                                                                            </p>
                                                                            <p>
                                                                                <label>تفاصيل المنتج</label>
                                                                                <textarea id="editor" name="details" rows="15" cols="75" style="width: 75%"><?php echo $this_product[0]->details ;?></textarea>
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
                                                                                <label>السعر</label>
                                                                                <input type="text" class="input-medium" name="price" value="<?php echo intval($this_product[0]->price) ;?>"/>
                                                                                <select class="input-short" name="currency" >
                                                                                    <option value="SAR" >ريال سعودى</option>
                                                                                   
                                                                                </select>
																			 </p>
																																					 
																			<p> 
                                                                                <label>سعر العرض</label>
                                                                                <input type="text" class="input-medium" name="offer_price" value="<?php echo $this_product[0]->offer_price ;?>"/>
                                                                            </p>
																			<p>
                                                                                 <label>تاريخ العرض</label>
																					
																				<div id="home-date" >
																				من : <input type="text" name="offer_start" id="home-from" class="input-short" value="<?php echo $this_product[0]->offer_start ;?>" /> إلى : <input type="text" name="offer_expire" id="home-to" class="input-short" value="<?php echo $this_product[0]->offer_expire ;?>" />

																				</div>
																					
																			</p>
                                                                           
                                                               	
																				
                                                                        <!--    </p>
																			<?php if($this_product[0]->offerprice != 0){
																			            $price =$this->admin_model->GetpriceByID($this_product[0]->offerprice) ;
																			?>
																			<p>
                                                                                <label>سعر العرض</label>
                                                                                <input type="text" class="input-medium" name="offerprice" value="<?php echo intval($price[0]->price) ;?>"/>
                                                                                <select class="input-short" name="currency" >
                                                                                    <option value="SAR" >ريال سعودى</option>
                                                                                   
                                                                                </select>
                                                                            </p>
																			<?php if($price[0]->statue==0){
																			echo "<p style='color:red;' >غير ساري </p>";
																			}?>
																			<p>
                                                                                        <label>تاريخ العرض</label>
																					
																					<div id="home-date" >
																					من : <input type="text" name="home_from" id="home-from" class="input-short" value="<?php echo $price[0]->home_from ;?>" /> إلى : <input type="text" name="home_to" id="home-to" class="input-short" value="<?php echo $price[0]->home_to ;?>" />

																					</div>
																					

                                                                            <p>
																			<?php }else{?>
																			<p>
                                                                                <label>سعر العرض</label>
                                                                                <input type="text" class="input-medium" name="offerprice" value="<?php echo intval($this_product[0]->offerprice) ;?>"/>
                                                                                <select class="input-short" name="currency" >
                                                                                    <option value="SAR" >ريال سعودى</option>
                                                                                   
                                                                                </select>
                                                                            </p>
																			<p>
                                                                                        <label>تاريخ العرض</label>
																					
																					<div id="home-date" >
																					من : <input type="text" name="home_from" id="home-from" class="input-short" value="" /> إلى : <input type="text" name="home_to" id="home-to" class="input-short" value="" />

																					</div>
																					

                                                                            <p>
																			<?php }?> -->
                                                                      
                                                                           
                                                                            <p>
                                                                                <label>الصورة الرئيسية</label>
																				<input type="file"  name="photo_thumb" size="35" /><br />
																				<img src="<?php echo base_url().$product_main_image[0]->image_thumb  ;?>" alt="" width="120" height="120" />
                                                                                
                                                                            </p>
																			
                                                                            <p>
                                                                                <label>صور المنتج</label>
																				<table  id="myTable" cellspacing="0">
																				
																				<?php for ($i = 0; $i < count($product_images); $i++) {?>
																				
                                                                                    <tr id="<?php echo $product_images[$i]->image_id ;?>">																				   
																				    
																					<td width = 20%><img src="<?php echo base_url().$product_images[$i]->image_thumb  ;?>" alt="" width="80" height="80" />
																					</td>
																					<td>
																					<?php echo '<a href="javascript:;" class="delete" title="حذف" rel="' . $product_images[$i]->image_id . '">';?>
																					<?php echo '<img src="' . base_url() . 'images/admin/cross-on-white.gif"  width="16" height="16" alt="comments" /></a>';?>
																					</td>
																					
																					
																					</tr>
																				    
																				<?php   } ?>
																				
																	     		 </table>
																			</p>
																			<p>
																				 <label>لاضافة صور جديدة لمنتج</label>
																			    <input type="file"  name="photo[]" size="35"  id="mui"   /><br />
                                                                                <p style="color:#686868; margin:0; margin-top:-10px;">يمكنك إضافة حتى 30  صورة نوع jpg أو gif أو png</p>
                                                                            </p>
		                                                                    <p>
                                                                                <input type="submit" value="تعديل" class="submit-green"/>
                                                                                <input type="button" value="إلغاء" class="submit-gray" onclick="javascript:self.location='<?php echo  base_url(); ?>webadmin/product';" />
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