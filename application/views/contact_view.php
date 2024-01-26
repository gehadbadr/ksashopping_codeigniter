<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>	
<title><?php echo $title ;?></title>
<?php  $this->load->view('includes/head.php'); ?>
</head>
<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">


	<?php  $this->load->view('includes/navigator.php'); ?>
<div class="row no-gutters ">	
	<div class="col-md-7 col-12">
		<div class="box contact_col ml-md-3">

			<h2>اتصل بنا</h2>
			<div class="inside">
			
			<p class="contact_p">أيا كانت وسيلة التواصل التي تفضلها... ستجدنا دائماً بقربك.. نجيب على جميع استفساراتك 
					بسرعة!</p>
		   
		   <table class="contact_table">
				<form method="post" action="<?php echo base_url().'home/contact';?>">
					<tr>
						<td width="30%">الاسم:</td>
						<td width="70%"><input type="text" class="form-control" name="name" value="<?php if(empty($msg)){echo set_value("name") ;}?>"/><?php echo form_error("name") ;?></td>

					</tr>
					<tr>
						<td>الإيميل:</td>
						<td><input type="text" class="form-control" name="email" value="<?php  if(empty($msg)){echo set_value("email");} ?>"/><?php echo form_error("email") ;?></td>
					</tr>
					<tr>
						<td>الجوال:</td>
						<td><input type="text" class="form-control"  name="mobile" value="<?php  if(empty($msg)){echo set_value("mobile"); }?>"/><?php echo form_error("mobile") ;?></td>
					</tr>
					<tr>
						<td>عنوان الرسالة:</td>
						<td><input type="text" class="form-control" name="title" value="<?php if(empty($msg)){ echo set_value("title"); }?>"/><?php echo form_error("title") ;?></td>
					</tr>
					<tr>
						<td valign="top">الرسالة:</td>
						<td><textarea cols="20" rows="6" class="form-control" name="message"><?php if(empty($msg)){echo set_value("message") ;}?></textarea><?php echo form_error("message") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="ارسال" /></td>
					</tr>
				</form>
			</table>
		    <div align="center">
			    <?php if(!empty($msg)){
							echo $msg;
					  }
					?>
			</div>
			</div><!-- .inside -->
			
		</div><!-- .box -->
	</div><!-- .col -->

	<div class="col-md-5 col-12">
		
		<div class="box">
			<h2>معلومات الاتصال</h2>
			<div class="contact_info">
			<?php if (!empty($details)){?>
				<?php   foreach ($details as $row):
						$text = $this->admin_model->bb2html($row->contact_details);
							 echo  $text; ?>
				<?php  	endforeach;   
						}else{?>
					<p align="center">
					عفوا لا يوجد معلومات اتصال حاليا
					</p>
			<?php }?>
			</div><!-- .contact_info -->
		</div><!-- .box -->
		
		<div class="box left_small_col">
			<h2>اشترك معنا ليصلك أحدث منتجاتنا</h2>
			<div class="inside">
				<table class="left_form_tbl">
				<form method="post" action="<?php echo base_url().'home/newsletter';?>">
					<tr>
						<td width="20%">الاسم:</td>
						<td width="80%"><input type="text" class="form-control" name="name_news" value="<?php if(empty($msg_news)){echo set_value("name_news") ;}?>"/><?php echo form_error("name_news") ;?></td>
					</tr>
					<tr>
						<td>الإيميل:</td>
						<td><input type="text" class="form-control" name="email_news" value="<?php if(empty($msg_news)){echo set_value("email_news") ;}?>"/><?php echo form_error("email_news") ;?></td>
					</tr>
					<tr>
						<td></td>
						<td align="left"><input type="submit" value="ارسال" /></td>
					</tr>
				</form>
				</table>
				<div align="center">
			    <?php if(!empty($msg_news_false)){
							echo $msg_news_false;
					  }elseif(!empty($msg_news)){
							echo $msg_news;
					  }
					?>
			</div>
			</div><!-- .inside -->
		</div><!-- .box -->
		
	</div><!-- .col -->
</div><!-- .row -->
	
	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>