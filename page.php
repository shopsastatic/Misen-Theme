<?php
/**
 * The template for displaying all pages
 *
 * @package MISEN
 * @since 1.0.0
 */

get_header();
?>

<div class="pt-28 pb-16 px-4 sm:px-6">
  <div class="max-w-4xl mx-auto">
    <?php
    while (have_posts()) : the_post();
    ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <header class="mb-8">
          <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4">
            <?php the_title(); ?>
          </h1>
          
          <?php if (has_excerpt()) : ?>
            <div class="text-lg text-gray-600 leading-relaxed">
              <?php the_excerpt(); ?>
            </div>
          <?php endif; ?>
        </header>

        <?php if (has_post_thumbnail()) : ?>
          <div class="mb-8 rounded-2xl overflow-hidden">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
          </div>
        <?php endif; ?>

        <div class="prose prose-lg max-w-none">
          <?php
          the_content();

          wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'misen'),
            'after'  => '</div>',
          ));
          ?>
        </div>

      </article>

      <?php
      // If comments are open or we have at least one comment, load up the comment template.
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;
      ?>

    <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
