<style>
.sidebar_menu {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 10000;
  top: 0;
  right: 0;
  background-color: #333;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top:15px;
-moz-box-shadow: inset 0px 2px 5px rgba(0,0,0,1);
-webkit-box-shadow: inset 0px 2px 5px rgba(0,0,0,1);
box-shadow: inset 0px 2px 5px rgba(0,0,0,1);
}

.sidebar_menu a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  color: #fff;
  display: block;
  transition: 0.3s;
  border-bottom: 1px solid #262626;
  padding: 10px 20px;
  font-size: 18px;
}

.sidebar_menu a:hover {
  color: #f1f1f1;
  background-color: #b3b3b3;

}

.sidebar_menu .closebtn {
  position: absolute;
  top: 0;
  left: 2px;
  font-size: 36px;
  border:none;

}
</style>

<div id="mySidebar" class="sidebar_menu">
	<ul class="navbar-nav sidebar_menu-nav" >
		<li class="mob-nav-item">  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
			<a class="mob-nav-link" href="<?php echo base_url(); ?>home/index" >الرئيسية</a>
		</li>	
		<li class="mob-nav-item">
			<a class="mob-nav-link" href="<?php echo base_url(); ?>pro/index">المنتجات</a>
		</li>
		<li class="mob-nav-item ">
			<a class="mob-nav-link " href="<?php echo base_url(); ?>pro/payment_methods">طرق الدفع</a>
		</li>
		<li class="mob-nav-item">
			<a class="mob-nav-link" href="<?php echo base_url(); ?>pro/offers">العروض</a>
		</li> 
		<li class="mob-nav-item">
			<a class="mob-nav-link" href="<?php echo base_url(); ?>home/contact">اتصل بنا</a>
		</li>
		<?php $data['pages']  = $this->pages_model->Getnavpages();
					if(!empty($data['pages'])){
				 for ($i = 0; $i < count($data['pages']); $i++) {
					 $name  = str_replace(" ", "-", $data['pages'][$i]->title );
				?>
		<li class="mob-nav-item">
			<a class="mob-nav-link" href="<?php echo base_url().'home/pages/'.$data['pages'][$i]->page_id.'/'.$name ;?>" ><?php echo $data['pages'][$i]->title ;?></a>
		</li>			
			<?php }?>
		<?php }?>
	</ul>
</div>