<?php
/**
 * The template for displaying 404 pages
 *
 * @package MISEN
 * @since 1.0.0
 */

get_header();
?>

<style>
.error-page {
  min-height: calc(100vh - 200px);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 80px 20px 40px;
  background: #0a0a0a;
  position: relative;
  overflow: hidden;
}

.error-number {
  font-size: clamp(120px, 25vw, 280px);
  font-weight: 900;
  line-height: 1;
  letter-spacing: -0.05em;
  background: linear-gradient(180deg, #333 0%, #111 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  user-select: none;
  margin-bottom: 1rem;
}

.error-content {
  position: relative;
  z-index: 10;
  text-align: center;
  max-width: 600px;
}

.glow {
  position: absolute;
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.3;
  pointer-events: none;
}

.glow-1 {
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, #1a1a2e 0%, transparent 70%);
  top: -20%;
  left: -10%;
}

.glow-2 {
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, #16213e 0%, transparent 70%);
  bottom: -10%;
  right: -10%;
}

.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-size: 15px;
  font-weight: 600;
  padding: 14px 28px;
  border-radius: 100px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.btn-white {
  background: #fff;
  color: #0a0a0a;
}

.btn-white:hover {
  transform: translateY(-2px);
  box-shadow: 0 16px 40px rgba(255,255,255,0.1);
}

.btn-ghost {
  background: transparent;
  color: #888;
  border: 1px solid #333;
}

.btn-ghost:hover {
  border-color: #555;
  color: #fff;
}

.quick-links a {
  color: #666;
  transition: color 0.2s;
  text-decoration: none;
}

.quick-links a:hover {
  color: #fff;
}
</style>

<div class="error-page">
  <div class="glow glow-1"></div>
  <div class="glow glow-2"></div>

  <div class="error-content">
    <div class="error-number">404</div>

    <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">
      Page not found
    </h1>

    <p class="text-gray-500 text-lg mb-10">
      Oops! The page you're looking for doesn't exist or has been moved.
    </p>

    <div class="flex flex-wrap justify-center gap-4 mb-16">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-white">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Go to Homepage
      </a>
      <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-ghost">
        Contact Support
      </a>
    </div>

    <!-- Quick Links -->
    <div class="quick-links">
      <p class="text-sm text-gray-600 mb-4">Or try these popular pages:</p>
      <div class="flex flex-wrap justify-center gap-6 text-sm">
        <a href="<?php echo esc_url(home_url('/#about')); ?>">About Us</a>
        <a href="<?php echo esc_url(home_url('/careers')); ?>">Careers</a>
        <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a>
        <?php if (get_post_type_archive_link('post')) : ?>
          <a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">Blog</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
