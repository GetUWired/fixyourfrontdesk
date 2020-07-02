<?php

/**

Template Name: Fix Your Front Desk Lesson Blog Roll Template

**/

get_header('membership');


?>

<div class="main-content">
    <div class="title">
        <h2>My Lessons</h2>
<!--         <div>
            <a href="<?php //get_template_directory_uri(); ?>/member-dashboard"><i class="fa fa-angle-left"></i>Dashboard</a>
            <a href="<?php //get_template_directory_uri(); ?>/course-listing/"><i class="fa fa-angle-left"></i>My Modules: </a>
            <span><?php //echo single_post_title(); ?>: Lessons</span>
        </div> -->
        <div class="post-title main-title">
            <p style="display: block;"><a href="<?php get_template_directory_uri(); ?>/member-dashboard">Dashboard</a><span> > </span><a href="<?php get_template_directory_uri(); ?>/modules/">My Modules: </a><span> > </span> Lessons</p>
        </div>   
        
    </div>
	<div class="course_info">
		<!-- div class="course_list_wrapper">
            <div class="current_course"> -->
                <!-- <h3><?php //echo the_title(); ?></h3> -->
                <!-- <div><?php  
                    // $singleId = $post->ID;
                    // echo do_shortcode('[learndash_course_progress course_id"' . $singleId . '""]');
                ?></div>
            </div>

            <?php 

                //echo "<div class='course_heading'>" . the_title() . "</div>";
                // echo do_shortcode('[course_content course_id"' . $singleId . '""]');
                //echo do_shortcode('[course_content]');
                // echo do_shortcode('[ld_course_list]');
             ?>

        </div>  
		<div>

	        <ul class="graphic_blocks">

	            <?php

	            // want to filter lessons that are showing by the course that is highlighted in the course menu

	            // $args = array('post_type' => 'sfwd-lessons',
	            //             'post_status' => 'publish',
	            //             'order' => 'ASC',
	            //             'orderby' => 'ID',
	            //             'mylessons' => false,
	                      
	            //         );

	            // $loop = new WP_Query( $args );

	            //  while ( $loop->have_posts() ) : $loop->the_post();
	            //     echo "<pre>";
	            //     print_r($loop);
	            //     echo "</pre>";

	                // $ID = $post->ID;

	                // $link = get_the_permalink();



	                // $argsLessons = array('post_type' => 'sfwd-lessons',
	                //         'post_status' => 'publish',
	                //         'order' => 'ASC',
	                //         'orderby' => 'ID',
	                //         'post_parent' => $loop->ID,
	                //     );

	                // $loopChild = new WP_Query($argsLessons);



	                // while ( $loopChild->have_posts() ) : $loopChild->the_post();

	                // echo "<pre>";
	                // print_r($loopChild);
	                // echo "</pre>";	                	


		                // $listitem = "<li>";
		                // $listitem .= "<a href='". $link . "'>";
		                // $listitem .= "<div class='course_title'>";
		                // $listitem .= "<h4>" . $post->post_title . "</h4>";
		                // $listitem .= "<p>";
		                // $listitem .= do_shortcode("[learndash_course_progress course_id='".$ID."']");
		                // $listitem .= "</p>";   
		                // $listitem .= "</div>";
		                // $listitem .= do_shortcode("[course_notstarted course_id='".$ID."']<img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png' style='margin: 10px auto;'/>[/course_notstarted]");
		                // $listitem .= "<div class='course_description'>";           
		                // $listitem .= "<span class='course_content'>" . $post->post_excerpt . "</span>";
		                // $listitem .= "<span class='gb_button'>";
		                
		                // $listitem .= do_shortcode("[course_notstarted course_id='".$ID."']Begin Module[/course_notstarted]");
		                // $listitem .= do_shortcode("[course_inprogress course_id='".$ID."']Complete Module[/course_inprogress]");
		                // $listitem .= do_shortcode("[course_complete course_id='".$ID."']Review Module[/course_complete]");


		                // $listitem .= "</span>";
		                // $listitem .= "</div>";
		                // $listitem .= "</a>";
		                // $listitem .= "</li>";

		                // echo $listitem;


		                // $lock = "<div>";


	                // endwhile;

	            // endwhile;

	            ?>

	        </ul>
	        
	    </div>

	</div>