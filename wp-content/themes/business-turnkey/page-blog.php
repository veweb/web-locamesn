<?php 
/* Template Name: Blog page  */ 
?>

<?php get_header(); ?>


<?php $options = get_option('turnkey_theme_options'); ?>

<div id="content" class="group <?php echo $options['numcols']; ?>">

	<div id="main-content">
	<?php
	$temp = $wp_query;
	$limit = get_option('posts_per_page');
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$wp_query= null;
	$wp_query = new WP_Query();
	$wp_query->query('showposts=' . $limit . '&paged=' . $paged);
	$wp_query->is_home = false;
	?>
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<?php if($options['showDates'] == true) { ?>
			<span class="date"><?php the_time('M'); ?><strong><?php the_time('d'); ?></strong></span>
			<?php } ?>
			<div class="post-content group">					
				<div class="post-content-container">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		      <span class="info">
		      	<strong class="author">Posted by <?php the_author_link(); ?></strong>
		      	<strong class="comments"><a href="<?php comments_link(); ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a></strong>
		      </span>
		
					<div class="post-text">
					<?php if($options['numcols'] == 'three-col') { ?>
						<?php the_post_thumbnail('post-thumb-threecol'); ?>
					<?php } else { ?>
						<?php the_post_thumbnail('post-thumb-onetwocol'); ?>
					<?php } 
					the_excerpt(); ?>
					</div><!-- .post-text -->	
					<p class="keep-reading"><a href="<?php the_permalink(); ?>" class="btn">Keep Reading &rarr;</a></p>
				</div><!-- .post-content-container -->
			</div><!-- .post-content -->
		</div><!-- .post -->	
		<?php endwhile; else : ?>
	
			<div class="post">
			
				<h2>Page Not Found</h2>
				
				<p>Looks like the page you're looking for isn't here anymore. Try browsing the <a href="">categories</a>, <a href="">archives</a>, or using the search box below.</p>
				
				<?php get_search_form(); ?>
			
			</div> <!-- .post -->
	
		<?php endif; ?>
	
		<div id="blog-nav">
			<span class="prev btn"><?php next_posts_link('&larr; &nbsp; Previous') ?></span> 
			<span class="next btn"><?php next_posts_link('Next &nbsp; &rarr;') ?></span>
		</div>
	
	</div><!-- #main-content -->

	<?php get_sidebar(); ?>              

</div><!-- #content -->


<?php get_footer(); ?>