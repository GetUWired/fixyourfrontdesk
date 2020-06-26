<?php
/**
 * The Template for displaying all single posts in Learndash.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */

 get_header('membership'); 


	// $banner_image = get_user_meta( $user_id, 'banner_image', true );


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php $all_keys = get_post_custom_keys(); ?>

<?php $course_name = '<a href="'.get_the_permalink(get_post_meta( $post->ID, 'course_id', TRUE)).'">'.get_the_title(get_post_meta( $post->ID, 'course_id', TRUE)).'</a>'; ?>

<?php $course_data = get_post(get_post_meta( $post->ID, 'course_id', TRUE)); 

// echo "<pre>";
// print_r($course_data);
// echo "</pre>";

$modules = get_template_directory_uri() . "/modules/";
?>


<div class="main-content">
    <div class="title">
        <h3>Modules</h3>
        <div class="post-title main-title">
            <p style="display: block;"><a href="<?php get_template_directory_uri(); ?>/member-dashboard">Dashboard < </a><a href="<?php get_template_directory_uri(); ?>/modules">My Modules </a><?php echo ' <span> < </span> '. get_the_title(); ?></p>
        </div>
    </div> <!-- title -->

    <div class="course_info">
        <div class="course_list_wrapper">
            <div class="current_course">
                <h3><?php echo the_title(); ?></h3>
                <div><?php 
                    $singleId = $post->ID;
                    echo do_shortcode('[learndash_course_progress course_id"' . $singleId . '""]');
                ?></div>
            </div>

            <?php 
                echo do_shortcode('[course_content course_id"' . $singleId . '""]');
            ?>

        </div>  <!-- course_list_wrapper -->
        <div class="single_course">
            <div class="logo"></div>
            <div class="the_content"><?php echo the_content(); ?></div>
            <?php 
                $user_id = get_current_user_id();
                $user_course_progress = get_user_meta( $user_id, '_sfwd-course_progress', true );

                if (array_key_exists($post->ID, $user_course_progress)) {
                    $completed = $user_course_progress[$post->ID]['completed'];
                    $total = $user_course_progress[$post->ID]['total'];
                } else {
                    $completed = 0;
                    $total = 0;
                }    


                if (($completed == $total) && ($total != 0)) { ?>
                    <p class="ready"><?php echo single_post_title(); ?> Completed<p>
                    <div><a href="<?php echo do_shortcode('[get_first_lesson_permalink]'); ?>" class="gb_button">Review Module</a></div>
                <?php } elseif ($completed != $total ) { ?>
                    <p class="ready">Continue <?php echo single_post_title(); ?><p>
                    <div><a href="<?php echo do_shortcode('[get_first_lesson_permalink]'); ?>" class="gb_button">Continue Module</a></div>
                <?php } else { ?>
                    <p class="ready">Ready to start <?php echo single_post_title(); ?>?<p>
                    <div><a href="<?php echo do_shortcode('[get_first_lesson_permalink]'); ?>" class="gb_button">Start Module</a></div>
                <?php } 

            ?>

        </div> <!-- single_course-->
      
    </div> <!--  course_info -->


</div> <!-- main-content -->