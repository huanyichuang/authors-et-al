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

// Implode the authors array into a string.
$authors = implode( ' ', $authors );
$authors = $authors;
// Calculate the length of the authors string.
$authors_length = strlen( $authors );
$base_width = 100;

$et_al_str = $et_al ? ' et al.' : '';

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="authors-wrapper author-circle">
	<!-- Generate an SVG circle with the textpath of the authors string. -->
	<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" style="width: <?php echo $base_width ?>px">
		<!-- The #circlePath is a circle at the center of the svg block. The radius is 16px less than the svg block. Drawn clockwise. -->
		<path id="circlePath" d="M 50,50 m -<?php echo $base_width / 2 - 16 ?>,0 a <?php echo $base_width / 2 - 16 ?>,<?php echo $base_width / 2 - 16 ?> 0 1,1 <?php echo $base_width - 32 ?>,0 a <?php echo $base_width / 2 - 16 ?>,<?php echo $base_width / 2 - 16 ?> 0 1,1 -<?php echo $base_width - 32 ?>,0" fill="none" />

		<text font-size="<?php echo 100*pi() / $authors_length ?>" fill="#000" letter-spacing="1" font-family="sans-sarif">
			<textPath xlink:href="#circlePath" side="left" startOffset="5">
				<?php echo $authors . $et_al_str; ?>
			</textPath>
		</text>
	</svg>
</div>