<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_page() && !is_front_page() ) : // If viewing a single page. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
		</footer><!-- .entry-footer -->

	<?php elseif ( is_front_page() ) : // If viewing the front page. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<?php 
			// get post meta data
			global $post;
			$meta = get_post_meta( $post->ID ); 
			
			// to be able to do the shortcodes and not simply display them
			// http://stackoverflow.com/questions/3602941/why-isnt-apply-filterthe-content-outputting-anythin
			$section_1 = apply_filters( 'the_content', $meta[ '_section_1' ][0] ); 	
			$section_2 = apply_filters( 'the_content', $meta[ '_section_2' ][0] ); 	
			$section_3 = apply_filters( 'the_content', $meta[ '_section_3' ][0] ); 	
			$section_4 = apply_filters( 'the_content', $meta[ '_section_4' ][0] ); 		
			$section_5 = apply_filters( 'the_content', $meta[ '_section_5' ][0] ); 	
			?>
			
			<section class="section-1">
				<div class="content-1">
					<?php echo $section_1 ; ?>
				</div>
			</section>
			<section class="section-2">
				<div class="content-2">
					<?php echo $section_2 ; ?>
				</div>
			</section>		
			<section class="section-3">
				<div class="content-3">
					<?php echo $section_3 ; ?>
				</div>
			</section>
			<section class="section-4">
				<div class="content-4">
					<?php echo $section_4 ; ?>
				</div>
			</section>
			<section class="section-5">
				<div class="content-5">
					<?php echo $section_5 ; ?>
				</div>
			</section>
		</div><!-- .entry-content -->


		<footer class="entry-footer">
			<?php edit_post_link(); ?>
		</footer><!-- .entry-footer -->
	
	<?php else : // If not viewing a single page. ?>

		<?php get_the_image( array( 'size' => 'stargazer-full' ) ); ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single page check. ?>

</article><!-- .entry -->