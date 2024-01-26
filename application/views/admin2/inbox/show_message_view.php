<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <?php  $this->load->view('admin/includes/head.php'); ?>
        <title>لوحة التحكم | صندوق الرسائل</title>
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
                        </tbody></table>
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
                                            <?php $this->load->view('admin/includes/control_panel.php'); ?>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="75%" valign="top"  style="padding-right: 5px;">


                                                                        <div class="bottom-spacing">
                                                                        </div>
                                                                        <!-- Button -->


                                                                        <div class="module">
                                                                            <h2><span><?php echo $this_message[0]->title; ?></span></h2>

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
                                                                                                <td>الاميل:</td><td><?php echo $this_message[0]->email ;?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>الرساله:</td><td><?php echo $this->admin_model->bb2html($this_message[0]->message); ?></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="table-apply">
                                                                                        <p>
                                                                                            <input type="button" value="رجوع" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/inbox';" />
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