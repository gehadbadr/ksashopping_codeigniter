<?php echo get_msg(); ?>
<b>
    <img src="<?php echo base_url(); ?>images/admin/icon_usernotvalidated.gif" width="14" border="0" height="16"/> أهلا بك
    <img src="<?php echo base_url(); ?>images/admin/icon_block.gif" width="12" border="0" height="12"/>

    <a href="<?php echo base_url(); ?>/webadmin">
								رئيسية لوحة التحكم</a>
    <img src="<?php echo base_url(); ?>images/admin/icon_block.gif" width="12" border="0" height="12"/>
    <a target="_blank" href="<?php echo base_url(); ?>">رئيسية
								الموقع</a><span lang="en-us">
    </span>
    <img src="<?php echo base_url(); ?>images/admin/icon_block.gif" width="12" border="0" height="12"/><span lang="en-us">
    </span><a href="<?php echo base_url(); ?>webadmin/logout" onClick="return confirm('هل تريد الخروج من لوحة التحكم ؟');">تسجيل	خروج</a>
</b>
<?php echo $this->input->cookie('admin_cookie',true);
?>