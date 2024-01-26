<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>

<title><?php echo $title ;?></title>
<?php  $this->load->view('includes/head.php'); ?>
<!-- Add fancyBox -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fancybox.pack.js?v=2.1.7"></script>


<style>
.form-control{background-color:#fff;}
.form-control:focus {background-color:#fff;} 
.ratings_stars {
	vertical-align: text-top;
	border-style: none;
}
.hover_star {
	vertical-align: text-top;
	border-style: none;
}

</style>
</head>
<body>
<?php  $this->load->view('includes/sidebar_menu.php'); ?>
<div class="container" id="main">

	<?php  $this->load->view('includes/navigator.php'); ?>
	
	<?php if (!empty($product_detail)) {?>
		<?php   foreach ($product_detail as $row): 
				$name  = str_replace(" ", "-", $row->name );
	?>
	<div class="product_title d-lg-none d-md-block">
		<div class="title"><?php echo $row->name ;?></div>
		<?php if($row->statue == 1){?>
		<div class="product_price p-0">السعر:<?php echo $row->offer_price ;?> جنيه
			<p><s class="product_old_price">السعر:<?php echo $row->price ;?> جنيه</s></p>
		</div>
		<?php }else{?>
		<div class="product_price p-0">السعر:<?php echo $row->price ;?> جنيه</div>	
		<?php }?>
		<div class="clear"></div>
	</div><!-- .product_title -->
<div class="box">
<div class="row no-gutters ">
	<div class="col-md-6 col-12  ">
    	<div id="product_img" class="carousel slide images" data-ride="carousel">
		<?php if (!empty($product_images)) {?>   
		<?php if (count($product_images)!=1) {?>
   	      <!-- Left and right controls -->
		  <a class="carousel-control-prev" href="#product_img" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		  </a>
		  <a class="carousel-control-next" href="#product_img" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		  </a>
		  
		  <!-- The slideshow -->
		  <div class="carousel-inner">
		  <?php for ($i = 0; $i < count($product_images); $i++) {?>
		  <?php if($i == 0){ ?>
			<div class="carousel-item active">
		  <?php }else{?>
			<div class="carousel-item ">
		  <?php   } ?> 	
				<a class="fancybox" rel="gallery" href="<?php echo base_url().$product_images[$i]->image ;?>"><img src="<?php echo base_url().$product_images[$i]->image ;?>" alt="" /></a>
		  </div>
		  <?php   } ?> 
	      </div>
		
		<!-- Indicators -->
		  <ul class="carousel-indicators thumbs-box">
		  <?php for ($i = 0; $i < count($product_images); $i++) {?>
		    <?php if($i == 0){ 
				$active ='active';
				}else{
				$active ='';
				}
			?> 
			<li data-target="#product_img" data-slide-to="<?php echo $i ;?>" class="<?php echo $active;?> "><img src="<?php echo base_url().$product_images[$i]->image_thumb  ;?>" alt="" /></li>
		<?php   } ?> 
		  </ul>
	<?php   }else{ ?>
	 <!-- The slideshow -->
		  <div class="carousel-inner">
		  <?php for ($i = 0; $i < count($product_images); $i++) {?>
			<div class="carousel-item active">
				<a class="fancybox" rel="gallery" href="<?php echo base_url().$product_images[$i]->image ;?>"><img src="<?php echo base_url().$product_images[$i]->image ;?>" alt="" /></a>
			</div>
		  <?php   } ?> 
	      </div>
	<?php   } ?> 
<?php   } ?>  
		</div><!-- .slider_wrap -->
    </div><!-- .images -->
	<div class="col-md-6 col-12  ">	
		<div class="product_info">
			
			<div class="product_title d-none d-lg-block">
					<div class="title"><?php echo $row->name ;?></div>
					<?php if($row->statue == 1){?>
					<div class="product_price p-0">السعر:<?php echo $row->offer_price ;?> جنيه
						<p><s class="product_old_price">السعر:<?php echo $row->price ;?> جنيه </s></p>
					</div>
					<?php }else{?>
					<div class="product_price p-0">السعر:<?php echo $row->price ;?> جنيه</div>	
					<?php }?>
					
			   <div class="clear"></div>
			</div><!-- .product_title -->

<script type="text/javascript">
$(document).ready(function() {

        $('[class^=star_]').mouseenter(
        function() {
            if($(this).parent().data('selected') == undefined) {
                var selectedStar = $(this).parent().find('.hover_star').length - 1;
                $(this).parent().data('selected', selectedStar)
            }
            $(this).children().addClass('hover_star');
            $(this).prevAll().children().addClass('hover_star');
            $(this).nextAll().children().removeClass('hover_star');
        });

    $('[id^=rating_]').mouseleave(
        function() {
            var selectedIndex = $(this).data('selected');
    
            if  (selectedIndex == -1)
            {
                $(this).children("[class^=star_]").children('img').removeClass("hover_star");
            }
            
            var $selected = $(this).find('img').eq(selectedIndex).addClass('hover_star').parent();        
            $selected.prevAll().children().addClass('hover_star');
            $selected.nextAll().children().removeClass('hover_star');
    });


    $("[id^=rating_]").children("[class^=star_]").click(function(){
        var current_star = $(this).attr("class").split("_")[1];
        var rid = $(this).parent().attr("id").split("_")[1];

      $('#star_container_'+rid).load('<?php echo base_url() ?>pro/submitRating', {rating: current_star, id: rid});
       
    });
});

</script> 

		<div class="entry_button" style="text-align:left;">
						<?php
						
							//$rating = $row->rating;
							$number_of_voting = $row->number_of_voting;
							$sum_of_votes = $row->sum_of_votes;
							
								if(empty($number_of_voting )) {
									$number_of_voting = 0;
									$rating_round = 0;
									
								}else{
							$nov= $number_of_voting+1;
							$rating = $sum_of_votes / $number_of_voting;
							
							$rating_round = round($rating,1);
								//echo  $rating;
								}
							?>
					<div >
						<div id="star_container_<?php echo $row->product_id ;?>" style="">
							<div id="rating_<?php echo $row->product_id; ?>" style="text-align:left;direction:ltr;">
								<span class="star_1 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 0) { echo"class='hover_star'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_2 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 1.5) { echo"class='hover_star'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_3 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 2.5) { echo"class='hover_star'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_4 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 3.5) { echo"class='hover_star'"; } ?> style="vertical-align: text-top;" /></span>
								<span class="star_5 ratings_stars"><img src="<?php echo base_url() ?>images/discharger_white.png" width="26" height="26" alt="" <?php if($rating > 4.5) { echo"class='hover_star'"; } ?> style="vertical-align: text-top;" /></span>
					
							</div>		
							<div class="star1_rating" style="text-align:left;">
								<?php echo $rating_round." حسب ".$number_of_voting." تقييم "; ?>
							</div>
					    </div>
			   	    </div>
				
			
		</div><!-- .entry_button -->  
			<div class="clearfix"></div>
			<div class="sub_entry d-lg-block d-none">
				<?php $text = $this->admin_model->bb2html($row->details);
					echo $text ; 
				?>
			</div><!-- .entry -->
			<div class="clearfix"></div>
			
			<div class="video pr-sm-1  pr-2" >
					<br/>
				<?php  for ($i = 0; $i < count($product_video); $i++) {?> 
					<?php if (count($product_video)==1) {?>
						<a  href="<?php echo $product_video[$i]->url ;?>" target="_blank"> مشاهدة فيديو المنتج <img src="<?php echo base_url();?>images/Movies-icon.png" alt="" class="p_video" /> </a>
					<?php }else{?>
						<a  href="<?php echo $product_video[$i]->url ;?>" target="_blank"> مشاهدة فيديو المنتج<?php echo $i+1;?>  <img src="<?php echo base_url();?>images/Movies-icon.png" alt="" class="p_video" /></a>
					<?php }?> 
					
				<?php }?> 
			</div><!-- .video -->
			<form action="<?php echo base_url(); ?>cart/add_to_cart" method="post" class="order_form">	
			<?php if($product_color){?>
			<div class="pt-3 pb-2 pr-sm-1  pr-2"><b>اختر اللون</b></div>
				<?php  for ($i = 0; $i < count($product_color); $i++) {?> 
				 <div class="form-check-inline mr-0 mb-2">
					<input type="radio" class="form-check-input" name="color" value="<?php echo $product_color[$i]->color_id ;?>">
					<label class="form-check-label mr-2" style="border: 1px solid #fd7373;padding:5px 10px; margin:2px;"><?php echo $product_color[$i]->color ;?></label>
				</div><?php echo form_error("color") ;?>
				<?php }?> 
			<?php }?> 
			
			<?php if($product_size){?>
			<div class="pt-3 pb-2 pr-sm-1  pr-2"><b>اختر المقاس</b></div>
				<?php  for ($i = 0; $i < count($product_size); $i++) {?> 
				 <div class="form-check-inline mr-0 mb-2">
					<input type="radio" class="form-check-input" name="size" value="<?php echo $product_size[$i]->size_id ;?>">
					<label class="form-check-label mr-2" style="border: 1px solid #fd7373;padding:5px 10px; margin:2px;"><?php echo $product_size[$i]->size ;?></label>
				</div><?php echo form_error("size") ;?>
				<?php }?> 
			<?php }?> 
		
			<?php if(empty($row->shipping)){?>
						<div class="pt-3 pb-2 pr-sm-1  pr-2">مشمولة في <b>الشحن المجاني </b></div>
			<?php }?>
				
			<div class="product_add_to_cart">
					<input type="hidden" name="product_id" value="<?php echo $row->product_id; ?>"  />
					<input type="text" name="quantity" value="01" class="form-control update_cart_field" /><?php echo form_error("quantity") ;?>
					<input type="submit" class="add_to_cart" value="أضف للسلة" />
				</form>
			</div>
			
		</div><!-- .product_info -->
    </div><!-- .col -->
</div><!-- .row -->
<div class="row no-gutters ">
		<div class="col">
			<div class="product-details">
			   <h1>معلومات المنتج</h1>
				<div class="entry">
					<?php $text = $this->admin_model->bb2html($row->details);
						echo $text ; 
					?>
				</div><!-- .entry -->
				<h2 style="font-size: 24px;">تقيمات المستخدمين</h2>
				<!--comment-->
				<button class="navbar-toggler comment-button" type="button" data-toggle="collapse" data-target="#comment_box">
					<b>أضف تعليق</b>	
				</button>
				
				<?php if(!empty($msg)){
						echo $msg.'<br>';
					   }
				?>
				<?php
				$valid = validation_errors();
				if (!empty($valid)) {?>
				<div class="comment_box" id="" >
				<?php }else{?>
				<div class="collapse navbar-collapse comment_box" id="comment_box" >
				<?php }?>
                        <table>
							<form method="post" action="<?php echo base_url().'pro/product_detail/'.$row->product_id;?>">
								<tr>
									<td>الاسم:</td>
									<td><input type="text" class="form-control" name="name" value="<?php  if(empty($msg)){echo set_value("name");} ?>"/><?php echo form_error("name") ;?></td>
								</tr>
								<tr>
									<td>التعليق:</td>
									<td><textarea id="comment" class="form-control" name="comment"  rows="4" col="20" ><?php  if(empty($msg)){echo set_value("comment");} ?></textarea><?php echo form_error("comment") ;?></td>
								</tr>
								<tr>
									<td colspan="2"><p align="left"><input type="submit" class="add_to_cart" value="اضف التعليق"/></p></td>
								</tr>
							</form>
						</table>
				</div>
				 <?php if (!empty($product_comment)) {?>
					 <?php for ($i = 0; $i < count($product_comment); $i++) {?>
						<div class="comment-area">
						  بواسطة : <b><?php echo $product_comment[$i]->name ;?></b>  في  <?php echo $product_comment[$i]->date ;?>
						   <p><?php echo $product_comment[$i]->comment ;?></p>
						</div>
					<?php   } ?> 
                    <?php   } ?> 
				
			
			<!--.comment-->	
			</div><!-- .product-details -->
		</div><!-- .product-details -->
    </div><!-- .row -->

	
	
    <div class="clear"></div>
    
</div><!-- .box -->
 <?php if (!empty($products)){?>
	<div class="mb-5">
	<?php foreach ($prev as $row): 
		$name  = str_replace(" ", "-", $row->name );
	?>
		<a href="<?php echo base_url().'pro/product_detail/'.$row->product_id."/".$name; ?>" class="left">المنتج التالي  &gt;&gt; </a>
	<?php   endforeach;    ?>
	<?php foreach ($next as $row): 
			$name  = str_replace(" ", "-", $row->name );
	?>
		<a href="<?php echo base_url().'pro/product_detail/'.$row->product_id."/".$name; ?>" class="right">&lt;&lt; المنتج السابق  </a>
	</div>
		<?php   endforeach;    ?>
<?php }?>

			<?php  endforeach;    ?>
			<?php }else{?>
			<div class="col">
				<div class="card product">
				<p align="center">
			عفوا هذا المنتج غير موجود حاليا
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
	
<script type="text/javascript">
	$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
<script type="text/javascript">
	$(document).ready(function() {
$('.body_off').click(function(){
$('*').css('cursor', 'wait');
   document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginRight= "auto";
  document.getElementById("main").style.opacity = "1";
  $('body').removeClass('invisible_body');
  $('#main').removeClass('body_off');
 // $('body').css({ "background": "#ededed" });
  document.getElementById("main").style.width = "100%";
  document.getElementById("main").style.position = "relative";
 });

});
</script>
</div><!-- .container -->
</body>
</html>