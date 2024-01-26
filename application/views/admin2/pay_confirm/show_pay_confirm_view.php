<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php  $this->load->view('admin/includes/head.php'); ?>
        <title>لوحة التحكم | PAY Confirmation Emails</title>
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
                                                                        </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>

                                </td>
                            </tr>
                        </tbody></table><script type="text/javascript">
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
                            $("#check_all").live('click',function(){
                                if($(this).attr('checked')==true)
                                {
                                    $("input[name=chk[]]").attr('checked',true);
                                }else{
                                    $("input[name=chk[]]").attr('checked',false);
                                }
                            });
                            $(".delete").live('click',function(){
                                del=confirm('هل تريد حقا حذف هذه الرساله؟');
                                if(del)
                                {
                                    var $t=$(this).attr('rel');
                                    var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                    $('tr#'+$t).html($v);
                                    $.post('<?php echo base_url(); ?>webadmin/inbox/delete/'+$t,function(data){
                                        $('tr#'+$t).remove();
                                        if($('#myTable > tbody > tr').size()==0)
                                        {
                                            $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد أى بريد إلكترونى</td></tr>');
                                        }
                                    });
                                }
                            });
                    </script>
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
										        <?php  $this->load->view('admin/includes/control_panel.php'); ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="75%" valign="top"  style="padding-right: 5px;">


                                                                        <div class="bottom-spacing">
                                                                        </div>
                                                                        <!-- Button -->


                                                                        <div class="module">
                                                                            <h2><span><?php echo $this_message[0]->name; ?></span></h2>

                                                                            <div class="module-table-body">
                                                                                <form action="<?php echo base_url(); ?>webadmin/newsletter/do_operation" id="forn" method="post">
                                                                                    <table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>الاسم:</td><td><?php echo $this_message[0]->name; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>الموبايل:</td><td><?php echo $this_message[0]->mobile ;?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>الايميل:</td><td><?php echo $this_message[0]->email ;?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>البنك المحول عليه:</td><td><?php echo $this_message[0]->bank; ?></td>
                                                                                            </tr>
																							<tr>
                                                                                                <td>التاريخ:</td><td><?php echo $this_message[0]->date; ?></td>
                                                                                            </tr>
																							<tr>
                                                                                                <td>اسم المودع:</td><td><?php echo $this_message[0]->named; ?></td>
                                                                                            </tr>
																							<tr>
                                                                                                <td>المبلغ:</td><td><?php echo $this_message[0]->payment; ?></td>
                                                                                            </tr>
																							<tr>
                                                                                                <td>الملاحظات:</td><td><?php echo $this->admin_model->bb2html($this_message[0]->note); ?></td>
                                                                                            </tr>
																						    
																						
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="table-apply">
                                                                                        <p>
                                                                                            <input type="button" value="رجوع" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/pay_confirm';" />
                                                </p>
                                            </div>
                                        </form>
                                        <div style="clear: both"></div>
                                    </div> <!-- End .module-table-body -->
                                </div>
                            </td>
                        </tr>
                    </table>
                                    <?php  $this->load->view('admin/includes/footer.php'); ?>   

                </td>
            </tr>
        </table>
    </body></html>