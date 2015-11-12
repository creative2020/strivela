<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- title, meta, and date info -->
	<div class="entry-header clearfix">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="it-featured-image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'index_thumbnail', array( 'class' => 'index-thumbnail' ) ); ?>
					</a>
				</div>
			<?php endif; ?>
									
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
	
	<!-- post content -->
	<div class="entry-content clearfix">
		<?php the_content( __( 'Read More &rarr;', 'it-l10n-BuilderChild-Air' ) ); ?>
	</div>
	
	<!-- categories, tags and comments -->
	<div class="entry-footer clearfix">
		<div class="entry-meta alignright">
		<?php do_action( 'builder_comments_popup_link', '<div class="comments">', '</div>', __( '%s', 'it-l10n-BuilderChild-Air' ), __( 'No Comments', 'it-l10n-BuilderChild-Air' ), __( '1 Comment', 'it-l10n-BuilderChild-Air' ), __( '% Comments', 'it-l10n-BuilderChild-Air' ) ); ?>
		</div>
		<div class="entry-meta alignleft">
			<?php wp_link_pages( array( 'before' => '<div class="entry-utility entry-pages">' . __( 'Pages:', 'it-l10n-Builder' ) . '', 'after' => '</div>', 'next_or_number' => 'number' ) ); ?>		
			<div class="categories"><?php printf( __( 'Categories : %s', 'it-l10n-BuilderChild-Air' ), get_the_category_list( ', ' ) ); ?></div>
			<?php the_tags( '<div class="tags">' . __( 'Tags : ', 'it-l10n-BuilderChild-Air' ), ', ', '</div>' ); ?>
		</div>
	</div>
</div>
<!-- end .post -->