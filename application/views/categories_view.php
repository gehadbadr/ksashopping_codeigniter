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

	<div class="row no-gutters row-cols-lg-3 row-cols-sm-2 row-cols-1 products">
		<?php if (!empty($cats)){?>
			<?php foreach ($cats as $row): ?>
		<div class="col">
			<div class="card product">
			<a href="<?php echo base_url(); ?>pro/pcat/<?php echo $row->cat_id;?>">
				<img src="<?php echo base_url().$row->path ;?>" alt="" />
				<span><?php echo $row->name ;?></span>
			</a>
			</div><!-- .product -->
		</div><!-- .col -->
		<?php  endforeach;    ?>
		<?php }else{?>
		<div class="col">
			<div class="card product">
			<p align="center" style="min-height:340px;">
			عفوا لا يوجد منتجات حاليا
			</p>
			</div>
		</div><!-- .col -->
		<?php }?>
	</div><!-- .row products -->

	<?php if (!empty($cats)) {?>
		<div class="pagination mb-5 justify-content-center">
			<?php echo $this->pagination->create_links(); ?>
		</div><!-- .pagination -->
    <?php }?>

	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html> 