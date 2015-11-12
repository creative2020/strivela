<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- title, meta, and date info -->
	<div class="entry-header clearfix">

	<div class="entry-meta">
		<?php printf( __( 'Posted by %s', 'it-l10n-BuilderChild-Air' ), '<span class="author">' . builder_get_author_link() . '</span>&nbsp;' ); ?>
	</div>
	
	<div class="entry-meta date">
		<span class="weekday"> &middot; <?php the_time( 'l' ); ?><span class="weekday-comma">,</span></span>
		<span class="month"><?php the_time( 'F' ); ?></span>
		<span class="day"><?php the_time( 'j' ); ?><span class="day-suffix"><?php the_time( 'S' ); ?></span><span class="day-comma">,</span></span>
		<span class="year"><?php the_time( 'Y' ); ?></span>&nbsp;
	</div>		

	</div>
	<!-- post content -->
	<div class="entry-content clearfix">
		<?php the_content( __( 'Read More &rarr;', 'it-l10n-BuilderChild-Air' ) ); ?>
	</div>

	<div class="edit-post-link"><?php edit_post_link('Edit'); ?></div>


</div>
<!-- end .post -->