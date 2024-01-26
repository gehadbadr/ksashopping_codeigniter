<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>
<?php include 'includes/head.php';?>

<script language="javascript">
function firstrun()
{
document.forms[0].submit();

}
</script>

</head>

<body onload=" document.getElementById('myForm').submit();">
<div class="wrapper">
	
<?php include 'includes/navigator.php';?>

	<div class="clear"></div>
	
<div class="products">
	
    <div class="product">
	
		<?php
		/*<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal_auto_form" id="myForm"> 
		<input type="hidden" name="rm" value="2"> 
		<input type="hidden" name="cmd" value="_xclick"> 
		<input type="hidden" name="custom" value="1234567890"> 
		<input type="hidden" name="business" value="info@2windesign.com"> 
		<input type="hidden" name="currency_code" value="USD">
		<?php 
			$i=1;
					$item_number="";
					$quantity =0;
					$total=$this->cart->format_number($this->cart->total());
					
					$item_name="Total";
					$number = str_replace(",", "", $total);
					$price = round(($number/3.75)+0.5);
					
					foreach ($this->cart->contents() as $items) {
					$number =  $items['id'];
					$quan = $items['qty'];
					$item_number =$number .'/'.$item_number;
					$quantity =$quantity+$quan ;
				$i++;
				}?> 
		<input type="hidden" name="item_name" value="<?php echo $item_name ;?>"> 
		<input type="hidden" name="item_number" value="<?php echo $item_number; ?>">
		<input type="hidden" name="amount" value="<?php echo $price; ?>"> 
		<input type="hidden" name="quantity" value="1"> 
		
	
	<?php echo "<br /><br /><br /><br /><br />";?>
	
	<?php echo "<P align='center'>سيتم تحويلك الان علي paypal</P> ";?>
	<?php echo "<P align='center'>اذا لم يتم تحويلك بشكل تلقائي اضغط هنا</P>";?>
	<P align='center'><input type="image" src="<?php echo base_url() .'/images/images/paypal.jpg' ;?>" border="1"  name="submit" alt="Make payments with PayPal - it’s fast, free and secure!"></p> 
		
		<script type="text/javascript" language="javascript">
 document.getElementById('myForm').submit();
 </script>
          
		</form>*/
		?>
<?php	
	$paypal_form='';
		
		$paypal_form .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal_auto_form" id="myForm">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="sb-sifjj3706499@business.example.com">
<input type="hidden" name="return" value="'.base_url().'paypal/success">
<input type="hidden" name="cancel_return" value="'.base_url().'paypal/cancel">
<input type="hidden" name="notify_url" value="'.base_url().'paypal/ipn">';

$i = 0; 
foreach ($this->cart->contents() as $items) { 
$i++;
$item_id = $items['id'];
$item_name = $items['name'];
//$product_id = $items['product_id'];
$price = $items['price'];
$quantity = $items['qty'];


$paypal_form .='<input type="hidden" name="item_name_'.$i.'" value="'.$item_name.'">
<input type="hidden" name="item_number_'.$i.'" value="'.$item_id.'">
<input type="hidden" name="amount_'.$i.'" value="'.$price.'">
<input type="hidden" name="quantity_'.$i.'" value="'.$quantity.'">';

} // end foreach

$paypal_form .= '<input type="hidden" name="currency_code" value="USD">


	<br /><br /><br /><br /><br />
	
	<P align="center">سيتم تحويلك الان علي paypal</P>
	<P align="center">اذا لم يتم تحويلك بشكل تلقائي اضغط هنا</P>
	<P align="center"><input type="image" src="'.base_url() .'/images/images/paypal.jpg" border="1"  name="submit" alt="Make payments with PayPal - it’s fast, free and secure!"></p> 
		

<P align="center"><input type="submit" value="Pay with PayPal" class="pay_button"/></P>
</form>';

echo $paypal_form;
?>
	
	<?php //$this->cart->destroy(); ?>
	 </div><!-- .product -->
        	
</div><!-- .products -->
	


<?php include 'includes/footer.php';?>

</div><!-- .wrapper -->
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?TFkcfKtdVHXclyffEScyqgmsZbI7bZwS';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
</body>
</html>