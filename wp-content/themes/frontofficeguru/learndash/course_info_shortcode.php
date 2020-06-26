<?php
/**
 * Displays course information for a user
 *
 * Available:
 * $user_id
 * $courses_registered: course
 * $course_progress: Progress in courses
 * $quizzes
 * 
 * @since 2.1.0
 * 
 * @package LearnDash\Course
 */

/**
 * Course registered
 */

global $pagenow;

$shortcode_atts_json = htmlspecialchars( json_encode( $shortcode_atts ) );

$userInfo = get_user_meta($user_id);
?>
<div id="ld_course_info" class="ld_course_info" data-shortcode-atts="<?php echo $shortcode_atts_json; ?>">

	<div class="student_progress_header">
		<div><?php echo do_shortcode('[memb_gravatar size=90 default=https://fixyourfrontdesk.com/wp-content/uploads/2020/06/Fix-Your-Front-Desk-profile-default.jpg]'); ?>
		</div>
		<div class="student_profile_info">
			<h4><?php echo $userInfo['first_name'][0] . " " . $userInfo['last_name'][0];?></h4>
<!-- 			<span>Front Desk Administrator<br/></span> -->
			<span>Last Active: 
				<?php 

					if (date($userInfo['learndash-last-login'][0]) == "") {
						echo "Not Started";
					} else {
						echo date('m/d/Y', $userInfo['learndash-last-login'][0]); 
					}
				?>
				</span>
		</div>
	</div>

			<div style="clear:both"></div>

	<?php
		if (is_admin()) {
			$current_screen = get_current_screen();

			if ( ( $pagenow == 'profile.php' ) || ( $pagenow == 'user-edit.php' ) || ($current_screen->id == 'learndash-lms_page_group_admin_page' ) ) { 
				echo do_shortcode('[ld_user_course_points user_id="'. $user_id .'" context="profile"]'); 

				if ( ( learndash_is_admin_user() ) || ( ( learndash_is_group_leader_user() ) && ( learndash_is_group_leader_of_user( get_current_user_id(), $user_id ) ) ) ) {
					?><p><label for="learndash-course-points-user"><strong><?php printf( _x( 'Extra %s points', 'placeholders: Course Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) ); ?></strong></label> <input id="learndash-course-points-user" name="learndash_course_points" type="number" min="0" step="any" value="<?php echo learndash_format_course_points( get_user_meta( $user_id, 'course_points', true ) ) ?>" /><?php } ?></p>
					<?php 
				} 
			}
		?>
	<?php /* Course progress */ ?>
	<?php if ( !empty( $course_progress ) ) : ?>
		<div id="course_progress_details" class="course_progress_details">
			<!-- <h4><?php //printf( _x( '%s progress details:', 'Course progress details Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) ); ?></h4> -->

			<span class="gb_text">Module Progress</span>
			<?php 
				if ( learndash_show_user_course_complete( $user_id ) ) {
					?>
					<input type="hidden" id="user-progress-<?php echo $user_id ?>" name="user_progress[<?php echo $user_id ?>]" value="<?php echo htmlspecialchars( json_encode( array('course' => array(), 'quiz' => array()), JSON_FORCE_OBJECT ) ); ?>" />
					<input type="hidden" name="user_progress-<?php echo $user_id ?>-nonce" value="<?php echo wp_create_nonce( 'user_progress-'. $user_id ) ?>" />
					<?php 
				}
				?><div class="ld-course-progress-content-container"><?php
				$template_file = SFWD_LMS::get_template( 
					'course_progress_rows', 
					array( 
						'user_id' => $user_id,
						'course_progress' => $course_progress,
						'shortcode_atts' => $shortcode_atts
					), 
					null, 
					true 
				);
				if ( ! empty( $template_file ) ) {
					include $template_file;
				}
				
				?></div><?php
				?><div class="ld-course-progress-pager-container"><?php
				echo SFWD_LMS::get_template( 
					'learndash_pager.php', 
					array(
					'pager_results' => $course_progress_pager, 
					'pager_context' => 'course_info_courses'
					) 
				);
				?></div><div style="clear:both"></div><?php
			?>
		</div>
		<br>
	<?php endif; ?>

	<?php /* Quizzes */ ?>
	<?php if ( $quizzes ) : ?>
		<div id="quiz_progress_details" class="quiz_progress_details">
			<?php
				global $learndash_assets_loaded;
			
				if ( !isset( $learndash_assets_loaded['scripts']['learndash_template_script_js'] ) ) {

					$filepath = SFWD_LMS::get_template( 'learndash_template_script.js', null, null, true );
					if ( !empty( $filepath ) ) {
						wp_enqueue_script( 'learndash_template_script_js', learndash_template_url_from_path( $filepath ), array( 'jquery' ), LEARNDASH_SCRIPT_VERSION_TOKEN, true );
						$learndash_assets_loaded['scripts']['learndash_template_script_js'] = __FUNCTION__;

						$data = array();
						$data['ajaxurl'] = admin_url('admin-ajax.php');
						$data = array( 'json' => json_encode( $data ) );
						wp_localize_script( 'learndash_template_script_js', 'sfwd_data', $data );
					}
				}
				LD_QuizPro::showModalWindow();
			?>
			<h4><?php echo sprintf( _x( 'You have taken the following %s:', 'You have taken the following quizzes:', 'learndash' ), learndash_get_custom_label_lower( 'quizzes' ) ); ?></h4>

			<?php /* The confirm delete quiz message should not contain HTML. Use \r\n for line breaks */ ?>
			<div id="ld-confirm-quiz-delete-message" style="display:none"><?php echo sprintf( _x( 'Are you sure that you want to remove this %s item?', 'placeholder: Quiz', 'learndash' ), learndash_get_custom_label_lower( 'quiz' ) )  ?></div>
			
			<div class="ld-quiz-progress-content-container">
			<?php
				$template_file = SFWD_LMS::get_template( 
					'quiz_progress_rows', 
					array( 
						'user_id' => $user_id,
						'quizzes' => $quizzes,
						'shortcode_atts' => $shortcode_atts
					), 
					null, 
					true 
				);

				if ( ! empty( $template_file ) ) {
					include $template_file;
				}

			?></div><?php
			?><div class="ld-quiz-progress-pager-container"><?php
			echo SFWD_LMS::get_template( 
				'learndash_pager.php', 
				array(
				'pager_results' => $quizzes_pager, 
				'pager_context' => 'course_info_quizzes'
				) 
			);
			?></div><div style="clear:both"></div><?php
			?>
		</div>
	<?php endif; ?>
	<!-- End Course info shortcode -->
</div>
