<link href="<?php echo base_url(); ?>css/jquery.treeview.rtl.css" rel="stylesheet" type="text/css"/>
				<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.treeview.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						$("#browser").treeview({
						});
					});
				</script>	
			<ul id="browser" class="filetree treeview-famfamfam">
				<li><span class="folder"> <a href="<?php echo base_url(); ?>webadmin"> لوحة التحكم </a></span>
					<ul>  
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/slider">عارض الشرائح</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/ads">الاعلانات</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/video">الفيديو</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/catigory">التصنيفات</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/product">المنتجات</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/comment">التعليقات الخاصة بالمنتجات</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/payment">طرق الدفع</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/pay_confirm">تاكيد التحويل</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/inbox">صندوق الرسائل</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/order">صندوق الطلبات</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/newsletter">النشرة الاخبارية</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/contact">معلومات الاتصال</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/facebook">صغحات التواصل الاجتماعي</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/pages">الصفحات الداخلية</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/buyers">المشترون</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/buyer_report">المشترون المبلغ عنهم</a></span></li>
						<li><span class="file"> <a href="<?php echo base_url(); ?>webadmin/admins">مدير المستخدمين </a></span></li>
						<li><span class="file"><a href="<?php echo base_url(); ?>webadmin/logout" onClick="return confirm('هل تريد الخروج من لوحة التحكم ؟');"> تسجيل خروج </a></span></li>
					</ul>
				</li>		
			</ul>		
			
			
	