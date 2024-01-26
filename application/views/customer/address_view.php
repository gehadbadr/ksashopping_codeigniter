<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?php
    if ($this->session->userdata('customer_logged')) {
		$id=$this->session->userdata('customer_id');
		$this_customer = $this->customers_model->GetCustomerByID($id);	
        echo $this_customer[0]->fname." - KSA SHopping";
	}else{
		echo "KSA SHopping";
	}		
?></title>
<?php $this->load->view('includes/head.php');?>

</head>

<body>
<link href="<?php echo base_url(); ?>css/tablesorter.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tablesorter.min.js"></script>
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
                        
						
						$('.delete').click(function(){
                            del=confirm('هل تريد حذف هذا العنوان؟');
                            if(del)
                            {
                                var $t=$(this).attr('rel');
                                var $v='<td colspan="4" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
                                $('tr#'+$t).html($v);
                                $.post('<?php echo base_url(); ?>customer/address/delete/'+$t,function(data){
                                    $('tr#'+$t).remove();
                                    if($('#myTable > tbody > tr').length==0)
                                    {
                                        $('#myTable > tbody').html('<tr><td colspan="5" alig="center">لا يوجد عناوين حاليا</td></tr>');
                                    }
                                });
                            }
                        });
						
						});
                    </script>
<div class="container" id="main">
	
    	<?php $this->load->view('includes/navigator.php');?>
    <div class="clear"></div>
	
<div class="row no-gutters ">	
	<?php include'customer_menu.php';?>

	<div class="col-md-8 col-12">
	
		<div class="box" style="min-height: 514px;">
			<h2>عناويـــــــــــني</h2>
			<div class="contact_info">
				<strong style="w">مرحبا <?php echo $this_customer[0]->fname ;?>
			<div class="button mb-4 mt-4 ml-4" style="float:left;">
			<b><a href="<?php echo base_url() ;?>customer/address/add">
					<p class="button-item">اضف عنوان جديد<img src="<?php echo base_url() ;?>images/admin/plus-small.gif" border="0" /></p>
				</a>
			</b>
		</div>
				 <table class="contact_table">
				 	<table width="99%" class="tablesorter" id="myTable" style="background-position:center;">
							<thead>
								<tr style="background-color:#EEEEEE;">
									<th style="width:5%">#</th>
									<th style="">العنوان</th>
									<th style="background-color:#EEEEEE; padding: 4px; width:10%" class="no"><!--<input type="checkbox" id="check_all" value="" />--></th>
								</tr>
							</thead>
							<tbody>
				  <?php
					if(!empty($addresses)){
						for ($i = 0; $i < count($addresses); $i++) {
							echo '<tr id="' . $addresses[$i]->address_id . '">';
							echo '<td class="align-center">#</td>';
							//echo '<td><a href="' . base_url() . 'customer/address/edit/' . $addresses[$i]->address_id . '"> ' . $i+1 . ' </a></td>';
							echo '<td><a href="' . base_url() . 'customer/address/edit/' . $addresses[$i]->address_id . '">  ' . $addresses[$i]->governorate . '&nbsp;  ' . $addresses[$i]->city . '  &nbsp;' . $addresses[$i]->region . '&nbsp;  ' . $addresses[$i]->street . ' ...... </a></td>';
							echo '<td>';
							//echo '<input type="checkbox" name="chk[]" value="'.$addresses[$i]->address_id.'" />';
							echo '<a href="' . base_url() . 'customer/address/edit/' . $addresses[$i]->address_id . '"><img src="' . base_url() . 'images/admin/pencil.gif"  width="16" height="16" alt="edit" /></a>';
							echo '<a href="javascript:;" class="delete" rel="' . $addresses[$i]->address_id . '"><img src="'.base_url().'images/admin/cross-on-white.gif"  width="16" height="16" alt="delete" /></a>';
							echo '</td>';
							echo '</tr>';
						}
					}else{
						echo '<tr >';
						echo '<td class="align-center"></td>';
						echo '<td><strong>لا يوجد عناوين حاليا</strong></td>';
						echo '<td>';
						echo '</td>';
						echo '</tr>';							
					}			
				?> 
									</tbody>
						</table>
					<div style="text-align: center;">
						<?php echo $this->pagination->create_links(); ?>
					</div>	
					<!-- .pagnation -->
				</table>
			</div><!-- .contact_info -->
		</div><!-- .box -->
	
		
	</div><!-- .col -->
</div><!-- .row -->

<?php $this->load->view('includes/footer.php');?>
</div><!-- .wrapper -->
</body>
</html>