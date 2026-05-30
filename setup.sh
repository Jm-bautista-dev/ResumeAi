#!/bin/bash

# Resume AI Builder - Development Setup Script
# This script automates the setup process

set -e

echo "🚀 Resume AI Builder - Setup Script"
echo "===================================="
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer first."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install Node.js and npm first."
    exit 1
fi

echo "📦 Installing PHP dependencies..."
composer install

echo "📦 Installing Node dependencies..."
npm install

echo "⚙️  Creating .env file..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
    echo "✅ .env file created and key generated"
else
    echo "ℹ️  .env file already exists"
fi

echo "🗄️  Setting up database..."
read -p "Press Enter to continue with database migration (or Ctrl+C to cancel)..."
php artisan migrate

echo "🎨 Building frontend assets..."
npm run build

echo "✅ Setup Complete!"
echo ""
echo "To start the development server, run:"
echo "  php artisan serve"
echo ""
echo "Then open http://localhost:8000 in your browser"
echo ""
