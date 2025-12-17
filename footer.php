<!-- Footer -->
<footer class="bg-gray-900 text-white py-16 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto">
        <!-- Top Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                    <span class="text-gray-900 font-bold text-lg font-logo">M</span>
                </div>
                <span class="text-2xl font-bold tracking-tight font-logo"><?php bloginfo('name'); ?></span>
            </div>
            <p class="text-gray-400 max-w-md text-sm leading-relaxed">
                <?php 
                $description = get_bloginfo('description');
                echo $description ? esc_html($description) : 'Building the future of D2C commerce'; 
                ?>
            </p>
        </div>

        <!-- Links Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 mb-16">
            <!-- Company -->
            <div>
                <h5 class="text-white font-semibold mb-4">Company</h5>
                <ul class="space-y-3">
                    <li><a href="<?php echo esc_url(home_url('/#about')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#vision')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Vision</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#culture')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Culture</a></li>
                    <li><a href="<?php echo esc_url(home_url('/our-team')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Our Team</a></li>
                    <li><a href="<?php echo esc_url(home_url('/careers')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Careers</a></li>
                </ul>
            </div>

            <!-- About -->
            <div>
                <h5 class="text-white font-semibold mb-4">About</h5>
                <ul class="space-y-3">
                    <li><a href="<?php echo esc_url(home_url('/#why')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Why MISEN</a></li>
                    <li><a href="<?php echo esc_url(home_url('/our-brands')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Our Brands</a></li>
                    <li><a href="<?php echo esc_url(home_url('/press-newsroom')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Press & Newsroom</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h5 class="text-white font-semibold mb-4">Resources</h5>
                <ul class="space-y-3">
                    <?php if (get_post_type_archive_link('post')) : ?>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Blog</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo esc_url(home_url('/faq')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">FAQ</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Contact</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h5 class="text-white font-semibold mb-4">Legal</h5>
                <ul class="space-y-3">
                    <li><a href="<?php echo esc_url(home_url('/privacy')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Privacy Policy</a></li>
                    <li><a href="<?php echo esc_url(home_url('/terms')); ?>" class="footer-link text-gray-400 hover:text-white transition text-sm">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4 pt-8 border-t border-gray-800">
            <p class="text-gray-500 text-sm">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
            <p class="text-gray-600 text-sm">Building the future of D2C commerce</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<style>
.footer-link {
    display: block;
}
.footer-link:hover {
    color: #fff;
}
</style>

<script>
// Mobile Menu
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menuBtn');
    const closeMenuBtn = document.getElementById('closeMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');

    if (menuBtn && mobileMenu) {
        function openMenu() {
            mobileMenu.classList.add('open');
            menuOverlay.classList.add('open');
            menuBtn.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            mobileMenu.classList.remove('open');
            menuOverlay.classList.remove('open');
            menuBtn.classList.remove('active');
            document.body.style.overflow = '';
        }

        menuBtn.addEventListener('click', openMenu);
        if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
        if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);
        
        // Close on link click
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    }

    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerOffset = 100;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

</body>
</html>
