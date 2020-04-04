<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Class_VC_Pricelist {

	/**
	 * Construct method
	 */
	public function __construct() {
		add_shortcode( 'vcat_pricelist', array( $this, 'shortcode_func' ) );
		add_action( 'init', array( $this, 'map_vc_element' ) );
	}

	public function shortcode_func( $atts, $content = null, $tag ) {
		$args = shortcode_atts( array(
			'style'        => '1',
			'image_id'     => '',
			'client_name'  => 'Dario Misic',
			'client_title' => 'Developer',
			'link'         => '',
			'rating'       => '',
		), $atts );

		//parse link
		$link     = ( '||' === $args['link'] ) ? '' : $args['link'];
		$link     = vc_build_link( $link );
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = $link['target'];

		$rating = (float) $args['rating'];

		// image URL
		if ( $args['image_id'] != '' ) {
			$image_url = wp_get_attachment_image_url( $args['image_id'] );
		}

		$content = wpb_js_remove_wpautop( $content, true );

		ob_start();

		?>

        <div class="tc-pricelist-style<?php echo esc_attr( $args['style'] ); ?>">
            <div class="featured1">
             <span class="meta1"><?php echo esc_html( $args['client_title'] ) ?></span>
             
             </div>
             
             
             
            <div class="pricelist-info">
                   
                    

					<?php if ( ! empty( $rating ) ) : ?>
                        <div class="pricelist-ratings">
							<?php
							for ( $index = 1; $index <= 5; $index ++ ) {
								if ( $rating != 0 && $index <= $rating ) {
									echo wp_kses_post( '<i class="fa fa-star"></i>' );
								} else if ( abs( $rating - $index ) === 0.5 ) {
									echo wp_kses_post( '<i class="fa fa-star-half-o"></i>' );
								} else {
									echo wp_kses_post( '<i class="fa fa-star-o"></i>' );
								}
							}
							?>
                        </div>
					<?php endif; ?>
					
					<span class="name"><?php echo esc_html( $args['client_name'] ); ?></span>
                </div>
            
            
            
            
            <div class="pricelist-desc">
				<?php echo $content; ?>
				
            </div>
            
            <div class="position">
                         <a class="btn-link-title" href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>"
                                target="<?php echo esc_attr( $a_target ); ?>"><?php echo esc_html( $a_title ); ?> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
</a>
                    </div>
            
    
        
            

            <div class="pricelist-footer">
				<?php if ( $args['image_id'] !== '' ) : ?>
                    <div class="pricelist-photo">
                        <img src="<?php echo esc_url( $image_url ); ?>"
                             alt="<?php echo esc_attr( $args['client_name'] ); ?>">
                    </div>
				<?php endif ?>

                
            </div>

        </div>

		<?php

		return ob_get_clean();
	}

	function map_vc_element() {
		if ( function_exists( "vc_map" ) ) {
			vc_map( array(
				"name"            => esc_html__( 'Price List', 'obd-pricelist' ),
				"base"            => "vcat_pricelist",
				"content_element" => true,
				"category"        => esc_html__( 'by Obsidian', 'obd-pricelist' ),
				'description'     => esc_html__( 'Insert your pricelist', 'obd-pricelist' ),
				"icon"            => VCAT_PLUGIN_URL
				                     . 'assets/icons/pricelist.png',
				"params"          => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'client_title',
						'admin_label' => true,
						'heading'     => esc_html__( "Featured Title", 'obd-pricelist' ),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'style',
						'heading'     => esc_html__( "Featured Color Style", 'obd-pricelist' ),
						'value'       => array(
							esc_html__( 'Red', 'obd-pricelist' )  => '1',
							esc_html__( 'Blue', 'obd-pricelist' )  => '2',
							esc_html__( 'Yellow', 'obd-pricelist' )  => '3',
							esc_html__( 'Green', 'obd-pricelist' )  => '4',
							esc_html__( 'Orange', 'obd-pricelist' )  => '5',
							esc_html__( 'Purple', 'obd-pricelist' )  => '6',
							esc_html__( 'Brown', 'obd-pricelist' )  => '7',
							esc_html__( 'Magenta', 'obd-pricelist' )  => '8',
							esc_html__( 'Black', 'obd-pricelist' )  => '9',
							esc_html__( 'Pink', 'obd-pricelist' ) => '10',
							
						),
						'admin_label' => true,
					),

					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Rating', 'obd-pricelist' ),
						'param_name' => 'rating',
						'value'      => array(
							esc_html__( 'No Rating', 'obd-pricelist' ) => '0',
							esc_html__( '1', 'obd-pricelist' )         => '1',
							esc_html__( '1.5', 'obd-pricelist' )       => '1.5',
							esc_html__( '2', 'obd-pricelist' )         => '2',
							esc_html__( '2.5', 'obd-pricelist' )       => '2.5',
							esc_html__( '3', 'obd-pricelist' )         => '3',
							esc_html__( '3.5', 'obd-pricelist' )       => '3.5',
							esc_html__( '4', 'obd-pricelist' )         => '4',
							esc_html__( '4.5', 'obd-pricelist' )       => '4.5',
							esc_html__( '5', 'obd-pricelist' )         => '5',
						),
					),

					array(
						'type'        => 'textfield',
						'param_name'  => 'client_name',
						'admin_label' => true,
						'heading'     => esc_html__( "Name", 'obd-pricelist' ),
					),
					array(
						"type"       => "attach_image",
						'heading'    => esc_html__( "Upload Image", 'obd-pricelist' ),
						"param_name" => "image_id",
					),
				
					
					array(
						'type'        => 'vc_link',
						'heading'     => esc_html__( "Button URL(s)", 'obd-pricelist' ),
						'param_name'  => 'link',
						'description' => esc_html__( 'Add link for price list', 'obd-pricelist' ),
					),
					
					array(
						"type"       => "textarea_html",
						"heading"    => esc_html__( "Review Text", 'obd-pricelist' ),
						"param_name" => "content",
					),
				),
			) );
		}
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_vcat_pricelist extends WPBakeryShortCode {
	}
}

// Initialize Element Class
if ( class_exists( 'Class_VC_Pricelist' ) ) {
	new Class_VC_Pricelist();
}
