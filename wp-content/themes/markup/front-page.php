<?php get_header();
	$options = get_option( 'theme_settings' ); ?>

<!-- Banner Section -->
<?php if(get_field('banner_activate')){
	$img = get_field(('banner_bg')) ?>
	<section class="hero-block">
		<img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
		<div class="title"><h2><?php the_field(('banner_title')) ?></h2></div>
		<span class="hero-block-slogan"><?php the_field(('banner_slogan')) ?></span>
	</section>
<?php } ?>

<!-- Blog Section -->
<?php
	global $post;
	$args = array( 'posts_per_page' => 4);
	$last_posts = get_posts( $args );

	if(!empty($last_posts)){ ?>

	<section class="blog" id="blog">
		<div class="container">
			<div class="title"><h2><?php _e('New in  my blog','markup'); ?></h2></div>
			<div class="blog-inner">

				<?php foreach($last_posts as $post){ setup_postdata($post); ?>
				<div class="blog-box">
					<a href="<?php the_permalink();?>">
						<div class="blog-box-img-holder">
							<?php the_post_thumbnail();?>
						</div>
						<p><?php the_content('');?></p>
					</a>
				</div>
					    
				<?php }
					wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

	<?php }
 ?>

<!-- Blog Section -->
 <?php
 	$args = array( 'hide_empty' => 0, 'exclude' => 1 , 'order' => 'DESC'  );
 	$categories = get_categories( $args );

	if( $categories ){ ?>

	<section class="portfolio" id="portfolio">
		<div class="container">
			<div class="title"><h2><?php _e('Portfolio','markup'); ?></h2></div>
			<div class="portfolio-inner">

			<?php foreach( $categories as $cat ){

				$cat_data = get_category($cat->term_id);
				$cat_link = get_category_link( $cat->term_id );
				$block_size = get_field('block_size', $cat_data );
				$cat_thumbnail = get_field('cat_thumbnail', $cat_data ); ?>

				<div class="portfolio-box portfolio-box_<?php echo isset($block_size) && $block_size == 'small'? 'small': 'large' ?>">
					<a href="<?php echo $cat_link ?>"></a>
					<img src="<?php echo $cat_thumbnail['url'];?>" alt="<?php echo $cat_thumbnail['alt'];?>">
					<span><?php echo $cat->name;?> +</span>
				</div>	

			<?php } ?>

			</div>
		</div>
	</section>

	<?php } 
?>

	<!-- Contact US Section -->
	<section class="contact" id="contact">
		<div class="container">
			<div class="title"><h2><?php _e('Contact Me','markup'); ?></h2></div>
			<form class="form">
				<?php echo do_shortcode('[contact-form-7 id="35" title="Contact US"]'); ?>
			</form>
			<div class="contact-content">
				<p><?php _e('For any questions please contact me','markup'); ?></p>
				<p>
					<?php _e('by phone','markup'); ?>: <br>
					<a href="tel:<?php echo $options['phone_num'] ? $options['phone_num'] : '+393278431411' ?>"><?php echo $options['phone_num'] ? $options['phone_num'] : '+393278431411' ?></a> <br>
					<?php _e('also in WhatsApp','markup'); ?> <br>
				</p>

				<p>
					<?php _e('send me e-mail','markup'); ?> <br>
					<a href="mailto:<?php echo $options['Email'] ? $options['Email'] : 'olgamufel@gmail.com' ?>"><?php echo $options['Email'] ? $options['Email'] : 'olgamufel@gmail.com' ?></a>
				</p>
				<p>
					<?php _e('skype','markup'); ?>: <br>
					<a href="skype:<?php echo $options['Skype'] ? $options['Skype'] : 'barmaleika2' ?>"><?php echo $options['Skype'] ? $options['Skype'] : 'barmaleika2' ?></a>
				</p>
			</div>
		</div>
	</section>

<!-- Story Section -->
<?php if(get_field('story_content')){
	$story_photo = get_field('story_photo');  ?>

	<section class="story" id="story">
		<div class="container">
			<div class="title"><h2><?php _e('MY STORY','markup'); ?></h2></div>
			<div class="story-block">
				<div class="story-img-holder">
					<img src="<?php echo $story_photo['url']; ?>" alt="<?php echo $story_photo['alt']; ?>">
				</div>
			</div>
			<?php the_field('story_content'); ?>
		</div>
	</section>

<?php } ?>

<?php if (have_posts()): while (have_posts()): the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>