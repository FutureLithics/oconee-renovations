<?php
/**
 * Oconee CTA widget.
 */

class Oconee_CTA_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'oconee_cta_widget',
			__( 'Oconee CTA Widget', 'oconee-renovations' ),
			array(
				'description' => __( 'Editable full-width call-to-action widget.', 'oconee-renovations' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title       = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Ready to Start Your Next Project?', 'oconee-renovations' );
		$subheader   = ! empty( $instance['subheader'] ) ? $instance['subheader'] : __( "Whether you're planning a renovation, custom carpentry project, or home improvement, we're here to help bring your vision to life. Contact us today to discuss your goals, ask questions, and receive a free estimate from a craftsman who takes pride in quality work.", 'oconee-renovations' );
		$button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : __( 'Request a Free Estimate', 'oconee-renovations' );
		$button_url  = ! empty( $instance['button_url'] ) ? $instance['button_url'] : home_url( '/contact-us' );

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		get_template_part(
			'template-parts/widgets/cta-widget',
			null,
			array(
				'title'       => $title,
				'subheader'   => $subheader,
				'button_text' => $button_text,
				'button_url'  => $button_url,
			)
		);

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? $instance['title'] : __( 'Ready to Start Your Next Project?', 'oconee-renovations' );
		$subheader   = isset( $instance['subheader'] ) ? $instance['subheader'] : __( "Whether you're planning a renovation, custom carpentry project, or home improvement, we're here to help bring your vision to life. Contact us today to discuss your goals, ask questions, and receive a free estimate from a craftsman who takes pride in quality work.", 'oconee-renovations' );
		$button_text = isset( $instance['button_text'] ) ? $instance['button_text'] : __( 'Request a Free Estimate', 'oconee-renovations' );
		$button_url  = isset( $instance['button_url'] ) ? $instance['button_url'] : home_url( '/contact-us' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Header:', 'oconee-renovations' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'subheader' ) ); ?>"><?php esc_html_e( 'Subheader:', 'oconee-renovations' ); ?></label>
			<textarea class="widefat" rows="6" id="<?php echo esc_attr( $this->get_field_id( 'subheader' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subheader' ) ); ?>"><?php echo esc_textarea( $subheader ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button text:', 'oconee-renovations' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><?php esc_html_e( 'Button URL:', 'oconee-renovations' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="url" value="<?php echo esc_attr( $button_url ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'title'       => sanitize_text_field( $new_instance['title'] ?? '' ),
			'subheader'   => sanitize_textarea_field( $new_instance['subheader'] ?? '' ),
			'button_text' => sanitize_text_field( $new_instance['button_text'] ?? '' ),
			'button_url'  => esc_url_raw( $new_instance['button_url'] ?? '' ),
		);
	}
}
