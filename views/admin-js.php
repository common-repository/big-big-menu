<script type="text/javascript">
jQuery(document).ready(function() {
	
	// ENABLE SAVE BUTTON
	jQuery('#BigBigMenuSaveButton').click(function() {
		bigbigmenuupdate();
	});
	
	// ENABLE HOME TOGGLE
	jQuery('#item_home .toggle').click(function() {
		home = (jQuery(this).parent().toggleClass("yes").hasClass("yes") ? 1 : 0);
		jQuery.post("<?=bloginfo('url')?>/wp-admin/admin-ajax.php", { 'action': "bigbig_menu_ajax_toggle_home", 'cookie': encodeURIComponent(document.cookie), 'bigbig_menu_home': home },
		function(responseString)
		{
			if (responseString == '1') {
				jQuery('#BigBigMenuConfirmSaveMenu').stop().show(1).fadeTo(1,1).fadeTo(1000,1).fadeTo(1000,0);
			}
		});
		return false;
	});
	
	// ENABLE SORTABLE LIST
	menulist = Sortable.create('BigBigMenuList'); // prototype
	jQuery('#BigBigMenuList').find('.del').click(function() {
		jQuery(this).parent().parent().fadeTo('fast',0).slideUp('fast',function() {
			jQuery(this).remove();
			//bigbigmenuupdate();
		});
		return false;
	});
	
	// ENABLE EXTERNAL LINK FORM
	//jQuery('#BigBigExternalLink').submit(function() {
	//	alert('hi');
	//	return false;
	//});
	
	// TABBIFY SOURCE MENU ITEMS
	//jQuery('#BigBigMenuParts .tabs').ui.tabs();
	(function($) { $('#BigBigMenuParts .tabs').tabs(); })(jQuery)
	
	// ENABLE SOURCE MENU ITEMS
	// on click, clone the object and add to the end of the list
	jQuery('.parts .add').click(function() {
		newitem = jQuery(this).parent().parent().clone().unbind('click').hide().appendTo('#BigBigMenuList').fadeIn('slow');
		jQuery(newitem).find('.add').replaceWith('<a class="control del">Del</a>');
		jQuery(newitem).find('.del').click(function() {
			jQuery(this).parent().parent().fadeTo('fast',0).slideUp('fast',function() {
				jQuery(this).remove();
				//bigbigmenuupdate();
			});
			return false;
		});
		menulist = Sortable.create('BigBigMenuList'); // prototype
		//bigbigmenuupdate();
		return false;
	});
	
	// ENABLE INSERTMETHOD RADIO BUTTONS
	jQuery('#BigBigMenuInsertMethod :radio').change(function() {
		insertmethod = jQuery('#BigBigMenuInsertMethod :checked').val();
		jQuery.post("<?=bloginfo('url')?>/wp-admin/admin-ajax.php", { 'action': "bigbig_menu_ajax_set_insertmethod", 'cookie': encodeURIComponent(document.cookie), 'bigbig_menu_insertmethod': insertmethod },
		function(responseString)
		{
			if (responseString == '1') {
				jQuery('#BigBigMenuConfirmSaveOptions').stop().show(1).fadeTo(1,1).fadeTo(1000,1).fadeTo(1000,0);
			}
		});
		return false;
	});
	
	// ENABLE WHICHCSS RADIO BUTTONS
	if ('plugin' != jQuery('#BigBigMenuWhichCSS :checked').val()) {
		jQuery('#BigBigMenuOrientation input').attr('disabled','disabled');
		jQuery('#BigBigMenuOrientation').css('color','#999');
	}
	jQuery('#BigBigMenuWhichCSS :radio').change(function() {
		whichcss = jQuery('#BigBigMenuWhichCSS :checked').val();
		jQuery.post("<?=bloginfo('url')?>/wp-admin/admin-ajax.php", { 'action': "bigbig_menu_ajax_set_whichcss", 'cookie': encodeURIComponent(document.cookie), 'bigbig_menu_whichcss': whichcss },
		function(responseString)
		{
			if (responseString == '1') {
				jQuery('#BigBigMenuConfirmSaveOptions').stop().show(1).fadeTo(1,1).fadeTo(1000,1).fadeTo(1000,0);
			}
		});
		if ('plugin' != whichcss) {
			jQuery('#BigBigMenuOrientation input').attr('disabled','disabled');
			jQuery('#BigBigMenuOrientation').css('color','#999');
		} else {
			jQuery('#BigBigMenuOrientation input').removeAttr('disabled');
			jQuery('#BigBigMenuOrientation').css('color','#000');
		}
		return false;
	});
	
	// ENABLE ORIENTATION RADIO BUTTONS
	jQuery('#BigBigMenuOrientation :radio').change(function() {
		orientation = jQuery('#BigBigMenuOrientation :checked').val();
		jQuery.post("<?=bloginfo('url')?>/wp-admin/admin-ajax.php", { 'action': "bigbig_menu_ajax_set_orientation", 'cookie': encodeURIComponent(document.cookie), 'bigbig_menu_orientation': orientation },
		function(responseString)
		{
			if (responseString == '1') {
				jQuery('#BigBigMenuConfirmSaveOptions').stop().show(1).fadeTo(1,1).fadeTo(1000,1).fadeTo(1000,0);
			}
		});
		return false;
	});
	
});

// IT'S ALL PROTOTYPE BELOW THIS
function bigbigmenuupdate() {
	var order = escape(Sortable.sequence('BigBigMenuList')); // prototype
	jQuery.post("<?=bloginfo('url')?>/wp-admin/admin-ajax.php", { 'action': "bigbig_menu_ajax_update_menu_order", 'cookie': encodeURIComponent(document.cookie), 'bigbig_menu_order': order },
	function(responseString)
	{
		if (responseString == '1') {
			jQuery('#BigBigMenuConfirmSaveMenu').stop().show(1).fadeTo(1,1).fadeTo(1000,1).fadeTo(1000,0);
		}
	});
}

</script>