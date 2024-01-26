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
	
	<div  class="row no-gutters row-cols-md-2 row-cols-1 products" >
	<?php if (!empty($products)) {?>
			<?php   foreach ($products as $row): 
				$name  = str_replace(" ", "-", $row->name );
			?>
		<div class="col">
			<div class="card product">
				<div class="card-body row no-gutters p-0">
					<div class="col-md-12 col-5 image_side">
						<a href="<?php echo base_url(); ?>pro/product_detail/<?php echo $row->product_id;?>/<?php echo $name ;?>">
							<?php  $product_main_img = $this->products_model->GetProductMainImage($row->product_id);?>
								<img src="<?php echo base_url(); ?><?php echo $product_main_img[0]->image;?>" alt="<?php echo $row->name ;?>" class=" "/>
						<!--<img src="<?php echo base_url(); ?><?php echo $product_main_img[0]->image_thumb;?>" alt="<?php echo $row->name ;?>" class="d-xl-none d-lg-none d-md-none d-ms-none d-block"/>-->
						</a>
					</div>
					<div class="col-md-12 col-7 details">	
						<a href="<?php echo base_url(); ?>pro/product_detail/<?php echo $row->product_id;?>/<?php echo $name ;?>">
							<h4 class="product_name text-truncate" title="<?php echo $row->name ;?>" ><?php echo $row->name ;?></h4>
						</a>		
						<?php if($row->statue == 1){?>
						<div class="price"><?php echo $row->offer_price ;?>  جنيه</div>
						<div class="old_price" style=""><?php echo $row->price ;?> جنيه</div>
						<?php }else{?>
						<div class="price" ><?php echo $row->price ;?> جنيه</div>
						<div class="old_price" style="margin-bottom:0.9rem;margin-top:1rem;"></div>				
						<?php }?>						
						<div class="rate"  >
						<?php
							
								//$rating = $row->rating;
								$number_of_voting = $row->number_of_voting;
								$sum_of_votes = $row->sum_of_votes;
								
									if(empty($number_of_voting )) {
										$rating = 0;
										$rating_round = 0;
										
									}else{
								$nov= $number_of_voting+1;
								$rating = $sum_of_votes / $number_of_voting;
								
								$rating_round = round($rating,1);
									//echo  $rating;
									}
								?>
							<div class="rate_item" id="rating_<?php echo $row->product_id; ?>" >
								<div class="star_1 ratings_stars"><img src="<?php echo base_url(); ?>images/discharger_white.png" width="26" height="26" <?php if($rating > 0) { echo"class='hover_star'"; } ?>  alt=""  /></div>
								<div class="star_2 ratings_stars"><img src="<?php echo base_url(); ?>images/discharger_white.png" width="26" height="26" <?php if($rating > 1.5) { echo"class='hover_star'"; } ?> alt=""  /></div>
								<div class="star_3 ratings_stars"><img src="<?php echo base_url(); ?>images/discharger_white.png" width="26" height="26" <?php if($rating > 2.5) { echo"class='hover_star'"; } ?> alt=""  /></div>
								<div class="star_4 ratings_stars"><img src="<?php echo base_url(); ?>images/discharger_white.png" width="26" height="26" <?php if($rating > 3.5) { echo"class='hover_star'"; } ?>  alt="" /></div>
								<div class="star_5 ratings_stars"><img src="<?php echo base_url(); ?>images/discharger_white.png" width="26" height="26" <?php if($rating > 4.5) { echo"class='hover_star'"; } ?>  alt=""  /></div>
							</div>
						</div>
						<?php if(empty($row->shipping)){?>
						<div class="shipping">مشمولة في <b>الشحن المجاني </b></div>
						<?php }else{?>
							<div class="shipping"  style="padding-bottom:1.3rem;"></div>
						<?php }3?>	
						<div class="add_to_cart_block" style="text-align:center;">
							<form action="<?php echo base_url(); ?>cart/add_to_cart" method="post" class="order_form">	
								<input type="hidden" name="product_id" value="<?php echo $row->product_id; ?>"  />
								<input type="hidden" name="quantity" value="01"  class="" />
								<input type="submit" class="add_to_cart" value="أضف للسلة" style="font-size:16px;width:80%;"/>
							</form>
						</div>
					</div>
				</div>
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
	</div><!-- .row products-->
	
   <?php if (!empty($products)) {?>
	<div class="pagination">
		<?php echo $this->pagination->create_links(); ?>
	</div><!-- .pagination -->
    <?php }?>

	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>