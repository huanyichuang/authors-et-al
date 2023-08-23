<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://huanyichuang.com/
 * @since      1.0.0
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
/**
 * Display settings fields.
 */
?>
<form action="options.php" method="post">
	<?php
	settings_fields( 'authors-et-al-settings-group' );
	do_settings_sections( 'authors-et-al' ); 
	submit_button();
	?>
</form>
