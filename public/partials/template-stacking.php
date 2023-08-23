<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://huanyichuang.com/
 * @since      1.0.0
 *
 * @package    Authors_Et_Al
 * @subpackage Authors_Et_Al/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="authors-wrapper author-stacking">
	<?php foreach ( $authors as $author ) : ?>
		<span class="et-al-author">
			<?php echo $author; ?>
		</span>
	<?php endforeach; ?>
	<?php if ( $et_al ) : ?>
	<span class="et-al">
		<?php echo 'et al.'; ?>
	</span>
	<?php endif; ?>
</div>
