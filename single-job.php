<?php
/**
 * Template for displaying single job posts
 *
 * @package MISEN
 * @since 1.0.0
 */

get_header();

while (have_posts()) : the_post();

$departments = get_the_terms(get_the_ID(), 'department');
$locations = get_the_terms(get_the_ID(), 'location');
$job_types = get_the_terms(get_the_ID(), 'job_type');

// Get ACF fields
$experience = misen_get_job_field('experience_required');
$salary = misen_get_job_field('salary_range');
$external_url = misen_get_job_field('external_apply_url');
$responsibilities = misen_get_job_field('responsibilities');
$requirements = misen_get_job_field('requirements');
$benefits = misen_get_job_field('benefits');
$remote_work = misen_get_job_field('remote_work');
?>

<style>
body { background: #fafafa; }

.job-hero {
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
  position: relative;
  overflow: hidden;
}

.job-hero::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -20%;
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 60%);
}

.tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  background: rgba(255,255,255,0.1);
  border-radius: 100px;
  font-size: 13px;
  font-weight: 500;
  color: #999;
}

.content-card {
  background: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 24px;
  padding: 32px;
}

.section-title {
  font-size: 20px;
  font-weight: 700;
  color: #111;
  margin-bottom: 16px;
}

.list-item {
  display: flex;
  gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid #f5f5f5;
}

.list-item:last-child {
  border-bottom: none;
}

.list-icon {
  width: 20px;
  height: 20px;
  background: #f5f5f5;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  margin-top: 2px;
}

.sidebar-card {
  background: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 20px;
  padding: 24px;
}

.apply-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  background: #111;
  color: #fff;
  font-size: 15px;
  font-weight: 600;
  padding: 16px 24px;
  border-radius: 14px;
  transition: all 0.3s ease;
  text-decoration: none;
  border: none;
  cursor: pointer;
}

.apply-btn:hover {
  background: #222;
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

.share-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  background: #f5f5f5;
  color: #111;
  font-size: 14px;
  font-weight: 600;
  padding: 14px 24px;
  border-radius: 14px;
  transition: all 0.2s ease;
  text-decoration: none;
  border: none;
  cursor: pointer;
}

.share-btn:hover {
  background: #eee;
}

.info-row {
  display: flex;
  justify-content: space-between;
  padding: 14px 0;
  border-bottom: 1px solid #f5f5f5;
}

.info-row:last-child {
  border-bottom: none;
}

.info-label {
  font-size: 14px;
  color: #888;
}

.info-value {
  font-size: 14px;
  font-weight: 600;
  color: #111;
}

.benefit-card {
  display: flex;
  align-items: start;
  gap: 14px;
  padding: 16px;
  background: #fafafa;
  border-radius: 14px;
  transition: all 0.3s ease;
}

.benefit-card:hover {
  background: #f5f5f5;
}

.benefit-icon {
  width: 40px;
  height: 40px;
  background: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 500;
  color: #666;
  transition: all 0.2s ease;
  text-decoration: none;
}

.back-link:hover {
  color: #fff;
  gap: 12px;
}
</style>

<!-- Job Hero -->
<section class="job-hero pt-28 pb-16 px-4 sm:px-6">
  <div class="max-w-6xl mx-auto relative z-10">
    <a href="<?php echo esc_url(get_post_type_archive_link('job')); ?>" class="back-link text-gray-500 hover:text-white mb-6 inline-flex">
      <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
      </svg>
      Back to all jobs
    </a>
    
    <div class="flex flex-wrap gap-3 mb-6">
      <?php if ($departments && !is_wp_error($departments)) : ?>
        <span class="tag">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          <?php echo esc_html($departments[0]->name); ?>
        </span>
      <?php endif; ?>
      
      <?php if ($locations && !is_wp_error($locations)) : ?>
        <span class="tag">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <?php echo esc_html($locations[0]->name); ?>
        </span>
      <?php endif; ?>
      
      <?php if ($job_types && !is_wp_error($job_types)) : ?>
        <span class="tag">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <?php echo esc_html($job_types[0]->name); ?>
        </span>
      <?php endif; ?>
    </div>
    
    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-4">
      <?php the_title(); ?>
    </h1>
    
    <?php if (has_excerpt()) : ?>
      <p class="text-lg text-gray-400 max-w-2xl">
        <?php echo esc_html(get_the_excerpt()); ?>
      </p>
    <?php endif; ?>
  </div>
</section>

<!-- Main Content -->
<section class="py-12 px-4 sm:px-6">
  <div class="max-w-6xl mx-auto">
    <div class="grid lg:grid-cols-3 gap-8">
      
      <!-- Left Content -->
      <div class="lg:col-span-2 space-y-8">
        
        <!-- About Role -->
        <?php if (get_the_content()) : ?>
          <div class="content-card">
            <h2 class="section-title">About the Role</h2>
            <div class="text-gray-600 leading-relaxed prose prose-sm max-w-none">
              <?php the_content(); ?>
            </div>
          </div>
        <?php endif; ?>
        
        <!-- Responsibilities -->
        <?php if ($responsibilities) : ?>
          <div class="content-card">
            <h2 class="section-title">What You'll Do</h2>
            <div>
              <?php
              $items = explode("\n", trim($responsibilities));
              foreach ($items as $item) :
                $item = trim($item);
                if (empty($item)) continue;
              ?>
                <div class="list-item">
                  <div class="list-icon">
                    <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <span class="text-gray-600"><?php echo esc_html($item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        
        <!-- Requirements -->
        <?php if ($requirements) : ?>
          <div class="content-card">
            <h2 class="section-title">What We're Looking For</h2>
            <div>
              <?php
              $items = explode("\n", trim($requirements));
              foreach ($items as $item) :
                $item = trim($item);
                if (empty($item)) continue;
              ?>
                <div class="list-item">
                  <div class="list-icon">
                    <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <span class="text-gray-600"><?php echo esc_html($item); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        
        <!-- Benefits -->
        <?php if ($benefits) : ?>
          <div class="content-card">
            <h2 class="section-title">What We Offer</h2>
            <div class="grid sm:grid-cols-2 gap-4">
              <?php
              $items = explode("\n", trim($benefits));
              foreach ($items as $item) :
                $item = trim($item);
                if (empty($item)) continue;
              ?>
                <div class="benefit-card">
                  <div class="benefit-icon">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <div>
                    <h4 class="font-semibold text-gray-900 text-sm"><?php echo esc_html($item); ?></h4>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        
      </div>
      
      <!-- Sidebar -->
      <div class="lg:col-span-1">
        <div class="sticky top-24 space-y-6">
          
          <!-- Apply Section -->
          <div class="sidebar-card space-y-4">
            <?php if ($external_url) : ?>
              <a href="<?php echo esc_url($external_url); ?>" target="_blank" rel="noopener" class="apply-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Apply for this position
              </a>
            <?php else : ?>
              <a href="<?php echo esc_url(home_url('/contact')); ?>?job=<?php echo urlencode(get_the_title()); ?>" class="apply-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Apply for this position
              </a>
            <?php endif; ?>
            
            <button class="share-btn" onclick="shareJob()">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
              </svg>
              Share this job
            </button>
          </div>
          
          <!-- Job Info -->
          <div class="sidebar-card">
            <h3 class="font-semibold text-gray-900 mb-4">Job Details</h3>
            <div>
              <?php if ($departments && !is_wp_error($departments)) : ?>
                <div class="info-row">
                  <span class="info-label">Department</span>
                  <span class="info-value"><?php echo esc_html($departments[0]->name); ?></span>
                </div>
              <?php endif; ?>
              
              <?php if ($locations && !is_wp_error($locations)) : ?>
                <div class="info-row">
                  <span class="info-label">Location</span>
                  <span class="info-value"><?php echo esc_html($locations[0]->name); ?></span>
                </div>
              <?php endif; ?>
              
              <?php if ($job_types && !is_wp_error($job_types)) : ?>
                <div class="info-row">
                  <span class="info-label">Type</span>
                  <span class="info-value"><?php echo esc_html($job_types[0]->name); ?></span>
                </div>
              <?php endif; ?>
              
              <?php if ($experience) : ?>
                <div class="info-row">
                  <span class="info-label">Experience</span>
                  <span class="info-value"><?php echo esc_html($experience); ?></span>
                </div>
              <?php endif; ?>
              
              <?php if ($salary) : ?>
                <div class="info-row">
                  <span class="info-label">Salary</span>
                  <span class="info-value"><?php echo esc_html($salary); ?></span>
                </div>
              <?php endif; ?>
              
              <?php if ($remote_work && $remote_work !== 'no') : ?>
                <div class="info-row">
                  <span class="info-label">Remote</span>
                  <span class="info-value"><?php echo esc_html(ucfirst($remote_work)); ?></span>
                </div>
              <?php endif; ?>
              
              <div class="info-row">
                <span class="info-label">Posted</span>
                <span class="info-value"><?php echo misen_get_job_posted_time(); ?></span>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      
    </div>
  </div>
</section>

<script>
function shareJob() {
  if (navigator.share) {
    navigator.share({
      title: '<?php echo esc_js(get_the_title()); ?>',
      text: '<?php echo esc_js(get_the_excerpt()); ?>',
      url: '<?php echo esc_js(get_permalink()); ?>'
    }).catch(console.error);
  } else {
    // Fallback: copy to clipboard
    const url = '<?php echo esc_js(get_permalink()); ?>';
    navigator.clipboard.writeText(url).then(() => {
      alert('Link copied to clipboard!');
    });
  }
}
</script>

<?php
endwhile;
get_footer();
?>
