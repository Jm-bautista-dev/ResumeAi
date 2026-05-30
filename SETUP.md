# Installation & Setup Instructions

## Prerequisites
- PHP 8.1 or higher
- Composer (latest version)
- Node.js 16+ and npm
- MySQL 8.0+ or PostgreSQL 12+
- Git

## Quick Start

### 1. Install PHP Dependencies
```bash
composer install
```

### 2. Install Node Dependencies
```bash
npm install
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Create a new database:
```bash
# MySQL
mysql -u root -p
CREATE DATABASE resume_ai_builder;
EXIT;
```

Then run migrations:
```bash
php artisan migrate
```

### 5. Build Frontend Assets
```bash
npm run build
```

### 6. Start Development Server
```bash
php artisan serve
```

Your application will be available at `http://localhost:8000`

## Configuration

### Update .env file with your database
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=resume_ai_builder
DB_USERNAME=root
DB_PASSWORD=
```

### Optional: Enable AI Features
```env
ENABLE_AI_FEATURES=true
OPENAI_API_KEY=your_key_here
```

### Optional: Configure Email
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

## Development Workflow

### Watch for Asset Changes
```bash
npm run dev
```

### Run Tests
```bash
php artisan test
```

### Create Database Backup
```bash
php artisan db:dump
```

### Clear Caches
```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Project Structure Overview

```
resume-ai-builder/
├── app/                    # Application code
│   ├── Http/              # Controllers, Requests, Middleware
│   ├── Models/            # Eloquent models
│   ├── Services/          # Business logic
│   └── Policies/          # Authorization policies
├── database/              # Migrations and seeders
├── resources/             # Views, CSS, JavaScript
│   ├── views/            # Blade templates
│   ├── css/              # Tailwind CSS
│   └── js/               # Alpine.js and app scripts
├── routes/                # Web and API routes
├── storage/               # Uploaded files, exports
├── public/                # Web root
├── config/                # Configuration files
└── tests/                 # Test files
```

## Next Steps

1. **Create a User Account**
   - Visit `http://localhost:8000/register`
   - Fill in your details
   - Verify your email (if configured)

2. **Create Your First Resume**
   - Go to Dashboard
   - Click "Create Resume"
   - Fill in your information
   - Save and preview

3. **Create a Portfolio**
   - Go to Dashboard
   - Click "Create Portfolio"
   - Select your resume
   - Choose a template
   - Customize and publish

4. **Explore AI Features**
   - Click the AI button in the resume editor
   - Try "Improve Description"
   - Try "Generate Summary"
   - Try "Optimize for ATS"

## Troubleshooting

### Migrations Failed
```bash
php artisan migrate:rollback
php artisan migrate
```

### Assets Not Compiling
```bash
npm cache clean --force
rm -rf node_modules
npm install
npm run build
```

### Database Connection Error
- Check `.env` file database credentials
- Ensure database exists
- Verify MySQL/PostgreSQL service is running

### Permission Denied on Files
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

## Production Deployment

1. Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan migrate --force`
4. Set up proper file permissions
5. Configure web server (Nginx/Apache)
6. Set up SSL certificate
7. Configure database backups
8. Set up error monitoring (Sentry, etc.)
9. Enable query caching
10. Set up CDN for assets

## Support & Resources

- 📖 [Laravel Documentation](https://laravel.com/docs)
- 🎨 [Tailwind CSS Docs](https://tailwindcss.com)
- 🔧 [Alpine.js Docs](https://alpinejs.dev)
- 💬 [GitHub Issues](https://github.com/yourrepo/issues)
