# Resume AI Builder - Development Guide

## Overview
This is a premium SaaS application for building resumes and generating portfolio websites using AI.

## Architecture
- **Backend**: Laravel 11 with clean MVC architecture
- **Frontend**: Blade templates with Tailwind CSS and Alpine.js
- **Authentication**: Laravel Sanctum
- **Database**: MySQL/PostgreSQL with proper relationships

## Key Directories
- `app/Http/Controllers/` - Request handlers
- `app/Models/` - Database models with relationships
- `app/Services/` - Business logic (ResumeService, PortfolioService, AiService)
- `resources/views/` - Blade templates organized by feature
- `database/migrations/` - Schema definitions
- `routes/web.php` - Application routes

## Development Workflow

### Creating a New Feature
1. Create the migration in `database/migrations/`
2. Create the model in `app/Models/`
3. Create the controller in `app/Http/Controllers/`
4. Create service class if needed in `app/Services/`
5. Create views in `resources/views/` organized by feature
6. Add routes in `routes/web.php`
7. Create policy if needed in `app/Policies/`

### Database Queries
- Always use Eloquent ORM, not raw queries
- Use eager loading to prevent N+1 queries
- Index frequently queried columns
- Use relationships for joins

### Views and Components
- Use Blade components in `resources/views/components/`
- Keep templates DRY and reusable
- Use Tailwind utility classes, avoid inline CSS
- Use Alpine.js for lightweight interactivity

### Authentication & Authorization
- Use `auth()` helper for current user
- Use policies for authorization checks
- Use `authorize()` in controllers
- Protect API routes with `auth:sanctum` middleware

## Key Models and Relationships

```
User
├── hasMany(Resume)
├── hasMany(Portfolio)
├── hasMany(Theme)
├── hasMany(AiRequest)
└── hasMany(Export)

Resume
├── belongsTo(User)
├── hasMany(ResumeSection)
├── hasMany(Portfolio)
└── hasMany(AiRequest)

Portfolio
├── belongsTo(User)
├── belongsTo(Resume)
├── belongsTo(PortfolioTemplate)
├── belongsTo(Theme)
└── hasMany(Export)

AiRequest
├── belongsTo(User)
└── belongsTo(Resume)
```

## Environment Variables
All sensitive data should be in `.env` file:
- Database credentials
- API keys (OpenAI, Groq, GitHub)
- Mail configuration
- Feature flags

## Testing
- Unit tests in `tests/Unit/`
- Feature tests in `tests/Feature/`
- Run tests: `php artisan test`

## Code Standards
- Follow PSR-12 coding standard
- Use type hints for all methods
- Write clean, readable code
- Comment complex logic
- Use snake_case for variables and database columns
- Use camelCase for methods and JavaScript

## Performance Tips
- Use database pagination
- Implement caching for static data
- Optimize images and assets
- Use lazy loading where appropriate
- Monitor N+1 queries

## Security Checklist
- ✅ CSRF protection enabled
- ✅ SQL injection prevention with Eloquent
- ✅ XSS protection with Blade escaping
- ✅ Password hashing with bcrypt
- ✅ Input validation on all forms
- ✅ Authorization checks on sensitive operations

## Useful Commands
```bash
# Run development server
php artisan serve

# Run migrations
php artisan migrate

# Create new model with migration
php artisan make:model ModelName -m

# Create new controller
php artisan make:controller ControllerName

# Create new service
php artisan make:class Services/ServiceName

# Watch for asset changes
npm run dev

# Build assets for production
npm run build

# Run tests
php artisan test

# Cache configuration
php artisan config:cache

# Clear all caches
php artisan cache:clear
```

## Deployment Considerations
- Use environment-specific configurations
- Set `APP_DEBUG=false` in production
- Use strong, unique `APP_KEY`
- Configure proper database backups
- Set up SSL/HTTPS
- Use CDN for static assets
- Monitor error logs and performance
- Set up proper file permissions

## Contributing Guidelines
1. Follow the code standards above
2. Test all changes thoroughly
3. Update documentation
4. Commit messages should be clear and descriptive
5. Submit PRs for review before merging

## Resources
- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev)
- [Blade Template Documentation](https://laravel.com/docs/blade)
