<?php
/**
 * Template for displaying job archives
 *
 * @package MISEN
 * @since 1.0.0
 */

get_header();

// Get job count
$job_count = wp_count_posts('job')->publish;
?>

<style>
@import url('https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700,900&display=swap');
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Satoshi', sans-serif; background: #fafafa; }

.careers-hero {
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
  position: relative;
  overflow: hidden;
}

.careers-hero::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -30%;
  width: 800px;
  height: 800px;
  background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 60%);
}

.careers-hero::after {
  content: '';
  position: absolute;
  bottom: -30%;
  left: -20%;
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, rgba(255,255,255,0.02) 0%, transparent 60%);
}

.search-box {
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  padding: 6px;
  display: flex;
  gap: 8px;
}

.search-input {
  flex: 1;
  background: transparent;
  border: none;
  padding: 12px 16px;
  color: #fff;
  font-size: 15px;
}

.search-input::placeholder { color: #666; }
.search-input:focus { outline: none; }

.search-btn {
  background: #fff;
  color: #111;
  font-weight: 600;
  font-size: 14px;
  padding: 12px 24px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.2s ease;
  border: none;
  cursor: pointer;
}

.search-btn:hover { background: #f5f5f5; }

.filter-btn {
  padding: 10px 20px;
  background: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 100px;
  font-size: 14px;
  font-weight: 500;
  color: #666;
  transition: all 0.2s ease;
  cursor: pointer;
}

.filter-btn:hover, .filter-btn.active {
  background: #111;
  color: #fff;
  border-color: #111;
}

.job-card {
  background: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 20px;
  padding: 28px;
  transition: all 0.3s ease;
  text-decoration: none;
  display: block;
}

.job-card:hover {
  border-color: #111;
  transform: translateY(-4px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

.job-card:hover .job-arrow { transform: translateX(4px); }

.job-tag {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 6px 12px;
  background: #f5f5f5;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 500;
  color: #666;
}

.job-title {
  font-size: 20px;
  font-weight: 600;
  color: #111;
  margin: 16px 0 8px;
}

.job-desc {
  font-size: 14px;
  color: #888;
  line-height: 1.5;
  margin-bottom: 16px;
}

.job-arrow {
  width: 40px;
  height: 40px;
  background: #f5f5f5;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.job-card:hover .job-arrow {
  background: #111;
  color: #fff;
}

.stat-box {
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 16px;
  padding: 24px;
  text-align: center;
}

.stat-num {
  font-size: 32px;
  font-weight: 700;
  color: #fff;
}

.stat-label {
  font-size: 13px;
  color: #666;
  margin-top: 4px;
}

.value-card {
  background: #fff;
  border: 1px solid #e5e5e5;
  border-radius: 20px;
  padding: 28px;
  text-align: center;
  transition: all 0.3s ease;
}

.value-card:hover {
  border-color: #ddd;
  transform: translateY(-4px);
}
</style>

<!-- Hero Section -->
<section class="careers-hero pt-32 pb-20 px-4 sm:px-6">
  <div class="max-w-6xl mx-auto relative z-10">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition">Home</a>
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
      <span class="text-gray-400">Careers</span>
    </div>
    
    <!-- Hero Content -->
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div>
        <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 border border-white/10 rounded-full text-sm text-gray-300 mb-6">
          <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
          We're Hiring - <?php echo $job_count; ?> Open Position<?php echo $job_count != 1 ? 's' : ''; ?>
        </span>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6">
          Build the future of D2C with us
        </h1>
        
        <p class="text-lg text-gray-400 leading-relaxed mb-8">
          Join a team of passionate people building global brands that consumers love. We offer competitive compensation, flexible work, and the opportunity to make real impact.
        </p>
        
        <!-- Search Box -->
        <form role="search" method="get" class="search-box" id="jobSearchForm">
          <input type="text" name="s" class="search-input" placeholder="Search positions..." id="searchInput" value="<?php echo get_search_query(); ?>"/>
          <input type="hidden" name="post_type" value="job" />
          <button type="submit" class="search-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Search
          </button>
        </form>
      </div>
      
      <!-- Stats -->
      <div class="grid grid-cols-2 gap-4">
        <div class="stat-box">
          <div class="stat-num">50+</div>
          <div class="stat-label">Team Members</div>
        </div>
        <div class="stat-box">
          <div class="stat-num">127%</div>
          <div class="stat-label">YoY Growth</div>
        </div>
        <div class="stat-box">
          <div class="stat-num">10+</div>
          <div class="stat-label">Countries</div>
        </div>
        <div class="stat-box">
          <div class="stat-num">5+</div>
          <div class="stat-label">D2C Brands</div>
        </div>
      </div>
    </div>
    
  </div>
</section>

<!-- Filter & Jobs Section -->
<section class="py-16 px-4 sm:px-6">
  <div class="max-w-6xl mx-auto">
    
    <!-- Filters -->
    <div class="flex flex-wrap gap-3 mb-10">
      <button class="filter-btn active" data-filter="all">All Positions</button>
      <?php
      $departments = get_terms(array(
        'taxonomy' => 'department',
        'hide_empty' => true,
      ));
      if ($departments && !is_wp_error($departments)) :
        foreach ($departments as $department) :
      ?>
        <button class="filter-btn" data-filter="<?php echo esc_attr($department->slug); ?>">
          <?php echo esc_html($department->name); ?>
        </button>
      <?php
        endforeach;
      endif;
      ?>
    </div>
    
    <!-- Results Count -->
    <div class="flex items-center justify-between mb-6">
      <p class="text-gray-500 text-sm">
        <span id="jobCount"><?php echo $job_count; ?></span> position<?php echo $job_count != 1 ? 's' : ''; ?> available
      </p>
      <div class="flex items-center gap-2 text-sm text-gray-500">
        <span>Sort by:</span>
        <select class="bg-transparent font-medium text-gray-900 cursor-pointer focus:outline-none" id="sortJobs">
          <option value="date">Most Recent</option>
          <option value="title">Title</option>
          <option value="department">Department</option>
        </select>
      </div>
    </div>
    
    <!-- Jobs Grid -->
    <div class="grid md:grid-cols-2 gap-5" id="jobsGrid">
      <?php
      $args = array(
        'post_type' => 'job',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
      );
      
      $jobs = new WP_Query($args);
      
      if ($jobs->have_posts()) :
        while ($jobs->have_posts()) : $jobs->the_post();
          get_template_part('template-parts/content', 'job-card');
        endwhile;
        wp_reset_postdata();
      else :
      ?>
        <div class="col-span-2 text-center py-16">
          <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">No positions available</h3>
          <p class="text-gray-500 mb-6">Check back soon for new opportunities!</p>
        </div>
      <?php endif; ?>
    </div>
    
    <!-- No Results Message (Hidden by default) -->
    <div id="noResults" class="hidden text-center py-16">
      <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
      <h3 class="text-xl font-semibold text-gray-900 mb-2">No positions found</h3>
      <p class="text-gray-500 mb-6">Try adjusting your search or filter criteria</p>
      <button class="text-sm font-medium text-gray-900 hover:underline" onclick="resetFilters()">Clear all filters</button>
    </div>
    
  </div>
</section>

<!-- Why Join Section -->
<section class="py-16 px-4 sm:px-6 bg-white">
  <div class="max-w-6xl mx-auto">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight mb-4">Why join MISEN?</h2>
      <p class="text-gray-500 max-w-xl mx-auto">We offer more than just a job - we offer the opportunity to build something meaningful.</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-6">
      <div class="value-card">
        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
          <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Fast Growth</h3>
        <p class="text-sm text-gray-600 leading-relaxed">Rapid career progression in a scaling company</p>
      </div>
      
      <div class="value-card">
        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
          <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Global Impact</h3>
        <p class="text-sm text-gray-600 leading-relaxed">Build brands that reach customers worldwide</p>
      </div>
      
      <div class="value-card">
        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
          <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Competitive Pay</h3>
        <p class="text-sm text-gray-600 leading-relaxed">Market-leading salaries and benefits</p>
      </div>
    </div>
  </div>
</section>

<script>
// Job filtering
document.addEventListener('DOMContentLoaded', function() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const jobCards = document.querySelectorAll('.job-card');
  const jobCount = document.getElementById('jobCount');
  const jobsGrid = document.getElementById('jobsGrid');
  const noResults = document.getElementById('noResults');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      // Update active state
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const filter = this.dataset.filter;
      let visibleCount = 0;

      jobCards.forEach(card => {
        if (filter === 'all' || card.dataset.department === filter) {
          card.style.display = 'block';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      // Update count
      jobCount.textContent = visibleCount;

      // Show/hide no results
      if (visibleCount === 0) {
        jobsGrid.style.display = 'none';
        noResults.classList.remove('hidden');
      } else {
        jobsGrid.style.display = 'grid';
        noResults.classList.add('hidden');
      }
    });
  });

  // Search functionality
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      let visibleCount = 0;

      jobCards.forEach(card => {
        const title = card.querySelector('.job-title').textContent.toLowerCase();
        const desc = card.querySelector('.job-desc').textContent.toLowerCase();

        if (title.includes(searchTerm) || desc.includes(searchTerm)) {
          card.style.display = 'block';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      jobCount.textContent = visibleCount;

      if (visibleCount === 0) {
        jobsGrid.style.display = 'none';
        noResults.classList.remove('hidden');
      } else {
        jobsGrid.style.display = 'grid';
        noResults.classList.add('hidden');
      }
    });
  }
});

function resetFilters() {
  document.querySelector('.filter-btn[data-filter="all"]').click();
  document.getElementById('searchInput').value = '';
  document.getElementById('searchInput').dispatchEvent(new Event('input'));
}
</script>

<?php get_footer(); ?>
