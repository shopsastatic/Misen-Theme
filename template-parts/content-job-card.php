<?php
/**
 * Template part for displaying job cards
 *
 * @package MISEN
 * @since 1.0.0
 */

$departments = get_the_terms(get_the_ID(), 'department');
$locations = get_the_terms(get_the_ID(), 'location');
$job_types = get_the_terms(get_the_ID(), 'job_type');

$department_slug = ($departments && !is_wp_error($departments)) ? $departments[0]->slug : '';
?>

<a href="<?php the_permalink(); ?>" class="job-card" data-department="<?php echo esc_attr($department_slug); ?>">
  <div class="flex items-start justify-between">
    <div class="flex flex-wrap gap-2">
      <?php if ($departments && !is_wp_error($departments)) : ?>
        <span class="job-tag">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          <?php echo esc_html($departments[0]->name); ?>
        </span>
      <?php endif; ?>
      
      <?php if ($locations && !is_wp_error($locations)) : ?>
        <span class="job-tag"><?php echo esc_html($locations[0]->name); ?></span>
      <?php endif; ?>
    </div>
    <span class="job-arrow">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
      </svg>
    </span>
  </div>
  
  <h3 class="job-title"><?php the_title(); ?></h3>
  
  <p class="job-desc">
    <?php 
    if (has_excerpt()) {
      echo esc_html(get_the_excerpt());
    } else {
      echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
    }
    ?>
  </p>
  
  <div class="flex items-center gap-4 text-xs text-gray-400">
    <?php if ($job_types && !is_wp_error($job_types)) : ?>
      <span class="flex items-center gap-1">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <?php echo esc_html($job_types[0]->name); ?>
      </span>
    <?php endif; ?>
    
    <span><?php echo misen_get_job_posted_time(); ?></span>
  </div>
</a>
