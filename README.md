# Resume AI Builder - Premium SaaS Platform

A modern, production-ready AI-powered Resume and Portfolio Builder built with Laravel, Blade templates, Tailwind CSS, and Alpine.js. Create stunning resumes and portfolio websites with AI assistance.

## 🚀 Features

### Resume Builder
- 📝 Drag-and-drop resume editor with live preview
- 📋 Multiple professional templates
- 🤖 AI-powered content enhancement
- 📊 ATS (Applicant Tracking System) optimization
- 📥 PDF export with consistent design
- 🔄 Duplicate resumes for quick variations
- 💾 Auto-save functionality

### Portfolio Generator
- 🎨 Multiple portfolio templates (Cyberpunk, Minimal, Developer Terminal, Corporate, Anime Neon)
- 🎯 Auto-generated from resume data
- 🌈 Customizable themes and colors
- 📱 Fully responsive design
- 📦 Export as static build (ZIP)
- 🚀 GitHub Pages deployment ready

### AI Features
- ✨ Improve job descriptions professionally
- 💬 Generate professional summaries
- 🎯 Suggest relevant skills
- ⚡ ATS optimization recommendations
- 🔤 Rewrite content professionally

### SaaS Features
- 👤 User authentication (Sanctum-based)
- 📊 Analytics dashboard
- 🔐 Role-based access control
- 🎨 Dark/Light mode support
- 📧 Email verification
- 🔑 API token management

## 🛠️ Tech Stack

### Backend
- **PHP 8.1+** - Programming language
- **Laravel 11** - Web framework
- **MySQL/PostgreSQL** - Database
- **Laravel Sanctum** - Authentication
- **Spatie Permission** - Role management
- **DomPDF** - PDF generation

### Frontend
- **Blade Templates** - Server-side templating
- **Tailwind CSS 3** - Utility-first CSS
- **Alpine.js 3** - Lightweight interactivity
- **Vite** - Build tool
- **AOS** - Scroll animations

### Optional Services
- **OpenAI API** - AI features
- **Groq API** - Alternative AI
- **GitHub API** - Portfolio deployment

## 📋 Database Schema

### Core Tables
- `users` - User accounts and authentication
- `resumes` - User resumes
- `resume_sections` - Resume content sections
- `portfolios` - Generated portfolio websites
- `portfolio_templates` - Portfolio design templates
- `themes` - Customizable color schemes
- `ai_requests` - AI API usage tracking
- `exports` - Resume/Portfolio exports

## 🔧 Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 16+
- MySQL 8+ or PostgreSQL 12+

### Setup

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/resume-ai-builder.git
cd resume-ai-builder
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Setup database**
```bash
# Create database first
php artisan migrate
php artisan db:seed
```

5. **Build frontend assets**
```bash
npm run build
# or for development with watch
npm run dev
```

6. **Start the development server**
```bash
php artisan serve
```

Application will be available at `http://localhost:8000`

## 📚 Project Structure

```
resume-ai-builder/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ResumeController.php
│   │       ├── PortfolioController.php
│   │       ├── AiController.php
│   │       ├── ExportController.php
│   │       └── DashboardController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Resume.php
│   │   ├── Portfolio.php
│   │   ├── Theme.php
│   │   ├── AiRequest.php
│   │   └── Export.php
│   └── Services/
│       ├── ResumeService.php
│       ├── PortfolioService.php
│       ├── AiService.php
│       └── PdfExportService.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── components/
│   │   ├── resume/
│   │   ├── portfolio/
│   │   ├── dashboard/
│   │   └── auth/
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── web.php
├── config/
└── storage/
    └── app/
        └── exports/
```

## 🔑 Environment Variables

```env
APP_NAME="Resume AI Builder"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=resume_ai_builder
DB_USERNAME=root
DB_PASSWORD=

# AI Services
OPENAI_API_KEY=your_key_here
GROQ_API_KEY=your_key_here
ENABLE_AI_FEATURES=false

# GitHub Integration
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=

# Mailing
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@example.com
```

## 🎯 Key Routes

### Public Routes
- `GET /` - Landing page
- `GET /pricing` - Pricing page
- `GET /features` - Features page

### Authenticated Routes
- `GET /dashboard` - Main dashboard
- `GET /resume` - List resumes
- `POST /resume` - Create resume
- `GET /resume/{id}/edit` - Edit resume
- `GET /resume/{id}/preview` - Preview resume
- `GET /resume/{id}/export-pdf` - Export as PDF
- `GET /portfolio` - List portfolios
- `POST /portfolio` - Create portfolio
- `GET /portfolio/{id}/preview` - Preview portfolio
- `GET /portfolio/{id}/export-zip` - Export portfolio

### API Routes (Authenticated)
- `POST /api/ai/improve-description` - Improve text
- `POST /api/ai/generate-summary` - Generate summary
- `POST /api/ai/optimize-ats` - Optimize for ATS

## 🔐 Security Features

- ✅ CSRF protection on all forms
- ✅ SQL injection prevention via Eloquent ORM
- ✅ XSS protection with Blade escaping
- ✅ Password hashing with bcrypt
- ✅ Rate limiting on API endpoints
- ✅ API token authentication
- ✅ Authorization policies
- ✅ Secure file storage

## 📱 Responsive Design

- ✅ Mobile-first approach
- ✅ Tablet optimization
- ✅ Desktop display
- ✅ Touch-friendly interface
- ✅ Dark/Light mode support

## 🎨 UI/UX Design

- 🎨 Glassmorphism effects
- ✨ Smooth animations and transitions
- 🌈 Modern color palette
- 📊 Intuitive dashboard layout
- 🎭 Professional typography
- 💫 Loading skeletons
- 🔔 Toast notifications
- 🎯 Modal dialogs

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_DEBUG=false`
- [ ] Generate strong `APP_KEY`
- [ ] Configure database for production
- [ ] Set up SSL/HTTPS
- [ ] Configure email service
- [ ] Set up file storage (S3 or similar)
- [ ] Run database migrations
- [ ] Cache configuration
- [ ] Set up backups
- [ ] Configure monitoring

### Deployment Options
- Heroku
- DigitalOcean
- AWS
- Vercel (for static export)
- Custom VPS

## 📈 Performance Optimization

- ✅ Database query optimization
- ✅ Lazy loading for portfolios
- ✅ Asset caching strategy
- ✅ CDN-friendly asset structure
- ✅ Database indexing
- ✅ Query pagination

## 🔄 Future Enhancements

- [ ] Livewire real-time updates
- [ ] WebSocket collaboration
- [ ] Multi-language support
- [ ] SEO optimization for portfolios
- [ ] Custom domain support
- [ ] Email templates
- [ ] Payment integration
- [ ] Analytics dashboard
- [ ] Team collaboration features
- [ ] Mobile app integration

## 📄 License

MIT License - feel free to use this project for commercial purposes.

## 🤝 Contributing

Contributions are welcome! Please follow these steps:
1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For issues and questions:
- GitHub Issues: Create an issue
- Email: support@resumeaibuilder.com
- Discord: [Join our community]

## 🙏 Acknowledgments

Built with modern web technologies and best practices. Inspired by leading SaaS platforms like Vercel, Notion, and Linear.

---

**Happy Building! 🚀**
#   R e s u m e A i  
 