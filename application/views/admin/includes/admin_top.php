<?php echo get_msg(); ?>

<div class="adminTop">
				<div class="hello" >
					<img src="<?php echo base_url();?>images/admin/icon_usernotvalidated.gif" width="14" border="0" height="16" /> أهلا بك  <?php
					$id=$this->session->userdata('admin_id');
					$this_admin = $this->admin_model->GetadminByID($id);	
					echo $this_admin[0]->username;?>
				</div>
				  <nav class="navbar navbar-expand-md bg navbar-light ">
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav">
					   <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>/webadmin">رئيسية لوحة التحكم</a>
					  </li>	
					  <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>" target="_blank">رئيسية الموقع</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="<?php echo base_url(); ?>webadmin/logout" onClick="return confirm('هل تريد الخروج من لوحة التحكم ؟');">تسجيل خروج</a>
					  </li>    
					</ul>
				  </div>  
				</nav>
</div>
<?php echo $this->input->cookie('admin_cookie',true);?>