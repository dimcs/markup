<?php get_header(); ?>
<div class="container main-heading">
	<h1><?php the_title(); ?></h1>
</div>
<div class="container">
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>