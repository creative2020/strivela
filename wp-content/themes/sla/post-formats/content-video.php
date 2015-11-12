<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- title, meta, and date info -->
	<div class="entry-header clearfix">
									
		<h3 class="entry-title">
			<!-- Use this instead? <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3> -->
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>	
		
	</div>
	
	<!-- post content -->
	<div class="entry-content clearfix">
		<?php the_content( __( 'Read More &rarr;', 'it-l10n-BuilderChild-Air' ) ); ?>
	</div>
	
	<div class="edit-post-link"><?php edit_post_link('Edit'); ?></div>
	
</div>
<!-- end .post -->