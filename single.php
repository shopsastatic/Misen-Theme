<?php
/**
 * The template for displaying all single posts
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
          <!-- Breadcrumb -->
          <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-gray-900 transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="hover:text-gray-900 transition">Blog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900"><?php echo wp_trim_words(get_the_title(), 5); ?></span>
          </div>

          <?php the_category(', '); ?>

          <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 tracking-tight mb-4 mt-4">
            <?php the_title(); ?>
          </h1>

          <div class="flex items-center gap-4 text-sm text-gray-500">
            <time datetime="<?php echo get_the_date('c'); ?>">
              <?php echo get_the_date(); ?>
            </time>
            <span>•</span>
            <span><?php echo esc_html(get_the_author()); ?></span>
            <?php if (function_exists('the_views')) : ?>
              <span>•</span>
              <span><?php the_views(); ?></span>
            <?php endif; ?>
          </div>
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

        <footer class="mt-12 pt-8 border-t border-gray-200">
          <?php
          // Post tags
          the_tags('<div class="flex flex-wrap gap-2 mb-6">', '', '</div>');
          ?>

          <!-- Share buttons -->
          <div class="flex items-center gap-4">
            <span class="text-sm font-medium text-gray-900">Share:</span>
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="text-gray-500 hover:text-gray-900 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="text-gray-500 hover:text-gray-900 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="text-gray-500 hover:text-gray-900 transition">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
          </div>
        </footer>

      </article>

      <?php
      // Author box
      get_template_part('template-parts/author', 'box');

      // Related posts
      get_template_part('template-parts/related', 'posts');

      // Comments
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;
      ?>

    <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
