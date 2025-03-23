# Free Portfolio Website | PHP + MYSQL

A dynamic portfolio creation platform that allows users to create, manage and showcase their professional portfolios, with built-in device compatibility checks for optimal viewing experience.

## Live Demo
🚀 [View Live Demo](http://free-portfolio-php.great-site.net/)

## Features

- 👤 User Portfolio Creation & Management
- 🎨 Customizable Portfolio Templates
- 📱 Device Compatibility Checks
- 🔒 Secure User Authentication
- 📊 Dashboard Analytics
- 💾 Project & Skills Management
- 🎯 SEO Optimization Tools

## Tech Stack

- Frontend:
  - HTML5
  - CSS3
  - JavaScript (ES6+)
  - Bootstrap 5.1.3
  - Font Awesome 5.15.4
  
- Backend:
  - PHP 7.4+
  - MySQL 5.7+
  - Apache/Nginx

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/portfolio-manager.git
```

2. Set up your local environment:
   - For XAMPP users: Place in `htdocs/`
   - For WAMP users: Place in `www/`

3. Database setup:
   - For demo content:
     ```sql
     mysql -u your_username -p your_database_name < portfolio_website_php_mysql.sql
     ```
   - For fresh installation:
     ```sql
     mysql -u your_username -p your_database_name < portfolio_website_php_mysql_empty.sql
     ```

4. Configure database connection:
```php
// filepath: config/database.php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'your_database_name');
```

## Project Structure

```
htdocs/
├── index.php              # Entry point with device compatibility check
├── dashboard/            # User dashboard
│   ├── projects/        # Project management
│   ├── skills/          # Skills management
│   └── analytics/       # Portfolio analytics
├── templates/           # Portfolio templates
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
└── config/
    └── database.php     # Database configuration
```

## Usage

1. Create an account or login
2. Access the dashboard to:
   - Create/edit your portfolio
   - Add projects and skills
   - Choose templates
   - Monitor analytics
3. Share your portfolio URL

## Device Compatibility Warning ⚠️

This application is optimized for desktop viewing with a minimum screen width of 1080px. Users attempting to access the platform on smaller devices will receive a warning message and may experience limited functionality. For the best experience, please use a desktop computer or device with a screen width of at least 1080px.

## Security Features

- Password hashing
- SQL injection prevention
- XSS protection
- CSRF tokens
- Input validation

## License

This project is released under the MIT License. Feel free to use, modify, and distribute as you wish. See the LICENSE file for details.

## Support & Contact

If you encounter any issues or need assistance:

- Email: toscanisoft@gmail.com
- Visit: [Contact Page](https://toscani-tenekeu.onrender.com/contact)
- Submit an issue in the repository

For urgent matters, please include "PORTFOLIO SYSTEM SUPPORT" in your email subject line for faster response.

Common issues and their solutions can be found in our documentation. For technical problems, please include:
- Your device specifications
- Browser type and version
- Error messages (if any)
- Steps to reproduce the issue

## Support

For support:
- Open an issue in the repository
- Contact: support@yourportfolio.com
- Visit our documentation: docs.yourportfolio.com

## Acknowledgments

- Bootstrap team
- Font Awesome
- Contributing developers
- Open source community

## Contributing

We welcome contributions! Please see our contributing guidelines for more details.

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request