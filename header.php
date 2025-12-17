<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="header fixed w-full top-0 z-50 border-b border-gray-100" style="background: rgba(255,255,255,0.8); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">M</span>
                </div>
                <span class="font-bold text-lg text-gray-900 tracking-tight font-logo"><?php bloginfo('name'); ?></span>
            <?php endif; ?>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-8">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex items-center gap-8',
                'fallback_cb'    => false,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'          => 1,
                'walker'         => new class extends Walker_Nav_Menu {
                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                        $classes = empty($item->classes) ? array() : (array) $item->classes;
                        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
                        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
                        
                        $output .= '<li' . $class_names . '>';
                        
                        $atts = array();
                        $atts['href'] = !empty($item->url) ? $item->url : '';
                        $atts['class'] = 'text-sm font-medium text-gray-600 hover:text-gray-900 transition';
                        
                        if ($item->current) {
                            $atts['class'] .= ' text-gray-900';
                        }
                        
                        $attributes = '';
                        foreach ($atts as $attr => $value) {
                            if (!empty($value)) {
                                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                                $attributes .= ' ' . $attr . '="' . $value . '"';
                            }
                        }
                        
                        $title = apply_filters('the_title', $item->title, $item->ID);
                        
                        $item_output = '<a' . $attributes . '>';
                        $item_output .= $title;
                        $item_output .= '</a>';
                        
                        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
                    }
                }
            ));
            
            // Fallback menu if no menu is set
            if (!has_nav_menu('primary')) : ?>
                <ul class="flex items-center gap-8">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#about')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#vision')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Vision</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#culture')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Culture</a></li>
                    <li><a href="<?php echo esc_url(home_url('/careers')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Careers</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Contact</a></li>
                </ul>
            <?php endif; ?>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="menuBtn" class="md:hidden hamburger flex flex-col gap-1.5 p-2">
            <span class="block w-6 h-0.5 bg-gray-900"></span>
            <span class="block w-6 h-0.5 bg-gray-900"></span>
            <span class="block w-6 h-0.5 bg-gray-900"></span>
        </button>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="menuOverlay" class="menu-overlay fixed inset-0 bg-black/20 backdrop-blur-sm z-40 md:hidden"></div>

<!-- Mobile Menu -->
<div id="mobileMenu" class="mobile-menu fixed top-0 right-0 bottom-0 w-80 bg-white shadow-2xl z-50 md:hidden overflow-y-auto">
    <div class="p-6">
        <!-- Close Button -->
        <div class="flex items-center justify-between mb-8">
            <span class="font-bold text-lg text-gray-900 font-logo"><?php bloginfo('name'); ?></span>
            <button id="closeMenu" class="p-2 hover:bg-gray-100 rounded-xl transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav class="space-y-1">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'space-y-1',
                'fallback_cb'    => false,
                'items_wrap'     => '%3$s',
                'depth'          => 1,
                'walker'         => new class extends Walker_Nav_Menu {
                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                        $classes = 'block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl';
                        if ($item->current) {
                            $classes .= ' bg-gray-100';
                        }
                        
                        $output .= '<a href="' . esc_url($item->url) . '" class="' . $classes . '">';
                        $output .= apply_filters('the_title', $item->title, $item->ID);
                        $output .= '</a>';
                    }
                }
            ));
            
            // Fallback menu
            if (!has_nav_menu('primary')) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl">Home</a>
                <a href="<?php echo esc_url(home_url('/#about')); ?>" class="block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl">About</a>
                <a href="<?php echo esc_url(home_url('/#vision')); ?>" class="block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl">Vision</a>
                <a href="<?php echo esc_url(home_url('/#culture')); ?>" class="block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl">Culture</a>
                <a href="<?php echo esc_url(home_url('/careers')); ?>" class="block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl">Careers</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="block px-4 py-3 text-lg font-medium text-gray-900 hover:bg-gray-100 rounded-xl">Contact</a>
            <?php endif; ?>
        </nav>
    </div>
</div>
