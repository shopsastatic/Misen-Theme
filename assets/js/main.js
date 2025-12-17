/**
 * MISEN Theme Main JavaScript
 *
 * @package MISEN
 * @since 1.0.0
 */

(function($) {
  'use strict';

  /**
   * Document Ready
   */
  $(document).ready(function() {
    
    // Mobile Menu Toggle
    initMobileMenu();
    
    // Smooth Scroll
    initSmoothScroll();
    
    // Job Search and Filter
    initJobFilters();
    
    // External Links
    initExternalLinks();
    
    // Back to Top Button
    initBackToTop();
    
  });

  /**
   * Mobile Menu
   */
  function initMobileMenu() {
    const menuBtn = $('#menuBtn');
    const closeMenuBtn = $('#closeMenu');
    const mobileMenu = $('#mobileMenu');
    const menuOverlay = $('#menuOverlay');

    function openMenu() {
      mobileMenu.addClass('open');
      menuOverlay.addClass('open');
      menuBtn.addClass('active');
      $('body').css('overflow', 'hidden');
    }

    function closeMenu() {
      mobileMenu.removeClass('open');
      menuOverlay.removeClass('open');
      menuBtn.removeClass('active');
      $('body').css('overflow', '');
    }

    menuBtn.on('click', openMenu);
    closeMenuBtn.on('click', closeMenu);
    menuOverlay.on('click', closeMenu);
    
    // Close on link click
    mobileMenu.find('a').on('click', closeMenu);
    
    // Close on ESC key
    $(document).on('keydown', function(e) {
      if (e.key === 'Escape' && mobileMenu.hasClass('open')) {
        closeMenu();
      }
    });
  }

  /**
   * Smooth Scroll for Anchor Links
   */
  function initSmoothScroll() {
    $('a[href^="#"]').not('[href="#"]').on('click', function(e) {
      const targetId = $(this).attr('href');
      const targetElement = $(targetId);
      
      if (targetElement.length) {
        e.preventDefault();
        const headerOffset = 100;
        const elementPosition = targetElement.offset().top;
        const offsetPosition = elementPosition - headerOffset;

        $('html, body').animate({
          scrollTop: offsetPosition
        }, 600, 'swing');
      }
    });
  }

  /**
   * Job Filters and Search
   */
  function initJobFilters() {
    if ($('#jobsGrid').length === 0) return;

    const filterBtns = $('.filter-btn');
    const jobCards = $('.job-card');
    const jobCount = $('#jobCount');
    const jobsGrid = $('#jobsGrid');
    const noResults = $('#noResults');
    const searchInput = $('#searchInput');
    const sortSelect = $('#sortJobs');

    // Filter by department
    filterBtns.on('click', function() {
      filterBtns.removeClass('active');
      $(this).addClass('active');

      const filter = $(this).data('filter');
      filterJobs(filter, searchInput.val());
    });

    // Search functionality
    searchInput.on('input', function() {
      const activeFilter = $('.filter-btn.active').data('filter');
      filterJobs(activeFilter, $(this).val());
    });

    // Sort functionality
    if (sortSelect.length) {
      sortSelect.on('change', function() {
        sortJobs($(this).val());
      });
    }

    function filterJobs(department, searchTerm) {
      let visibleCount = 0;
      searchTerm = searchTerm.toLowerCase();

      jobCards.each(function() {
        const $card = $(this);
        const cardDept = $card.data('department');
        const cardTitle = $card.find('.job-title').text().toLowerCase();
        const cardDesc = $card.find('.job-desc').text().toLowerCase();

        const deptMatch = department === 'all' || cardDept === department;
        const searchMatch = !searchTerm || 
                          cardTitle.includes(searchTerm) || 
                          cardDesc.includes(searchTerm);

        if (deptMatch && searchMatch) {
          $card.show();
          visibleCount++;
        } else {
          $card.hide();
        }
      });

      // Update count
      if (jobCount.length) {
        jobCount.text(visibleCount);
      }

      // Show/hide no results
      if (visibleCount === 0) {
        jobsGrid.hide();
        noResults.removeClass('hidden');
      } else {
        jobsGrid.show();
        noResults.addClass('hidden');
      }
    }

    function sortJobs(sortBy) {
      const $container = jobsGrid;
      const $cards = $container.find('.job-card');

      $cards.sort(function(a, b) {
        switch(sortBy) {
          case 'title':
            const titleA = $(a).find('.job-title').text().toLowerCase();
            const titleB = $(b).find('.job-title').text().toLowerCase();
            return titleA.localeCompare(titleB);
          
          case 'department':
            const deptA = $(a).data('department') || '';
            const deptB = $(b).data('department') || '';
            return deptA.localeCompare(deptB);
          
          case 'date':
          default:
            // Keep original order (most recent first)
            return 0;
        }
      });

      $cards.detach().appendTo($container);
    }

    // Reset filters function (exposed globally)
    window.resetFilters = function() {
      filterBtns.first().trigger('click');
      searchInput.val('').trigger('input');
    };
  }

  /**
   * External Links
   * Add target="_blank" and rel="noopener" to external links
   */
  function initExternalLinks() {
    $('a[href^="http"]').not('[href*="' + window.location.hostname + '"]').each(function() {
      $(this).attr('target', '_blank');
      $(this).attr('rel', 'noopener noreferrer');
    });
  }

  /**
   * Back to Top Button
   */
  function initBackToTop() {
    // Create back to top button
    const $backToTop = $('<button>', {
      id: 'backToTop',
      class: 'fixed bottom-8 right-8 w-12 h-12 bg-gray-900 text-white rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50 flex items-center justify-center hover:bg-gray-800',
      html: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>',
      'aria-label': 'Back to top'
    });

    $('body').append($backToTop);

    // Show/hide on scroll
    $(window).on('scroll', function() {
      if ($(this).scrollTop() > 300) {
        $backToTop.css({ opacity: 1, visibility: 'visible' });
      } else {
        $backToTop.css({ opacity: 0, visibility: 'hidden' });
      }
    });

    // Scroll to top on click
    $backToTop.on('click', function() {
      $('html, body').animate({ scrollTop: 0 }, 600);
    });
  }

  /**
   * AJAX Job Search (if needed)
   */
  function ajaxJobSearch() {
    $('#jobSearchForm').on('submit', function(e) {
      e.preventDefault();

      const searchTerm = $('#searchInput').val();
      const department = $('.filter-btn.active').data('filter');

      $.ajax({
        url: misenAjax.ajaxurl,
        type: 'POST',
        data: {
          action: 'misen_job_search',
          nonce: misenAjax.nonce,
          search: searchTerm,
          department: department
        },
        beforeSend: function() {
          $('#jobsGrid').addClass('opacity-50');
        },
        success: function(response) {
          if (response.success) {
            $('#jobsGrid').html(response.data.html);
            $('#jobCount').text(response.data.count);
          } else {
            $('#jobsGrid').hide();
            $('#noResults').removeClass('hidden');
          }
        },
        error: function() {
          alert('An error occurred. Please try again.');
        },
        complete: function() {
          $('#jobsGrid').removeClass('opacity-50');
        }
      });
    });
  }

  /**
   * Lazy Load Images (if needed)
   */
  function lazyLoadImages() {
    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.remove('lazy');
            imageObserver.unobserve(img);
          }
        });
      });

      document.querySelectorAll('img.lazy').forEach(function(img) {
        imageObserver.observe(img);
      });
    }
  }

  /**
   * Share Job Function
   */
  window.shareJob = function() {
    if (navigator.share) {
      navigator.share({
        title: document.title,
        url: window.location.href
      }).catch(console.error);
    } else {
      // Fallback: copy to clipboard
      navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link copied to clipboard!');
      });
    }
  };

  /**
   * Animate on Scroll (optional)
   */
  function initAOS() {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('aos-animate');
        }
      });
    }, observerOptions);

    document.querySelectorAll('.aos').forEach(function(el) {
      observer.observe(el);
    });
  }

  /**
   * Window Load
   */
  $(window).on('load', function() {
    // Initialize animations or other load-dependent features
    if (typeof initAOS === 'function') {
      initAOS();
    }
  });

})(jQuery);
