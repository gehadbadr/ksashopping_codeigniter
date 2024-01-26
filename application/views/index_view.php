<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>KSA SHopping</title>
<?php  $this->load->view('includes/head.php'); ?>
</head>
<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">

	<?php  $this->load->view('includes/navigator.php'); ?>
	
	<div class="row no-gutters">
		<div class="col col-sm-6 col-12 ">
			<div id="slider" class="carousel slide mb-2 ml-md-2 ml-sm-2" data-ride="carousel">
			<?php if (!empty($sliders)){?>

			<!-- Indicators -->
			  <ul class="carousel-indicators">
			  <?php for($i=0;$i<count($sliders);$i++){ ?>
				<li data-target="#slider" data-slide-to="<?php echo $i;?>" <?php if($i == 0){ echo'class="active"';}?>></li>
			  <?php }?>
			  </ul>

			  <!-- The slideshow -->
			  <div class="carousel-inner">
			  <?php for($i=0;$i<count($sliders);$i++){ ?>
				<?php if($i == 0){ ?>
				<div class="carousel-item active">
					<a href="<?php echo $sliders[$i]->slider_url;?>">
					    <img src="<?php echo base_url().$sliders[$i]->slider_image;?>" alt="<?php echo $sliders[$i]->slider_name;?>" >
					</a>
				</div>
				<?php }else{?>
				<div class="carousel-item ">
					<a href="<?php echo $sliders[$i]->slider_url;?>">
						<img src="<?php echo base_url().$sliders[$i]->slider_image;?>" alt="<?php echo $sliders[$i]->slider_name;?>" >
					</a>
				</div>
				 <?php }?>	
			  <?php }?>	
			  </div>

			  <!-- Left and right controls -->
			  <a class="carousel-control-prev" href="#slider" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			  </a>
			  <a class="carousel-control-next" href="#slider" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			  </a>
				<?php }else{?>
				 <!-- The slideshow -->
			  <div class="carousel-inner d-xl-block d-lg-block d-md-block d-none ">
				<div class="carousel-item active">
				  <img src="" alt="عفوا لا يوجد شرائح">
				</div>
			  </div>
				<?php }?>
			</div><!-- .slider_wrap -->
		</div><!-- .col -->
		<div class="col col-sm-6 col-12 mb-2">
			<div class="video_wrap">
			<?php if (!empty($video)){
				echo $video[0]->url ;?>
			<?php }else{?>
				<p align="center">
				عفوا لا يوجد فيديوهات حاليا
				</p>
			<?php }?>
			</div><!-- .video_wrap -->
		</div><!-- .col -->
	</div><!-- .row_wrap -->	

	<div class="row no-gutters row-cols-lg-3 row-cols-sm-2 row-cols-1 products">
		<?php if (!empty($cats)){?>
			<?php foreach ($cats as $row): ?>
		<div class="col">
			<div class="card product">
			<a href="<?php echo base_url(); ?>pro/pcat/<?php echo $row->cat_id;?>">
				<img src="<?php echo base_url().$row->path ;?>" alt="" />
				<span><?php echo $row->name ;?></span>
			</a>
			</div>
		</div><!-- .product -->
		<?php  endforeach;    ?>
		<?php }else{?>
		<div class="col">
			<div class="card product">
			<p align="center" style="min-height:85px;">
			عفوا لا يوجد منتجات حاليا
			</p>
			</div>
		</div><!-- .col -->
		<?php }?>
	</div><!-- .products -->
	
	<?php if (!empty($cats)) {?>
		<div class="pagination justify-content-center">
			<?php echo $this->pagination->create_links(); ?>
		</div><!-- .pagination -->
    <?php }?>

	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>