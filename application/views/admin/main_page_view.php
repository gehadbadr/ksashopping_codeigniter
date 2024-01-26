<html>
<head>
<?php  $this->load->view('admin/includes/head.php'); ?>
<title>لوحة التحكم | الرئيسية</title>
</head>
<body>

	<div class="container">
		<header>
		<?php  $this->load->view('admin/includes/admin_top.php'); ?>
	    </header> 
		<div class="row no-gutters">
		<div class="col-12  content">
			<p class="top">القائمة الرئيسية</p>
			<div class="module-body" >
			<div class="row row-cols-lg-5 row-cols-md-3 row-cols-2 main">
			
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/slider"><img src="<?php echo base_url();?>images/admin/banner.png" width="48" height="48" border="0"/><br/>
				عارض الشرائح</a>	
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/video"><img src="<?php echo base_url();?>images/admin/ads.png" width="48" height="48" border="0"/><br/>
				الفيديو</a>	
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/catigory/"> <img src="<?php echo base_url();?>images/admin/category.png" width="48" height="48" border="0"/><br/>
				التصنيفات</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/product/"> <img src="<?php echo base_url();?>images/admin/img_bags.jpg" width="48" height="48" border="0"/><br/>
				المنتجات</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/comment/"> <img src="<?php echo base_url();?>images/admin/img_bags.jpg" width="48" height="48" border="0"/><br/>
				التعليقات الخاصة بالمنتجات</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/payment/"> <img src="<?php echo base_url();?>images/admin/payment.png" width="48" height="48" border="0"/><br/>
				طرق الدفع</a>	
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/pay_confirm/"> <img src="<?php echo base_url();?>images/admin/confirmation.png" width="48" height="48" border="0"/><br/>
				تاكيد التحويل</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/inbox/"> <img src="<?php echo base_url();?>images/admin/inbox.gif" width="48" height="48" border="0"/><br/>
				صندوق الرسائل</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/order"><img src="<?php echo base_url();?>images/admin/orders.png" width="48" height="48" border="0"/> <br/>
				صندوق الطلبات</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/newsletter"><img src="<?php echo base_url();?>images/admin/inbox.png" width="48" height="48" border="0"/><br/>
				النشرة الاخبارية</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/contact"><img src="<?php echo base_url();?>images/admin/facebook_icon.gif" border="0" width="48" height="48"/><br/>
				معلومات الاتصال</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/facebook"><img src="<?php echo base_url();?>images/admin/banner.png" border="0" width="48" height="48"/><br/>
				صغحات التواصل الاجتماعي</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/pages"><img src="<?php echo base_url();?>images/admin/category.png" width="48" height="48" border="0"/><br/>
				الصفحات الداخلية</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/admins"><img src="<?php echo base_url();?>images/admin/user.png" width="48" height="48" border="0"/><br/>
				مدير المستخدمين</a>
			</div>
			<div class="col child">
				<a href="<?php echo base_url();?>webadmin/logout" onClick="return confirm('هل تريد الخروج من لوحة التحكم ؟');">
				<img src="<?php echo base_url();?>images/admin/logout.gif" border="0" width="48" height="48"/><br/>تسجيل خروج </a>
			</div>
		</div>
		
	
			</div> 	
		</div>
		</div>
		<?php  $this->load->view('admin/includes/footer.php'); ?>       

    </div>
</body>
</html>