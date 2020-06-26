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
            <p style="display: block;"><a href="<?php get_template_directory_uri(); ?>/member-dashboard">< Dashboard</a></p>
        </div>    
    </div>
    <div>

        <ul class="graphic_blocks">

            <?php
            $args= array('post_type' => 'sfwd-courses',
                        'post_status' => 'publish',
                        'order' => 'ASC',
                        'orderby' => 'ID',
                        'mycourses' => false,
                        'posts_per_page'=>-1
                    );

            $loop = new WP_Query( $args );

             while ( $loop->have_posts() ) : $loop->the_post();
                echo "<pre>";
                // print_r($post);
                echo "</pre>";

                $ID = $post->ID;

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
                $listitem .= do_shortcode("[course_notstarted course_id='".$ID."']<img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/lock.png'/>[/course_notstarted]");

                $listitem .= "</a>";
                $listitem .= "</li>";

                echo $listitem;


                $lock = "<div>";



                endwhile;

            ?>

        </ul>
        
    </div>

</div>