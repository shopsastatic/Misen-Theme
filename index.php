<?php
/**
 * The main template file
 *
 * @package MISEN
 * @since 1.0.0
 */

get_header();
?>

<div class="container mx-auto px-4 py-16 max-w-4xl">
  <?php if (have_posts()) : ?>
    
    <header class="mb-12">
      <?php if (is_home() && !is_front_page()) : ?>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
          <?php single_post_title(); ?>
        </h1>
      <?php elseif (is_archive()) : ?>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
          <?php the_archive_title(); ?>
        </h1>
        <?php the_archive_description('<div class="text-gray-600">', '</div>'); ?>
      <?php elseif (is_search()) : ?>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
          <?php printf(esc_html__('Search Results for: %s', 'misen'), '<span>' . get_search_query() . '</span>'); ?>
        </h1>
      <?php endif; ?>
    </header>

    <div class="space-y-8">
      <?php
      while (have_posts()) : the_post();
        get_template_part('template-parts/content', get_post_type());
      endwhile;
      ?>
    </div>

    <?php
    // Pagination
    the_posts_pagination(array(
      'mid_size'  => 2,
      'prev_text' => __('&larr; Previous', 'misen'),
      'next_text' => __('Next &rarr;', 'misen'),
    ));
    ?>

  <?php else : ?>
    
    <div class="text-center py-16">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">
        <?php esc_html_e('Nothing Found', 'misen'); ?>
      </h2>
      <p class="text-gray-600 mb-8">
        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'misen'); ?>
      </p>
      <?php get_search_form(); ?>
    </div>

  <?php endif; ?>
</div>

<?php get_footer(); ?>
