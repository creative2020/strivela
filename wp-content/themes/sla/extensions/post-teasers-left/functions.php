<?php

if ( is_admin() )
	return;


if ( ! class_exists( 'BuilderExtensionTeasersLeft' ) ) {
	class BuilderExtensionTeasersLeft {
		
		function BuilderExtensionTeasersLeft() {
			
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
			add_filter( 'excerpt_length', array( &$this, 'excerpt_length' ) );
			add_filter( 'excerpt_more', array( &$this, 'excerpt_more' ) );

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
						<?php while ( have_posts() ) : // the loop ?>
							<?php the_post(); ?>
							
							<div id="post-<?php the_ID(); ?>" <?php post_class('teasers-left-wrapper clearfix'); ?>>


									<?php if ( has_post_thumbnail() ) : ?>

										<div class="featured-image-wrapper">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'it-teaser-thumb', array( 'class' => 'teaser-left-thumb' ) ); ?>
											</a>
										</div>


										<div class="teaser-content-wrapper">
																				
											<div class="entry-header clearfix">								
		
												<h3 class="entry-title clearfix">
													<!-- Use this instead? <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> -->
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
												
												<div class="entry-meta">
													<?php printf( __( 'Posted by %s', 'it-l10n-BuilderChild-Air' ), '<span class="author">' . builder_get_author_link() . '</span>&nbsp;' ); ?>
												</div>
												
												<div class="entry-meta date">
													<span class="weekday"> &middot; <?php the_time( 'l' ); ?><span class="weekday-comma">,</span></span>
													<span class="month"><?php the_time( 'F' ); ?></span>
													<span class="day"><?php the_time( 'j' ); ?><span class="day-suffix"><?php the_time( 'S' ); ?></span><span class="day-comma">,</span></span>
													<span class="year"><?php the_time( 'Y' ); ?></span>&nbsp;
												</div>
												
												<div class="entry-meta">
													<?php do_action( 'builder_comments_popup_link', '<span class="comments">&middot; ', '</span>', __( '%s', 'it-l10n-BuilderChild-Air' ), __( 'No Comments', 'it-l10n-BuilderChild-Air' ), __( '1 Comment', 'it-l10n-BuilderChild-Air' ), __( '% Comments', 'it-l10n-BuilderChild-Air' ) ); ?>
												</div>
											</div>	
										
											<div class="entry-content teasers">									
												<?php the_excerpt(); ?>
											</div>
											
										</div>	
										
									<?php else : ?>
										
										<div class="entry-header clearfix">	
	
											<h3 class="entry-title clearfix">
												<!-- Use this instead? <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> -->
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											
											<div class="entry-meta">
												<?php printf( __( 'Posted by %s', 'it-l10n-BuilderChild-Air' ), '<span class="author">' . builder_get_author_link() . '</span>&nbsp;' ); ?>
											</div>
											
											<div class="entry-meta date">
												<span class="weekday"> &middot; <?php the_time( 'l' ); ?><span class="weekday-comma">,</span></span>
												<span class="month"><?php the_time( 'F' ); ?></span>
												<span class="day"><?php the_time( 'j' ); ?><span class="day-suffix"><?php the_time( 'S' ); ?></span><span class="day-comma">,</span></span>
												<span class="year"><?php the_time( 'Y' ); ?></span>&nbsp;
											</div>
											
											<div class="entry-meta">
												<?php do_action( 'builder_comments_popup_link', '<span class="comments">&middot; ', '</span>', __( '%s', 'it-l10n-BuilderChild-Air' ), __( 'No Comments', 'it-l10n-BuilderChild-Air' ), __( '1 Comment', 'it-l10n-BuilderChild-Air' ), __( '% Comments', 'it-l10n-BuilderChild-Air' ) ); ?>
											</div>
										</div>	
									
										<div class="entry-content teasers">									
											<?php the_excerpt(); ?>
										</div>										

									<?php endif; ?>	
									
							</div>
							<!-- end .post -->
						<?php endwhile; // end of one post ?>
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
			remove_filter( 'excerpt_length', array( &$this, 'excerpt_length' ) );
			remove_filter( 'excerpt_more', array( &$this, 'excerpt_more' ) );
		}
		
		function excerpt_length( $length ) {
			return 60;
		}
		
		function excerpt_more( $more ) {
			global $post;
			return '...<p><a href="'. get_permalink( $post->ID ) . '" class="more-link">Read More&rarr;</a></p>';
		}
		
		function change_render_content() {
			remove_action( 'builder_layout_engine_render_content', 'render_content' );
			add_action( 'builder_layout_engine_render_content', array( &$this, 'extension_render_content' ) );
		}
	
	} // end class 
	
	$BuilderExtensionTeasersLeft = new BuilderExtensionTeasersLeft();
}