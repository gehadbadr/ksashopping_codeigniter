<?php echo get_msg(); ?>
<div class="fyt "  style="float:left;">
		<?php $data['face']  = $this->admin_model->GetfaceData();
				if(!empty($data['face'])){?>		
			<a href="<?php echo $data['face'][0]->youtube;?>" style="text-decoration:none;" class="" target="_blank"><img src="<?php echo base_url();?>images/youtube-icon.png" alt=""  /></a>
			<a href="<?php echo $data['face'][0]->facebook ;?>" style="text-decoration:none;" class="" target="_blank"><img src="<?php echo base_url();?>images/Facebook-icon.png" alt=""/></a>
			<a href="<?php echo $data['face'][0]->twitter;?>" style="text-decoration:none;" class="" target="_blank"><img src="<?php echo base_url();?>images/Twitter-icon.png" alt="" /></a>
			 <?php }?>
</div><!-- .fyt -->
<div class=""  style="float:right;">
<?php
    if ($this->session->userdata('customer_logged')) {
		$id=$this->session->userdata('customer_id');
		$this_customer = $this->customers_model->GetCustomerByID($id);	      
?>
<div class="user_logo"  style="">
		<a><b><p class="user_logo_name"><?php echo mb_substr($this_customer[0]->fname,0,1); ?></p></a>	</b>
		    <div class="user_menu" >
				<div class="user_menu_list">
					<ul class="p-0">
						<li class="">
							<p><a href="<?php echo base_url(); ?>customer/profile" >حسابي</a></p>
						</li>
						<li class="">
							<p>مشترياتي</p>
						</li>
						<li class="">
							<p>القوائم المفضلة</p>
						</li>
						<li class="">
							<p>حركات حسابي</p>
						</li>
						<li class="">
							<p><a href="<?php echo base_url(); ?>customer/logout" class="red" > تسجيل خروج</a></p>
						</li>
					</ul>
				</div>
		  	</div>
	</div><!-- .user -->
	<?php } else {?>
	<div class="login">
		<b><a href="<?php echo base_url();?>customer/login" style="" class="red_button">تسجيل دخول</a>	
					</b>
	</div><!-- .login -->
	
	<?php }?>

	<div class="cart_box " style="float:right;"  >
					<b><img class="cart_img" src="<?php echo base_url();?>images/cart.png" alt=""/><a  style="" class="item_num"><?php echo $this->cart->total_items();?> قطعة |سلة التسوق</a>	
					</b>
		<div class="block-mini-cart p-2 pb-3" >
		  <div class="cart_items mini-cart-content">
			<form>
			<?php if (!$this->cart->contents()){ ?>
			    <div class="mini-cart-list p-2" style="border:none;">
					<ul class="p-0">
						<li class="product-info">
							
							<div class="p-right" >
								<p class="p-name" style="padding-right: 20px;">لايوجد منتجات فى سلتك</p>
								
							</div>
						</li>
				    </ul>
				</div>
                    <?php
                        }else{
							echo'<h5 class="mini-cart-head" style="color: #666;">اجمالي المشتريات في سلة التسوق '. $this->cart->total_items().' قطعة	</h5>';
                            $totalship = 0;   
                            foreach ($this->cart->contents() as $items) {
                                $url = '';
                                $slug = explode(' ', $items['name']);
                                $x = 0;
                                foreach ($slug as $value) {
                                    if ($x == 0) {
                                        $url .= $value;
                                        $x++;
                                    }else
                                        $url .= '-' . $value;
                                }
                             /*   $totalship+= ( $items['ship'] * $items['qty']);*/
					?>
				<div class="mini-cart-list">
					<ul class="p-0">
						<li class="product-info">
							<div class="p-2" style="float:left">
								<a class="product-info-name" href="<?php echo base_url() . "pro/product_detail/" . $items['id']."/".$items['name'] ;?>">
								<?php  $product_main_img = $this->products_model->GetProductMainImage($items['id']);?>
									<img class="img-responsive" src="<?php echo base_url().$product_main_img[0]->image_thumb  ;?>" alt="Product">
								</a>
							</div>
							<div class="p-right" >
							<a href="<?php echo base_url() . "pro/product_detail/" . $items['id']."/".$items['name'] ;?>">
								<p class="p-name"><?php echo $items['name'];?></p>
								<p class="price_cart">  EGP <?php echo $items['price'];?>  </p>
								<p>الكمية:<?php echo $items['qty'] ;?></p>
							</a>	
							</div>
						</li>
				    </ul>
				</div>
				<div class="clearfix"></div>
	            <?php } ?>
				<div class="toal-cart">
					<span>الاجمالي:</span>
					<span class="toal-price pull-right">  EGP <?php echo $this->cart->format_number($this->cart->total());?> </span>
					<br>
					<span>رسوم شحن:</span>
					<span class="toal-price pull-right">  EGP  0  </span>
					<br>
					<span>الاجمالي النهائي:</span>
					<span class="toal-price pull-right">  EGP <?php echo $this->cart->format_number($this->cart->total());?> </span>
					<br>
				</div>
				<div class="cart-buttons mt-2 mb-4">
					<a href="<?php echo base_url() ;?>cart/order" class="red_button p-1">معاينة السلة
						<span class="icon"></span>
					</a>
					<a href="<?php echo base_url() ;?>" class="red_button p-1">متابعة التسوق
						<span class="icon"></span>
					</a>
				</div>
			<?php } ?>
			</form>
		   </div>
		</div>
		
	</div> <!--.cart_box -->
</div>	
	<div class="clearfix"></div>
<nav class="navbar navbar-expand-md bg no-gutters nav-bar" >
	<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="" onclick="openNav()" >
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse  " id="collapsibleNavbar">
		<ul class="navbar-nav "  >
			<li class="nav-item">
				<a href="<?php echo base_url(); ?>home/index" <?php if (isset($home_link) && ($home_link == TRUE)) { ?> class="nav-link active pr-lg-5 pl-lg-5"<?php }else{?>class="nav-link pr-lg-5 pl-lg-5" <?php }?>>الرئيسية</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url(); ?>pro/index" <?php if (isset($cat_link) && ($cat_link == TRUE)) { ?> class="nav-link active pr-lg-5 pl-lg-5"<?php }else{?>class="nav-link pr-lg-5 pl-lg-5" <?php }?>>المنتجات</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url(); ?>pro/payment_methods" <?php if (isset($pay_link) && ($pay_link == TRUE)) { ?> class="nav-link active pr-lg-5 pl-lg-5"<?php }else{?>class="nav-link pr-lg-5 pl-lg-5" <?php }?>>طرق الدفع</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url(); ?>pro/offers" <?php if (isset($offer_link) && ($offer_link == TRUE)) { ?> class="nav-link active pr-lg-5 pl-lg-5"<?php }else{?>class="nav-link pr-lg-5 pl-lg-5" <?php }?>>احدث العروض</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url(); ?>home/contact" <?php if (isset($contact_link) && ($contact_link == TRUE)) { ?> class="nav-link active pr-lg-5 pl-lg-5"<?php }else{?>class="nav-link pr-lg-5 pl-lg-5" <?php }?>>اتصل بنا</a>
			</li>
			<?php $data['pages']  = $this->pages_model->Getnavpages();
					if(!empty($data['pages'])){
				 for ($i = 0; $i < count($data['pages']); $i++) {
					 
				$name  = str_replace(" ", "-", $data['pages'][$i]->title );
			
				?>
			<!--<li class="nav-item">
				<a href="<?php echo base_url().'home/pages/'.$data['pages'][$i]->page_id.'/'.$name ;?>" <?php if (isset($pages_link_id) && $pages_link_id==$data['pages'][$i]->page_id) { ?> class="nav-link active"<?php }else{?>class="nav-link" <?php }?>><?php echo $data['pages'][$i]->title ;?></a>
			</li>-->
				<?php }?>
			<?php }?>			
		</ul>
	</div>
</nav><!-- #nav-bar --> 
<style>
.invisible_body{
	background-color:#000;
}
.body_off {
	opacity: 0.8;
	background-color:silver;
}
</style>
<script>
function openNav(){
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginRight = "250px";
  document.getElementById("main").style.display = "block"; 
  document.getElementById("main").style.width = "100vw";
  document.getElementById("main").style.position = "fixed";
  document.getElementById("mySidebar").style.opacity = "1";
  document.getElementById("main").style.opacity = "0.5";
  $('body').addClass('invisible_body');
  $('#main').addClass('body_off');
  $('#mySidebar').removeClass('body_off');
  
  
  
// document.getElementById("main").addEventListener("click", closeNav);
}

 //$('.body_off').click(function(){
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

//$('.body_off').click(closeNav());


function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginRight= "auto";
  document.getElementById("main").style.opacity = "1";
  $('body').removeClass('invisible_body');
  $('#main').removeClass('body_off');
 // $('body').css({ "background": "#ededed" });
  document.getElementById("main").style.width = "100%";
  document.getElementById("main").style.position = "relative";

}
/*function(openNav){if(f(openNav.target).hasClass("invisible_body"))return b.isActive?b.close():c.close(),!1}*/
</script>
<script type="text/javascript">
$(document).ready(function(){
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
					