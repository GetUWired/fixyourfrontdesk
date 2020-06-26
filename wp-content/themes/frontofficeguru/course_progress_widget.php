<?php
/**
 * Displays the course progress widget.
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Course
 */
?>
<?php 



// echo do_shortcode();

$complete = esc_attr( $percentage );

// echo $complete;


$progressBar = "<dd class='course_progress'><span>" . esc_attr( $percentage ) . "%</span><div class='course_progress_blue' style='width: " . esc_attr( $percentage ) . "%;'></dd>";

$completeBar = "<dd class='course_progress' style='background-color:#7eb64d;'>MODULE COMPLETE</dd>";

if ($complete == '100') {
	echo $completeBar;
} else {
	echo $progressBar;
}
?>
<!-- <dd class='course_progress' title='<?php //printf( esc_html_x( '%1$d out of %2$d steps completed', 'placeholder: completed steps, total steps', 'learndash' ), $completed, $total ); ?>'><span><?php //echo esc_attr( $percentage ); ?>%</span><div class='course_progress_blue' style='width: <?php //echo esc_attr( $percentage ); ?>%;'></dd>" -->

	<!-- <div style='border-radius: 50%; height:40px; width: 40px;position:absolute; left: 45%; background-color: #7eb64d;display: inline-block;'>√</div> -->

	<!-- <img src='https://fixyourfrontdesk.com/wp-content/uploads/2020/06/checkmark.png' /> -->

