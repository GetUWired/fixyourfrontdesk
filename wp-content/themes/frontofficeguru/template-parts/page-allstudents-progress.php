<?php /*
Template Name: Fix Your Front Desk All Students Progress
*/


get_header('membership');

?>
<div class="main-content">
	<div class="title">
		<h3>Student Progress</h3>
	</div>
	<div class="graphic_blocks">
		<?php

			echo do_shortcode('[umbrella_list_children]

			[umbrella_ld_course_info contact_id={{contact.id}} fields=firstname]
			
			[/umbrella_list_children]');
		?>
	</div>
</div>

