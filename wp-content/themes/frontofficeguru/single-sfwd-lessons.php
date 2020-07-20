<?php

/**
 * The Template for displaying all single lessons posts.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */

get_header('membership');

global $wpdb;

?>
<?php $all_keys = get_post_custom_keys(); ?>

<?php $course_name = '<a href="' . get_the_permalink(get_post_meta($post->ID, 'course_id', TRUE)) . '">' . get_the_title(get_post_meta($post->ID, 'course_id', TRUE)) . '</a>'; ?>

<?php $course_data = get_post(get_post_meta($post->ID, 'course_id', TRUE));

// echo "<pre>";
// print_r($course_data);
// echo "</pre>";

?>

<div class="main-content">
    <div class="title">
        <h3>Lessons</h3>

        <div class="post-title main-title">
            <p style="display: block;"><a href="<?php get_template_directory_uri(); ?>/member-dashboard">Dashboard > </a><a href="<?php get_template_directory_uri(); ?>/modules">My Modules > </a><?php echo $course_name . ' <span> > </span> ' . get_the_title(); ?></p>
        </div>

    </div> <!-- title -->

    <div class="course_info">
        <div class="course_list_wrapper">
            <div class="current_course">
                <h3><?php echo $course_name; ?></h3>
                <div><?php
                        $singleId = $course_data->ID;

                        echo do_shortcode('[learndash_course_progress course_id="' . $singleId . '"]');
                        ?></div>
            </div>

            <?php

            echo do_shortcode('[course_content course_id="' . $singleId . '"]');

            ?>

        </div>
        <div class="single_course">
            <div class="logo"></div>
            <div class="lesson_title"><?php echo the_title(); ?></div>
            <div><?php echo the_content(); ?></div>
        </div>
    </div>
</div>

<?php
wp_footer();
//get_footer("member");
