<?php
/**
 * Oconee contact widget.
 */

class Oconee_Contact_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'oconee_contact_widget',
			__( 'Oconee Contact Widget', 'oconee-renovations' ),
			array(
				'description' => __( 'Simple contact widget with Font Awesome icons.', 'oconee-renovations' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title            = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Oconee Renovations', 'oconee-renovations' );
		$email            = ! empty( $instance['email'] ) ? $instance['email'] : 'aytugunaldi@gmail.com';
		$phone            = ! empty( $instance['phone'] ) ? $instance['phone'] : '864-776-8001';
		$additional_items = ! empty( $instance['additional_items'] ) ? $instance['additional_items'] : '';
		$items            = array();

		if ( $email ) {
			$items[] = array(
				'icon'  => 'fa-solid fa-envelope',
				'text'  => $email,
				'url'   => 'mailto:' . sanitize_email( $email ),
				'label' => sprintf( __( 'Email %s', 'oconee-renovations' ), $email ),
			);
		}

		if ( $phone ) {
			$items[] = array(
				'icon'  => 'fa-solid fa-phone',
				'text'  => $phone,
				'url'   => 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ),
				'label' => sprintf( __( 'Call %s', 'oconee-renovations' ), $phone ),
			);
		}

		if ( $additional_items ) {
			$lines = preg_split( '/\r\n|\r|\n/', $additional_items );

			foreach ( $lines as $line ) {
				$line = trim( $line );

				if ( '' === $line ) {
					continue;
				}

				$parts = array_map( 'trim', explode( '|', $line ) );
				$icon  = $parts[0] ?? '';
				$text  = $parts[1] ?? '';
				$url   = $parts[2] ?? '';

				if ( '' === $icon || '' === $text ) {
					continue;
				}

				$items[] = array(
					'icon'  => preg_replace( '/[^a-z0-9\-\s]/i', '', $icon ),
					'text'  => $text,
					'url'   => $url,
					'label' => $text,
				);
			}
		}

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		get_template_part(
			'template-parts/widgets/contact-widget',
			null,
			array(
				'title' => $title,
				'items' => $items,
			)
		);

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function form( $instance ) {
		$title            = isset( $instance['title'] ) ? $instance['title'] : __( 'Oconee Renovations', 'oconee-renovations' );
		$email            = isset( $instance['email'] ) ? $instance['email'] : 'aytugunaldi@gmail.com';
		$phone            = isset( $instance['phone'] ) ? $instance['phone'] : '864-776-8001';
		$additional_items = isset( $instance['additional_items'] ) ? $instance['additional_items'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'oconee-renovations' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'oconee-renovations' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="email" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'oconee-renovations' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'additional_items' ) ); ?>"><?php esc_html_e( 'Additional items:', 'oconee-renovations' ); ?></label>
			<textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'additional_items' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'additional_items' ) ); ?>"><?php echo esc_textarea( $additional_items ); ?></textarea>
		</p>
		<p>
			<small><?php esc_html_e( 'Add one item per line as: fa-solid fa-location-dot|123 Main St|https://maps.google.com', 'oconee-renovations' ); ?></small>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'title'            => sanitize_text_field( $new_instance['title'] ?? '' ),
			'email'            => sanitize_email( $new_instance['email'] ?? '' ),
			'phone'            => sanitize_text_field( $new_instance['phone'] ?? '' ),
			'additional_items' => sanitize_textarea_field( $new_instance['additional_items'] ?? '' ),
		);
	}
}
