
<ul class="bottom_nav">
	    <li><a href="<?php echo base_url(); ?>home/index">الرئيسية</a></li>
			<li><a href="<?php echo base_url(); ?>pro/index"  >المنتجات</a></li>
			<li><a href="<?php echo base_url(); ?>pro/payment_methods" >طرق الدفع</a></li>
			<li><a href="<?php echo base_url(); ?>home/contact">اتصل بنا</a></li>
			
			<?php $data['pages']  = $this->pages_model->Getnavpages();
				if(!empty($data['pages'])){
			 for ($i = 0; $i < count($data['pages']); $i++) {
				 $name  = str_replace(" ", "-", $data['pages'][$i]->title );
			?>
					
					 <li ><a href="<?php echo base_url().'home/pages/'.$data['pages'][$i]->page_id.'/'.$name ;?>" ><?php echo $data['pages'][$i]->title ;?></a> </li>
 
				
			 <?php }?>
			  <?php }?>
			<!-- .pages -->
</ul>


<div class="footer">
جميع الحقوق محفوظة لـ ksashopping &copy; | تصميم وبرمجة: <a href="#">توين ديزاين</a>
</div><!-- .footer -->
