<?php

/**

Template Name: Fix Your Front Desk Course Blog Roll Template

**/

get_header('membership');


?>

<div class="main-content">
    <div class="title">
        <h3>Modules</h3>
        <div class="post-title main-title">
            <p style="display: block;"><a href="<?php get_template_directory_uri(); ?>/member-dashboard"> > Dashboard</a></p>
        </div>    
    </div>

    <div>

        <ul class="graphic_blocks">

            <?php
            $args= array('post_type' => 'sfwd-courses',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                        'orderby' => 'menu_order',
                        'mycourses' => false,
                        'posts_per_page'=>-1
                    );

            $loop = new WP_Query( $args );

             while ( $loop->have_posts() ) : $loop->the_post();
                // echo "<pre>";
                // print_r($post);
                // echo "</pre>";

                $ID = $post->ID;

                // echo do_shortcode("[memb_learndash_id_enrolled id='". $ID . "']");

                $link = get_the_permalink();



                $listitem = "<li>";
                $listitem .= "<a href='". $link . "'>";
                $listitem .= "<div class='course_title'>";
                $listitem .= "<h4>" . $post->post_title . "</h4>";
                $listitem .= "<p>";
                $listitem .= do_shortcode("[learndash_course_progress course_id='".$ID."']");
                $listitem .= "</p>";   
                $listitem .= "</div>";
                $listitem .= "<div class='course_description'>";           
                $listitem .= "<span class='course_content'>" . $post->post_excerpt . "</span>";
                $listitem .= "<span class='gb_button'>";
                
                $listitem .= do_shortcode("[course_notstarted course_id='".$ID."']Begin Module[/course_notstarted]");
                $listitem .= do_shortcode("[course_inprogress course_id='".$ID."']Complete Module[/course_inprogress]");
                $listitem .= do_shortcode("[course_complete course_id='".$ID."']Review Module[/course_complete]");


                $listitem .= "</span>";
                $listitem .= "</div>";

                //If Module 1 and don't have the Module 0 - Complete tag
                if ($ID == 7068 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=177 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }

                // if Module 2 and don't have the Module 1 - Complete tag
                if ($ID == 6896 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=179 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }

                // if Module 3 and don't have the Module 2 - Complete tag
                if ($ID == 6887 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=181 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }

                // if Module 4 and don't have the Module 3 - Complete tag
                if ($ID == 7235 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=183 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }

                // if Module 5 and don't have the Module 4 - Complete tag
                if ($ID == 7352 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=185 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }

                // if Module 6 and don't have the Module 5 - Complete tag
                if ($ID == 7627 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=187 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }                

                // if Module 7 and don't have the Module 6 - Complete tag
                if ($ID == 7646 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=189 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }  

                // if Module 8 and don't have the Module 7 - Complete tag
                if ($ID == 7656 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=191 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                }  

                // if Module 9 and don't have the Module 8 - Complete tag
                if ($ID == 7671 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=193 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                } 

                // if Module 10 and don't have the Module 9 - Complete tag
                if ($ID == 7683 ) {
                    $listitem .= do_shortcode("[memb_has_any_tag tagid=195 not='not']<div class='learndash-course-inprogress-message'><p><img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/></p></div>[/memb_has_any_tag]");
                } 



                $listitem .= "</a>";
                $listitem .= "</li>";

                echo $listitem;

                $lock = "<div>";

                endwhile;

            ?>
                <!-- $listitem .= do_shortcode("[course_notstarted course_id='".$ID."']<img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/>[/course_notstarted]"); -->
        </ul>
        
    </div>

</div>