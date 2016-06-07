<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			

			<?php if (is_home()) {
				$tags = get_tags(); ?>
				
				<section class="tags">
					<div class="container">
						<div class="title"><h2><?php single_post_title(); ?></h2></div>
						<ul>
							<?php foreach ($tags as $tag) { 

								$tag_link = get_tag_link($tag->term_id); ?>

							<li><a href="<?php echo $tag_link ?>" title="<?php echo $tag->name ?>">-<?php echo $tag->name ?>-</a></li>
								
							<?php } ?> 
						</ul>                            
					</div>
				</section>
				
			<?php }else{ ?>

				<div class="container">
					<div class="title"><h2><?php single_post_title(); ?></h2></div>
				</div>

			<?php } ?>

		<?php endif; ?>

		<main class="main news">

		<?php 
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

		// End the loop.
		endwhile;

		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'markup' ),
			'next_text'          => __( 'Next page', 'markup' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'markup' ) . ' </span>',
		) ); ?>

		</main>

	<?php // If no content, include the "No posts found" template.
	else :
		get_template_part( 'content', 'none' );

	endif;
	?>
<?php get_footer(); ?>