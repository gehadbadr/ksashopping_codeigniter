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
 <?php if (!empty($pages)){?>
	<?php   foreach ($pages as $row): ?>
	<?php if (!empty($row->path)){?>
	<div class="col-md-7 col-12 order-xl-first order-lg-first order-md-first order-last">
		<div class="page_col ml-md-3">
            <?php $text = $this->admin_model->bb2html($row->content);
			echo $row->content;
						 //echo  $text; ?>				
		</div><!-- .page_col -->
	</div><!-- .col -->

	<div class="col-md-5 col-12 order-xl-last order-lg-last order-first">
		<div class="page_col w-100 h-100">

			<img src="<?php echo base_url().$row->path ;?>" alt=""  />
		</div><!-- .box -->
	</div><!-- .left_col -->
	<?php }else{?>
	<div class="col">
		<div class="page_col ml-md-3">
            <?php $text = $this->admin_model->bb2html($row->content);
						 //echo  $text; 
						echo $row->content;?>
		</div><!-- .page_col -->
	</div><!-- .col -->
    <?php }?>

	<?php  endforeach;    ?>
<?php }else{?>
<div class="col">
	<p align="center">
	عفوا لا يوجد صفحات حاليا
	</p>
</div><!-- .col -->
	
<?php }?>
</div><!-- .row -->
	
  	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>