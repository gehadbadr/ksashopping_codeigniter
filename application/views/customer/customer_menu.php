
	<div class="col-md-4 col-12">
		<div class="box contact_col ml-md-3">

			<div class="inside">
<div class="account-userInfo">
    <div class="avatar"><img src="<?php echo base_url();?>images/customer_icon.jpg" width="55" height="55" alt="" /></div>
    <div class="main-icon"><a href="https://egypt.souq.com/eg-ar/account_settings.php" class="main-icon"><h3>Gehad  </h3><small>gehad.bader@gmail.com</small></a></div>
</div>	
<ul class="user_menu_list p-0">
						<li <?php if (isset($account_link) && ($account_link == TRUE)) { ?> class="active"<?php }else{?>class="" <?php }?>>
							<p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: cornflowerblue;" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
</svg> <a href="<?php echo base_url(); ?>customer/profile" > حسابي</a></p>
						</li>
						<li class="">
							<p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: cornflowerblue;" class="bi bi-cart4" viewBox="0 0 16 16">
  <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
</svg> مشترياتي</p>
						</li>
						<li class="">
							<p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: cornflowerblue;" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
</svg> القوائم المفضلة</p>
						</li>
						<li <?php if (isset($address_link) && ($address_link == TRUE)) { ?> class="active"<?php }else{?>class="" <?php }?>>
							<p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: cornflowerblue;" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
</svg><a href="<?php echo base_url(); ?>customer/address" > عناويني</a></p>
						</li>	
						<li <?php if (isset($edit_link) && ($edit_link == TRUE)) { ?> class="active"<?php }else{?>class="" <?php }?>>
							<p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: cornflowerblue;" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg><a href="<?php echo base_url(); ?>customer/edit" > تعديل الحساب</a></p>
						</li>	
						<li class="">
							<p><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" style="color: cornflowerblue;" class="bi bi-power" viewBox="0 0 16 16">
  <path d="M7.5 1v7h1V1h-1z"/>
  <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
</svg><a href="<?php echo base_url(); ?>customer/logout"  > تسجيل خروج</a></p>
						</li>
						
					</ul>
			</div><!-- .inside -->
			
		</div><!-- .box -->
	</div><!-- .col -->
