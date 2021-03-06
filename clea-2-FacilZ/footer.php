				<?php hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template. ?>

			</div><!-- #main -->

			<?php hybrid_get_sidebar( 'subsidiary' ); // Loads the sidebar/subsidiary.php template. ?>

		</div><!-- .wrap -->

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<div class="wrap">
				<?php hybrid_get_menu( 'subsidiary' ); // Loads the menu/subsidiary.php template. ?>
				<?php hybrid_get_menu( 'social' ); // Loads the menu/social.php template. ?>

				<p class="credit">
					<?php 
					$clea = '<a href="https://cecilebonnet.com/clea">CLEA</a>' ;
					
					printf(
						// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link. */
						__( 'Copyright &#169; %1$s %2$s. Propulsé par %3$s and %4$s. Conception : %5$s', 'clea-2-IB' ),
						date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link(), $clea ); ?>
				</p><!-- .credit -->

			</div><!-- .wrap -->

		</footer><!-- #footer -->

	</div><!-- #container -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>