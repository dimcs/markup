<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('news-block'); ?>>

	<div class="container">

		<div class="news-block-heading">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( sprintf( '<h3><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' );
				endif;
			?>
			<span><?php _e('Published ','markup'); the_time('d.m.y'); ?></span>
		</div>

		<div class="news-block-image">
			<?php  the_post_thumbnail('full') ?>
		</div>

		<a href="<?php the_permalink() ?>" class="read-more"><?php _e('Read more ','markup');?></a>

		<?php 
			if( has_tag() ) {
				$posttags = get_the_tags(); ?>

				<div class="news-tags">

					<span><?php _e('tags ','markup');?>:</span>

					<ul>

						<?php foreach($posttags as $tag) {?>

						<li><a href="<?php echo get_tag_link( $tag->term_id ) ?>"><?php echo $tag->name ?></a></li>
							
						 <?php }  ?>

					</ul>

				</div>
				
			<?php }
		
			if ( is_single() ) : ?>
			
			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading %s', 'markup' ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					) );

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'markup' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'markup' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
			</div><!-- .entry-content -->
				
			<?php endif;
		?>


		<?php
			// Author bio.
			if ( is_single() && get_the_author_meta( 'description' ) ) :
				get_template_part( 'author-bio' );
			endif;
		?>

		<footer class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'markup' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->