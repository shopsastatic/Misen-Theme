<?php
/**
 * Front Page Template
 *
 * @package MISEN
 * @since 1.0.0
 */

get_header();
?>

<!-- NOTE: This is a simplified front page template -->
<!-- For full homepage design, copy HTML from index.html -->

<div class="pt-20">
  <?php
  // If front page is set to display a static page, show its content
  if (have_posts()) :
    while (have_posts()) : the_post();
      ?>
      <div class="container mx-auto px-4">
        <?php the_content(); ?>
      </div>
      <?php
    endwhile;
  endif;
  ?>

  <!-- Featured Jobs Section -->
  <?php
  $featured_jobs = misen_get_featured_jobs(5);
  
  if ($featured_jobs->have_posts()) :
  ?>
  <section class="py-16 px-4 sm:px-6 bg-white">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight mb-4">
          Open Positions
        </h2>
        <p class="text-gray-500 max-w-xl mx-auto">
          Join our team and help us build the future of D2C commerce
        </p>
      </div>

      <div class="grid md:grid-cols-2 gap-5">
        <?php
        while ($featured_jobs->have_posts()) : $featured_jobs->the_post();
          get_template_part('template-parts/content', 'job-card');
        endwhile;
        wp_reset_postdata();
        ?>
      </div>

      <div class="text-center mt-12">
        <a href="<?php echo esc_url(get_post_type_archive_link('job')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition">
          View All Positions
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
