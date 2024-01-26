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
<style>
.cart_box:hover .block-mini-cart {
  display: none;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	
		$('.cart_delete').click(function(){
             
			var $t=$(this).attr('rel');
			var $v='<td colspan="6" style="text-align:center;"><img src="<?php echo base_url(); ?>images/admin/loadingAnimation.gif"/></td>';
			$('tr#'+$t).html($v);
			$.post('<?php echo base_url(); ?>cart/delete_from_cart/',{rowid:$t},function(data){
			$('tr#'+$t).remove();
			$.get("<?php echo base_url() ;?>cart/show_items_number", function(cart){ // Get the contents of the url cart/show_cart
				$(".item_num").html(cart+'  قطعة |سلة التسوق '); // Replace the information in the div #cart_content with the retrieved data
			});
								
			$.get("<?php echo base_url() ;?>cart/show_items_total", function(update_total){ // Get the contents of the url cart/show_cart
				$("#update_total").html(update_total); // Replace the information in the div #cart_content with the retrieved data
			});
				if($('#table_order > tbody > tr').size()==0)
					{
						$('#table_order > tbody').html('<tr><td colspan="5" alig="center">سله المشتروات فارغة</td></tr>');
					}
				});
                            
		});

        $('#submit').click(function(){
            var contents=$('input[name=contents]').val();
            if(contents==0)
            {
                alert('<?php echo "سله المشتروات فارغة" ;?>');
                return false;
            }else{
                $("#update_form").submit();
                return true;
            }
        });

        $('#checkout').click(function(){
            var contents=$('input[name=contents]').val();
            if(contents==0)
            {
                alert('<?php echo "سله المشتروات فارغه" ;?>');
                return false;
            }else{
             window.location = '<?php echo base_url(); ?>cart/checkout';
            }
        });

    });
</script>
	<div class="row no-gutters ">
	<div class="col">
		<div class="box table-responsive">
		<form action="<?php echo base_url() ;?>cart/update_cart" method="post" id="update_form">
            <input type="hidden" name="contents" value="<?php echo count($this->cart->contents()) ;?>" />
			 <!--<table class="main_table d-xl-block d-lg-block d-none" style="text-align:center;">-->
			<table class="main_table" id="table_order" style="text-align:center;">
				<tr class="head">
					<td class="first">الصورة</td>
					<td>اسم المنتج</td>
					<td>سعر القطعة</td>
					<td>الكمية</td>
					<td>إجمالى السعر</td>
					<td class="last">حذف</td>
				</tr>
				 <?php if (!$this->cart->contents()){ ?>
                        <tr>
                            <td colspan="2">لايوجد منتجات فى سلتك</td>
                        </tr>
                    <?php
                        }else{
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
				<tr id="<?php echo $items['rowid'] ;?>" > 
				<?php  $product_main_img = $this->products_model->GetProductMainImage($items['id']);?>
					<td><a href="<?php echo base_url() . "pro/product_detail/" . $items['id']."/".$items['name'] ;?>"><img src="<?php echo base_url().$product_main_img[0]->image_thumb  ;?>" class="order_thumb" alt="" /></a></td>
					<td dir="rtl"><a href="<?php echo base_url() . "pro/product_detail/" . $items['id']."/".$items['name']  ;?>"><?php echo $items['name'];?></a></td>
					<td align="center"><?php echo $items['price'];?> ريال</td>
					<td>
						<input type="hidden" name="rowid[]" value="<?php echo $items['rowid'] ;?>" />
						<input type="text"  name="qty[]" value="<?php echo $items['qty'] ;?>" class="form-control update_cart_field"/><?php echo form_error("qty[]") ;?>
					</td>
					<td><?php echo $this->cart->format_number($items['subtotal']) . ' ' ;?> ريال</td>
					<td>	
						<a href="#" title="" class="cart_delete" rel="<?php echo $items['rowid'] ;?>">
							<img src="<?php echo base_url() .'/images/icon_del.png' ;?>" alt="Delete" />
						</a>
					</td>
				</tr>
				  <?php }?>
						<?php if ($this->cart->contents()){ ?>

						<tr>
						    <td > </td>
							<td > </td>
							<td > </td>
								 
							<td ><strong>الاجمالي</strong></td>
							<td id="update_total"><?php echo $this->cart->format_number($this->cart->total());?> ريال</td>
							<td > </td>
						</tr>
                        <?php } ?>
				<?php } ?>
														
			</table>
		</form>

		<!--	<table class="main_table d-xl-none d-lg-none d-block table-responsive">
				<tr class="head">
					<td class="first w-md-35 w-50" style="text-align:center;">المنتج</td>
					<td >الكمية</td>
					<td style="text-align:center;">إجمالى السعر</td>
					<td class="last" width="5">حذف</td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<img src="images/img_big2.jpg" class="order_thumb" alt="" />
						<p>رواية بير الوطاويط وكتاب بدون سابق انذار</p>
						<p class="price_cart">السعر :100 ريال</p>
					</td>
					<td style="text-align:center;">1</td>
					<td style="text-align:center;">100 ريال</td>
					<td><a href="#"><img src="images/icon_del.png" alt="Delete" /></a></td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<img src="images/thumb.png" class="img-responsive" alt="" />
						<p>اسم المنتج</p>
						<p class="price_cart">السعر :100 ريال</p>
					</td>
					<td style="text-align:center;">1</td>
					<td>100 ريال</td>
					<td><a href="#"><img src="images/icon_del.png" alt="Delete" /></a></td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<img src="images/thumb.png" class="order_thumb" alt="" />
						<p>اسم المنتج
						اسم المنتج اسم المنتج اسم المنتج v اسم المنتج v v اسم المنتج اسم المنتج اسم المنتج</p>
						<p class="price_cart">السعر :100 ريال</p>
					</td>
					<td style="text-align:center;">1</td>
					<td>100 ريال</td>
					<td><a href="#"><img src="images/icon_del.png" alt="Delete" /></a></td>
				</tr>
														
			</table>-->
		
			<div class="bottom_buttons">
				<a href="<?php echo base_url() ;?>" class="red_button">متابعة التسوق</a>
				<a href="#" id="submit" class="red_button">تحديث السلة</a>
				<a href="#" id="checkout" class="red_button">إتمام الشراء</a>
			</div><!-- .bottom_buttons -->
		</div><!-- .box -->
	</div><!-- .col -->    
</div><!-- .row -->

	<?php  $this->load->view('includes/footer.php'); ?>

</div><!-- .container -->
</body>
</html>