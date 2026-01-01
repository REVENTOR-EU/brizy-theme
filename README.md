# Brizy Theme

[![WordPress](https://img.shields.io/badge/WordPress-5.0+-blue.svg)](https://wordpress.org/)
[![Brizy](https://img.shields.io/badge/Brizy-1.0+-green.svg)](https://brizy.io/)
[![License](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

**IMPORTANT: This theme is made by REVENTOR - A Minimal WordPress Theme for Maximum Compatibility with Brizy Builder. It is NOT built by the official Brizy Team.**

A minimal WordPress theme designed specifically for maximum compatibility with Brizy page builder. This theme provides only essential WordPress functionality while letting Brizy handle all design and layout decisions.

## 🎯 Purpose

This theme serves as the ultimate starter theme for any Brizy-based website, offering:

- **Maximum Compatibility**: Zero conflicts with Brizy's design system
- **No Bloat**: Only essential WordPress functionality, no unnecessary extras
- **Clean Foundation**: Minimal CSS that doesn't interfere with Brizy elements
- **Full Flexibility**: Complete creative freedom within Brizy
- **REVENTOR Built**: Created by REVENTOR for the Brizy community, not affiliated with the official Brizy team

## ✨ Key Features

### Brizy-First Design
- **Global Colors Support**: Seamlessly integrates with Brizy's color system
- **Full Width Containers**: Remove theme constraints for Brizy's full-width sections
- **CSS Reset**: Clean foundation that doesn't interfere with Brizy styling
- **Header/Footer Compatibility**: Works perfectly with Brizy's header and footer builder

### Developer-Friendly
- **Minimal Dependencies**: Only essential WordPress features
- **Clean Code**: Well-organized, commented codebase
- **Performance Optimized**: No unnecessary scripts or styles
- **Responsive Ready**: Basic responsive framework for Brizy to build upon

### WordPress Essentials
- **Post Thumbnails**: Full support for featured images
- **Custom Logo**: Logo management through WordPress Customizer
- **Navigation Menus**: Primary and footer menu locations
- **HTML5 Support**: Modern HTML5 markup
- **Accessibility**: Screen reader friendly elements

## 🚀 Installation

### Prerequisites
- WordPress 5.0 or higher
- Brizy Page Builder plugin installed and activated

### Installation Steps

1. **Download the Theme**
   ```bash
   # Clone the repository
   git clone https://github.com/reventor/brizy-theme.git

   # Or download as ZIP and extract to wp-content/themes/
   ```

2. **Upload to WordPress**
   - Navigate to `wp-content/themes/` in your WordPress installation
   - Upload the `brizy-theme` folder

3. **Activate the Theme**
   - Go to WordPress Admin → Appearance → Themes
   - Find "Brizy Theme" and click "Activate"

4. **Install Brizy Plugin**
   - Go to WordPress Admin → Plugins → Add New
   - Search for "Brizy"
   - Click "Install Now" and then "Activate"

5. **Start Creating**
   - Create a new page or post
   - Select "Brizy Template" from the page template dropdown
   - Click "Edit with Brizy" to start designing

## 📁 Theme Structure

```
brizy-theme/
├── style.css              # Minimal CSS for Brizy compatibility
├── functions.php          # Theme setup and Brizy features
├── index.php             # Main template file
├── page.php              # Page template
├── single.php            # Single post template
├── header.php            # Header template
├── footer.php            # Footer template
├── 404.php               # 404 error page
├── js/
│   └── navigation.js     # Basic navigation functionality
└── screenshot.jpg        # Theme preview image
```

## 🔧 Brizy Compatibility Features

### 1. Global Colors Integration
The theme ensures Brizy's global color system works without interference from theme colors.

### 2. Full Width Support
Remove theme container constraints to allow Brizy's full-width sections to span the entire viewport.

### 3. CSS Reset for Brizy Elements
Clean CSS foundation that prevents theme styles from conflicting with Brizy elements.

### 4. Header/Footer Builder Support
Seamless integration with Brizy's header and footer builder functionality.

### 5. Responsive Foundation
Basic responsive framework that Brizy can build upon for mobile-friendly designs.

## 🎨 Usage

### Creating Pages with Brizy
1. Create a new page in WordPress
2. Click "Edit with Brizy"
3. Design your page using Brizy's visual editor
4. Publish and enjoy your custom design

### Customizing the Theme
While the theme is designed to be minimal, you can extend it by:

- Adding custom CSS in `style.css` (use with caution to avoid conflicts)
- Extending functionality in `functions.php`
- Creating child themes for more extensive modifications

## ⚠️ Important Notes

### What This Theme Does NOT Include
- Pre-designed templates or layouts
- Theme-specific styling that could conflict with Brizy
- Heavy JavaScript libraries or frameworks
- Complex theme options or customizers
- Page builders other than Brizy
- Automatic plugin installation (to comply with WordPress.org guidelines)

### Manual Plugin Installation
This theme does NOT automatically install the Brizy plugin. This is intentional to follow WordPress.org theme guidelines. You must manually install and activate the Brizy plugin from the WordPress Plugin Directory. See the Installation section above for detailed steps.

### Best Practices
- Always use Brizy for page design and layout
- Avoid adding theme-specific CSS that might conflict with Brizy
- Use Brizy's global styles for consistent design
- Leverage Brizy's component system for reusable elements

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📋 Changelog

### Version 1.0.0
- Initial release
- Basic WordPress theme structure
- Brizy compatibility features
- Minimal CSS foundation
- Essential WordPress functionality

## 📄 License

This theme is licensed under the [GNU General Public License v2.0](LICENSE) or later.

## 🆘 Support

For support and questions:

- **Brizy Documentation**: [https://docs.brizy.io/](https://docs.brizy.io/)
- **WordPress Support**: [https://wordpress.org/support/](https://wordpress.org/support/)
- **Issue Reports**: [GitHub Issues](https://github.com/reventor/brizy-theme/issues)

## 🙏 Acknowledgments

- [Brizy Page Builder](https://brizy.io/) - For creating an amazing page builder
- [WordPress Community](https://wordpress.org/) - For the incredible CMS platform

---

**Built with ❤️ by REVENTOR for Brizy users everywhere**
