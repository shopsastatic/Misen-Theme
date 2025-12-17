# MISEN WordPress Theme

A modern WordPress theme for MISEN - Cross-border E-commerce, featuring a complete job board system with custom post types, taxonomies, and ACF integration.

## Features

- ✅ Custom Post Type: Jobs
- ✅ Custom Taxonomies: Departments, Locations, Job Types
- ✅ ACF (Advanced Custom Fields) Integration
- ✅ Job Search & Filtering
- ✅ Responsive Design (Tailwind CSS)
- ✅ Dark/Light Mode Support
- ✅ Mobile Menu
- ✅ Featured Jobs on Homepage
- ✅ WPForms Integration Ready
- ✅ Modern UI/UX

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Advanced Custom Fields PRO plugin
- WPForms plugin (for contact forms)
- WP Mail SMTP plugin (for email delivery)

## Installation

### 1. Upload Theme

1. Download the `misen-theme` folder
2. Navigate to WordPress admin → Appearance → Themes
3. Click "Add New" → "Upload Theme"
4. Select the theme ZIP file and install
5. Activate the theme

### 2. Install Required Plugins

Install and activate these plugins:

1. **Advanced Custom Fields PRO** - For custom job fields
2. **Classic Editor** (optional) - Simpler editing experience  
3. **WPForms** - Contact forms
4. **WP Mail SMTP** - Email delivery configuration

### 3. Setup Navigation Menus

1. Go to Appearance → Menus
2. Create a new menu called "Primary Menu"
3. Add these pages:
   - Home
   - About
   - Vision
   - Culture
   - Careers
   - Contact
4. Assign to "Primary Menu" location

### 4. Configure Permalink Structure

1. Go to Settings → Permalinks
2. Select "Post name" structure
3. Save changes
4. Visit Appearance → Themes → MISEN → Customize
5. Go back to Settings → Permalinks and save again (to flush rewrite rules)

### 5. Create Job Taxonomies

The theme automatically registers taxonomies. Add terms:

**Departments:**
- Design
- Engineering
- Marketing
- Operations
- Brand

**Locations:**
- Hanoi, Vietnam
- Remote
- US
- etc.

**Job Types:**
- Full-time
- Part-time
- Internship
- Contract

### 6. Create Your First Job

1. Go to Jobs → Add New Job
2. Fill in:
   - Job Title
   - Job Description (main content)
   - Excerpt (short description for listings)
   - Featured Image (optional)
3. Select Department, Location, Job Type
4. Fill in ACF fields:
   - Experience Required
   - Salary Range
   - External Apply URL (optional)
   - Responsibilities (one per line)
   - Requirements (one per line)
   - Benefits (one per line)
   - Featured (check to show on homepage)
5. Publish

## Theme Structure

```
misen-theme/
├── style.css              # Theme info & WordPress core styles
├── functions.php          # Theme setup & functionality
├── index.php             # Fallback template
├── front-page.php        # Homepage (with featured jobs)
├── header.php            # Header template
├── footer.php            # Footer template
├── page.php              # Default page template
├── single.php            # Single blog post
├── single-job.php        # Single job detail page ⭐
├── archive-job.php       # All jobs listing page ⭐
├── 404.php               # Error page
├── /template-parts/
│   └── content-job-card.php  # Job card component
├── /assets/
│   ├── /css/
│   │   └── theme.css     # Custom styles
│   ├── /js/
│   │   └── main.js       # Custom JavaScript
│   └── /images/
├── /inc/
│   ├── custom-post-types.php  # Job CPT & taxonomies
│   └── custom-fields.php      # ACF field configuration
└── README.md
```

## Key Features Explained

### Job Custom Post Type

The theme registers a "Job" custom post type with:
- Archive page at: `/careers`
- Single job URL: `/job/job-title`
- Supports: title, editor, thumbnail, excerpt, revisions

### ACF Custom Fields

Jobs include these custom fields:
- Experience Required
- Salary Range
- External Apply URL
- Responsibilities (textarea)
- Requirements (textarea)
- Benefits (textarea)
- Featured Job (checkbox)
- Posted Date
- Application Deadline
- Remote Work (select)

### Job Filtering & Search

The jobs archive page includes:
- Real-time search
- Filter by department
- Sort by date, title, or department
- Responsive grid layout

### Featured Jobs

To display a job on the homepage:
1. Edit the job post
2. Scroll to "Job Details" section
3. Check "Featured Job"
4. Update post

Maximum 5 featured jobs will show on homepage.

## Customization

### Change Colors

Edit `/assets/css/theme.css` to customize colors and styles.

### Modify Job Card Layout

Edit `/template-parts/content-job-card.php` to change how jobs appear in listings.

### Customize Job Detail Page

Edit `single-job.php` to modify the job detail layout.

### Add Custom Sections

You can add custom sections to jobs using ACF:
1. Go to Custom Fields → Add New
2. Create field group for "Jobs" post type
3. Add your custom fields
4. Access in templates with `get_field('field_name')`

## Contact Forms

### Setup WPForms

1. Install WPForms plugin
2. Create forms:
   - **Job Application Form** - Name, Email, Resume upload, Cover letter
   - **Contact Form** - Name, Email, Message

3. To use in theme:
   - Shortcode: `[wpforms id="123"]`
   - PHP: `<?php echo do_shortcode('[wpforms id="123"]'); ?>`

### Email Notifications

Configure WP Mail SMTP:
1. Go to WP Mail SMTP → Settings
2. Configure your email provider (Gmail, SendGrid, etc.)
3. Test email delivery

## Troubleshooting

### Jobs Page Shows 404

1. Go to Settings → Permalinks
2. Click "Save Changes" (don't change anything)
3. Visit the careers page again

### ACF Fields Not Showing

1. Make sure ACF PRO is installed and activated
2. Fields are automatically registered via code
3. Check `/inc/custom-fields.php`

### Jobs Not Appearing on Homepage

1. Make sure jobs are marked as "Featured"
2. Check that jobs are published (not draft)
3. Verify `front-page.php` is being used

## Support

For theme support:
- Email: <EMAIL>
- Website: https://www.misencorp.com

## Credits

- **Design**: MISEN Design Team
- **Development**: Custom WordPress Theme
- **Fonts**: Satoshi (Fontshare), Catamaran (Google Fonts)
- **Icons**: Heroicons
- **Framework**: Tailwind CSS

## License

This theme is proprietary and licensed for use by MISEN CO.,LTD only.

© 2025 MISEN CO.,LTD. All rights reserved.

---

## Quick Start Checklist

- [ ] Install WordPress
- [ ] Upload and activate MISEN theme
- [ ] Install required plugins (ACF PRO, WPForms, WP Mail SMTP, Classic Editor)
- [ ] Setup navigation menu
- [ ] Configure permalinks
- [ ] Add job taxonomy terms (Departments, Locations, Job Types)
- [ ] Create first job post
- [ ] Test job listing and detail pages
- [ ] Setup contact forms with WPForms
- [ ] Configure email with WP Mail SMTP
- [ ] Customize homepage (optional)

---

**Version**: 1.0.0  
**Last Updated**: December 2024
