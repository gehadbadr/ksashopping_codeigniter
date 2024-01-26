<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | صندوق الرسائل</title>
<body>

	<div class="container">
		<header>
		<?php  $this->load->view('admin/includes/admin_top.php'); ?>
		</header> 
		
		<div class="button m-5"></div>
		<div class="clearfix"></div>

	<div class="row no-gutters mb-4">
		<div class="col-3 d-none d-md-block sidebar">
			<p class="top">القائمة الرئيسية</p>
			<div class="module-body" >
				<?php  $this->load->view('admin/includes/control_panel.php'); ?>
			</div>
		</div>
		<div class="col-md-8 col-12 mr-md-2 wrapper" >
			<p class="top"  style="text-align:right;word-wrap: break-word;"><?php echo $this_message[0]->title; ?></p>
			<div class="module-body">																		
				<div class=" w-100 table-responsive" >
					<form action="" method="post" enctype="multipart/form-data">
						<table width="99%" class=""  style="background-position:center;border: 1px solid black;">
								<tr>
									<td style="width: 50px ;" class="p-2">الاسم :</td><td  class="p-2"><?php echo $this_message[0]->name; ?></td>
								</tr>
								<tr>
									<td class="p-2">الموبايل :</td><td  class="p-2"><?php echo $this_message[0]->mobile ;?></td>
								</tr>
								<tr>
									<td class="p-2">الايميل :</td><td  class="p-2"><?php echo $this_message[0]->email ;?></td>
								</tr>
								<tr>
									<td class="p-2">التاريخ :</td><td  class="p-2"><?php echo $this_message[0]->date ;?></td>
								</tr>
								<tr>
									<td class="p-2">الرساله :</td><td  class="p-2"><?php echo $this->admin_model->bb2html($this_message[0]->message); ?></td>
								</tr>
							</tbody>
						</table>
					<div class="table-apply">
						<p>
							<input type="button" value="رجوع" class="submit-gray" onclick="javascript:self.location='<?php echo base_url(); ?>webadmin/inbox';" />
						</p>
					</div> <!-- End .module-table-body -->
				</div>
			</div>
		</div>
	</div>
	
	<?php  $this->load->view('admin/includes/footer.php'); ?>       
 
    </div>
</body>

</html>