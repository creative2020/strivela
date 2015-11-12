<?php

if ( is_admin() )
	return;

if ( ! class_exists( 'BuilderExtensionPortfolioLayout' ) ) {
	class BuilderExtensionPortfolioLayout {
		
		function BuilderExtensionPortfolioLayout() {
			
			// Include the file for setting the image sizes
			require_once( dirname( __FILE__ ) . '/lib/image-size.php' );
			
			// Helpers
			it_classes_load( 'it-file-utility.php' );
			$this->_base_url = ITFileUtility::get_url_from_file( dirname( __FILE__ ) );
			
			// Calling only if not on a singular
			if ( ! is_singular() ) {
				add_action( 'builder_layout_engine_render', array( &$this, 'change_render_content' ), 0 );
			}
		}
		
		function extension_render_content() {

			global $post, $wp_query;
			
			$args = array(
				'ignore_sticky_posts' => true,
				'paged'               => get_query_var( 'paged' ),
				'tax_query' => array(
				    array(
				      'taxonomy' => 'post_format',
				      'field' => 'slug',
				      'terms' => array('post-format-status', 'post-format-quote', 'post-format-video', 'post-format-image'),
				      'operator' => 'NOT IN'
				    )
				 )
			);
			
			$args = wp_parse_args( $args, $wp_query->query );
			
			query_posts( $args ); // Query only posts that ARE NOT a post format (other than the standard post format)	

		?>
			<?php if ( have_posts() ) : ?>
				<div class="loop">
					<div class="loop-content">
					<div class="portfolio-extension-wrapper clearfix">					
						<?php while ( have_posts() ) : // the loop ?>
							<?php the_post(); ?>

							<div <?php post_class('portfolio-post-wrap'); ?>>
								<div class='portfolio-post entry-content'>
									<?php if ( has_post_thumbnail() ) : ?>
										<a class="entry-image" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'it-portfolio-thumb' ); ?>
										</a>
									<?php else : ?>

									<?php endif; ?>
									
									<span class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
								</div>
							</div>
						<?php endwhile; // end of one post ?>
					</div><!-- End of Portfolio Extension Wrapper -->
					</div>
					
					<!-- Previous/Next page navigation -->
					<div class="loop-footer">
						<div class="loop-utility clearfix">
							<div class="alignleft"><?php previous_posts_link( __( '&laquo; Previous Page' , 'it-l10n-Builder' ) ); ?></div>
							<div class="alignright"><?php next_posts_link( __( 'Next Page &raquo;', 'it-l10n-Builder' ) ); ?></div>
						</div>
					</div>
				</div>
			<?php else : // do not delete ?>
				<?php do_action( 'builder_template_show_not_found' ); ?>
			<?php endif; // do not delete ?>
		<?php
		
		}
		
		function change_render_content() {
			remove_action( 'builder_layout_engine_render_content', 'render_content' );
			add_action( 'builder_layout_engine_render_content', array( &$this, 'extension_render_content' ) );
		}
	
	} // end class 
	
	$BuilderExtensionPortfolioLayout = new BuilderExtensionPortfolioLayout();
}