<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<?php if ( 'wpm-testimonial' == get_post_type() ) : // If viewing a testimonials single post. ?>
	
			<header class="entry-header">

				<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

				<div class="entry-byline">
					<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
					<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
					<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
					<?php if ( function_exists( 'ev_post_views' ) ) ev_post_views( array( 'text' => '%s' ) ); ?>
					<?php edit_post_link(); ?>
				</div><!-- .entry-byline -->

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-content' ); ?>>			
				<?php 
				if( has_post_thumbnail() ) {
					the_post_thumbnail('medium', array( 'class' => 'alignright' )); 
				} ?>
				<?php the_content(); ?>
				<span class="entry-terms clea-temoin">
					<?php echo get_post_meta( get_the_ID(), 'first_name', true )?> <?php echo get_post_meta( get_the_ID(), 'last_name', true )?>, <span class="clea-fonctions"><?php echo get_post_meta( get_the_ID(), 'fonctions_ou_statut', true )?>. </span> </span>				
				<?php wp_link_pages(); ?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php hybrid_post_terms( array( 'taxonomy' => 'wpm-testimonial-category', 'text' => __( 'Catégorie %s', 'clea-2-IB' ) ) ); ?>
				<?php hybrid_post_terms( array( 'taxonomy' => 'orientation', 'text' => __( 'Tagged %s', 'stargazer' ), 'before' => '<br />' ) ); ?>
			</footer><!-- .entry-footer -->
	
		<?php else : // not a testimonials single post. ?>

			<header class="entry-header">

				<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

				<div class="entry-byline">
					<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
					<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
					<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
					<?php if ( function_exists( 'ev_post_views' ) ) ev_post_views( array( 'text' => '%s' ) ); ?>
					<?php edit_post_link(); ?>
				</div><!-- .entry-byline -->

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-content' ); ?>>	

				<?php 
				if( has_post_thumbnail() ) {
					the_post_thumbnail('stargazer-full', array( 'class' => 'alignnone' )); 
				} ?>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => __( 'Posted in %s', 'stargazer' ) ) ); ?>
				<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => __( 'Tagged %s', 'stargazer' ), 'before' => '<br />' ) ); ?>
			</footer><!-- .entry-footer -->
		
		<?php endif; // End testimonials check. ?>
		

	<?php else : // If not viewing a single post. ?>

		<?php get_the_image( array( 'size' => 'stargazer-full', 'order' => array( 'featured', 'attachment' ) ) ); ?>

		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<div class="entry-byline">
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?>
				<?php edit_post_link(); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->