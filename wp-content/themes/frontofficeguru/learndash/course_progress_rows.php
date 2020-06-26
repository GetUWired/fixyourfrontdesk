<?php
/**
 * Displays course progress rows for a user
 *
 * Available:
 * $courses_registered: course
 * $course_progress: Progress in courses
 * 
 * @since 2.5.5
 * 
 * @package LearnDash\Course
 */

// array of course data
foreach ( $course_progress as $course_id => $coursep ) {
	
	$course = get_post( $course_id );

	if ( ( !( $course instanceof WP_Post ) ) || ( $course->post_type != 'sfwd-courses' ) || ( empty( $course->post_title ) ) ) 
		continue;
	
	?>
	<div class="single_course_progess_wrapper"><span class="learndash-profile-course-title"><strong><h4><a href="<?php echo get_permalink( $course->ID ); ?>"><?php echo get_the_title( $course->ID ) ?></a></h4></strong></span>

	<?php 

		$course_status = learndash_course_status( $course_id, $user_id );
		//finds user progress for course that is referenced within array
		$user_progress = get_user_meta( $user_id, '_sfwd-course_progress', true );

		// shows progress bar according to how completed the course and lessons are
		if ($course_status == 'Completed') {

			$completeBar = "<dd class='course_progress' style='background-color:#79c140;padding:4px 0;'>MODULE COMPLETE</dd>";
			echo $completeBar;

		} else {



	        if (array_key_exists($course_id, $user_progress)) {
	            $completed = $user_progress[$course_id]['completed'];
	            $total = $user_progress[$course_id]['total'];
	            $percentage = round($completed*100/$total, 2);


				$progressBar = "<dd class='course_progress'><span>" . esc_attr( $percentage ) . "%</span><div class='course_progress_blue' style='width: " . esc_attr( $percentage ) . "%;'></dd>";
				echo $progressBar;
	        } else {
	            $completed = 0;
	            $total = 0;

				$startBar = "<dd class='course_progress'><span>0%</span><div class='course_progress_blue' style='width: 0%;'></dd>";
				echo $startBar;            
	        } 


		}

	?>

		</div><!-- single_course_progess_wrapper -->
		<?php
		// PULLING LESSONS IN

		$course_lessons_query_args = array(
			'pagination' => 'false',
			'posts_per_page' => -1,
			'nopaging' => true,
		);
		
		$course_lesson_list = learndash_get_course_lessons_list( $course_id, $user_id, $course_lessons_query_args );

		// lists lessons within each course and shows the checkmark next to each completed lesson
		foreach ($course_lesson_list as $key => $lesson[0]) {

			$lesson_list = "<div class='allstudent_lesson_list learndash'>";
			if (array_key_exists($lesson[0]['post']->ID, $user_progress[$course_id]['lessons'])) {
				$lesson_list .= "<span class='completed'></span>";
			}
			$lesson_list .= $lesson[0]['post']->post_title; 
			$lesson_list .= "</div>";

			echo $lesson_list;
		}



	?> <?php //_e('Status:', 'learndash') ?> <!-- <span class="leardash-course-status leardash-course-status-<?php //echo sanitize_title_with_dashes($course_status) ?>"><?php //echo $course_status ?></span><br/> -->




	<?php

	$course_steps_count = learndash_get_course_steps_count( $course_id ); 
	$course_steps_completed = learndash_course_get_completed_steps( $user_id, $course_id, $coursep );
	
	$completed_on = get_user_meta( $user_id, 'course_completed_' . $course_id, true );
	if ( !empty( $completed_on ) ) {
		
		$coursep['completed'] = $course_steps_count;
		$coursep['total'] = $course_steps_count;
	
	} else {
		$coursep['total'] = $course_steps_count;
		$coursep['completed'] = $course_steps_completed;
		
		if ( $coursep['completed'] > $coursep['total'] )
			$coursep['completed'] = $coursep['total'];
	}
	
	// echo ' '. sprintf( __( '<span class="leardash-course-status">Completed <strong>%d</strong> out of <strong>%d</strong> Lessons</span></div>', 'learndash' ), $coursep['completed'], $coursep['total'] );

	$since = learndash_user_group_enrolled_to_course_from( $user_id, $course->ID );
	if ( !empty( $since ) ) {
		echo ' <span class="learndash-profile-course-access-label">'. sprintf( __('Since: %s (Group Access)', 'learndash'), learndash_adjust_date_time_display( $since ) ) .'</span>';
	} else {
		$since = ld_course_access_from( $course->ID,  $user_id );
		if ( !empty( $since ) ) {
			echo ' <span class="learndash-profile-course-access-label">'. sprintf( __('Since: %s', 'learndash' ), learndash_adjust_date_time_display( $since ) ) .'</span>';
		}
	} 

	// Display the Course Access if expired or expiring
	$expire_access = learndash_get_setting( $course_id, 'expire_access' );
	if ( !empty( $expire_access ) ) {
		$expired = ld_course_access_expired( $course_id, $user_id );
		if ( $expired ) {
			?> <span class="leardash-course-expired"><?php echo __('(access expired)', 'learndash') ?></span> <?php
		} else {
			$expired_on = ld_course_access_expires_on($course_id, $user_id);
			if (!empty( $expired_on ) ) {
				?> <span class="leardash-course-expired"><?php echo sprintf( _x('(expires %s)', 'Course Expires on date', 'learndash'),
			 		learndash_adjust_date_time_display( $expired_on ) ) ?></span> <?php
			}
		}
	}

	if ( ( $user_id == get_current_user_id() ) || ( learndash_is_admin_user() ) || ( learndash_is_group_leader_user() ) ) {
		$certificateLink = learndash_get_course_certificate_link( $course_id, $user_id );
		if ( !empty( $certificateLink ) ) {
			?> - <a class="learndash-profile-course-certificate-link" href="<?php echo $certificateLink ?>" target="_blank"><?php echo __( 'Certificate', 'learndash' ); ?></a><?php
		}
	}

	if ( current_user_can('edit_courses', intval($course->ID) ) ) {
		$edit_post_link = get_edit_post_link( intval($course->ID) );
		//error_log('edit_post_link['. $edit_post_link .']');
		?> <a class="learndash-profile-edit-course-link" href="<?php echo $edit_post_link; ?>"><?php echo _x('(edit)', 'profile edit course link label', 'learndash') ?></a><?php
	}

	if ( learndash_show_user_course_complete( $user_id ) ) {
		
		$lesson_query_args = array(
			'pagination' => 'false',
			'posts_per_page' => -1,
			'nopaging' => true,
		);
		
		$lessons = learndash_get_course_lessons_list( $course_id, $user_id, $lesson_query_args );
		$course_quiz_list = learndash_get_course_quiz_list( $course_id, $user_id ); 

		if ((!empty($lessons)) || (!empty($course_quiz_list))) {
			$user_course_progress 					= 	array();
			$user_course_progress['user_id'] 		= 	$user_id;
			$user_course_progress['course_id']  	= 	$course_id;							
			$user_course_progress['course_data']	=	$coursep;
				
			if ($course_status == __( 'Completed', 'learndash' )) {
				$course_checked 					= 	' checked="checked" ';
				$user_course_progress['checked'] 	= 	true;
			} else {
				$course_checked 					= 	'';
				$user_course_progress['checked'] 	= 	false;
			}
			
			

			?> 

			<?php //if ($course_checked == ' checked="checked" ') { ?>
				<script type="text/javascript">
					jQuery(document).ready( function () {
						jQuery('.ld-course-progress-content-container div .learndash-profile-course-title strong h4 > a').addClass('completed');
					});
				</script>

			<?php //} ?>

			<a href="#" id="learndash-profile-course-details-link-<?php echo $course_id ?>" class="learndash-profile-course-details-link"><?php echo _x('(details)', 'Course progress details link', 'learndash') ?></a>
			<?php
				$unchecked_children_message = '';							
				if ( ( ! empty( $lessons ) ) || ( ! empty( $course_quiz_list ) ) ) { 
					$unchecked_children_message = ' data-title-unchecked-children="'. htmlspecialchars( __( 'Set all children steps as incomplete?', 'learndash' ), ENT_QUOTES ) .'" ';
				}
			?>
			<div id="learndash-profile-course-details-container-<?php echo $course_id ?>" class="learndash-profile-course-details-container" style="display:none">
				<?php
					SFWD_LMS::get_template(
						'course_details_admin',
						array(
							'user_id'          => $user_id,
							'course_id'        => $course_id,
							'course_progress'  => isset( $course_progress[ $course_id ] ) ? $course_progress[ $course_id ] : array(),
						),
						true
					);
				?>
				<input id="learndash-mark-course-complete-<?php echo $course_id ?>" type="checkbox" <?php echo $course_checked; ?> class="learndash-mark-course-complete" data-name="<?php echo htmlspecialchars( json_encode( $user_course_progress, JSON_FORCE_OBJECT ) ) ?>" <?php echo $unchecked_children_message ?> /><label for="learndash-mark-course-complete-<?php echo $course_id ?>"><?php echo sprintf( _x('%s All Complete', 'Course All Complete', 'learndash'), LearnDash_Custom_Label::get_label( 'course' ) ) ?></label><br />
				<?php
					$template_file = SFWD_LMS::get_template(
						'course_navigation_admin',
						array(
							'course_id'        => $course_id,
							'course'           => $course,
							'course_progress'  => $course_progress,
							'lessons'          => $lessons,
							'course_quiz_list' => $course_quiz_list,
							'user_id'          => $user_id,
							'widget'           => array(
								'show_widget_wrapper' => true,
								'current_lesson_id'   => 0,
								'current_step_id'     => 0,
							),
						),
						null,
						true
					);
					if ( ! empty( $template_file ) ) {
						include $template_file;
					}


?>
			</div>

			<?php
		}
	}
	
	?><br/><?php
}