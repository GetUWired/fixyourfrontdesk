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
				<img src="https://fixyourfrontdesk.com/wp-content/uploads/2020/06/Dee-headshot-1.jpg">
			</div>
			<div><h3>Fix Your Front Desk Academy</h3>
				<p>Our goal is to help you learn the necessary skills and obtain the knowledge to be in command of a super-efficient and productive front desk.</p> 
				<p>Use these resources, tools, and training to become a highly skilled Patient Care Coordinator, so you can help more people.</p> 
				<p>- Dee Bills, MSPT and Front Office Guru</p>
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
				<a href="/faq/">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">FAQ's</span>
					<span class="gb_button">Ask Questions</span>
				</a>
			</li>
			<li class="gb_community">
				<a href="https://www.facebook.com/groups/FYFDAcademy/" target="_blank">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Community</span>
					<span class="gb_button">Join</span>
				</a>
			</li>
			<li class="gb_webinar">
				<a href="/webinars/">
					<span class="gb_top_image"></span>
					<span class="gb_icon"></span>
					<span class="gb_text">Webinars</span>
					<span class="gb_button">Get Access</span>
				</a>
			</li>
		</ul>
	</div>



</div>
