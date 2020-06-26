<?php

/*
Template Name: Member Template
*/

define( 'WP_USE_THEMES', false );
get_header('membership');

?>

<div class="main-content">
	<div class="welcome-message title">
		<h3>My Dashboard</h3>
		<p>Welcome to the Fix Your Front Desk Dashboard. Let's get started!</p>
	</div>

	<?php
		if(memb_hasAnyTags(array('139'))) {
	?>

		<div class="banner">
			<div>
				<img src="http://fixyourfrontdesk.com/wp-content/themes/frontofficeguru/images/FYFD-video-holder.png">
			</div>
			<div>
				<h3>Learn from the Front Office Guru...</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
				<a href="https://google.com" class="gb_button">Learn More</a>
			</div>
		</div>

	<?php
		}
	?>


	<div>
		<ul class="graphic_blocks gb_ads">
			<li class="gb_modules">
				<a href="/modules/">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Modules</span>
					<span class="gb_button">View Modules</span>
				</a>
			</li>
			<li class="gb_resources">
				<a href="">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Resources</span>
					<span class="gb_button">Download</span>
				</a>
			</li>
			<li class="gb_blog">
				<a href="/blog/">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Blog</span>
					<span class="gb_button">Check Out Blog</span>
				</a>
			</li>
			<li class="gb_faq">
				<a href="">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">FAQ's</span>
					<span class="gb_button">Ask Questions</span>
				</a>
			</li>
			<li class="gb_community">
				<a href="">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Community</span>
					<span class="gb_button">Join</span>
				</a>
			</li>
			<li class="gb_webinar">
				<a href="">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Webinars</span>
					<span class="gb_button">Get Access</span>
				</a>
			</li>
		</ul>
	</div>



</div>
