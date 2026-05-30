@echo off
REM Resume AI Builder - Development Setup Script for Windows
REM This script automates the setup process

echo.
echo 🚀 Resume AI Builder - Setup Script
echo ====================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ❌ Composer is not installed. Please install Composer first.
    exit /b 1
)

REM Check if npm is installed
where npm >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo ❌ npm is not installed. Please install Node.js and npm first.
    exit /b 1
)

echo 📦 Installing PHP dependencies...
call composer install

echo 📦 Installing Node dependencies...
call npm install

echo ⚙️  Creating .env file...
if not exist .env (
    copy .env.example .env
    call php artisan key:generate
    echo ✅ .env file created and key generated
) else (
    echo ℹ️  .env file already exists
)

echo 🗄️  Setting up database...
pause
call php artisan migrate

echo 🎨 Building frontend assets...
call npm run build

echo ✅ Setup Complete!
echo.
echo To start the development server, run:
echo   php artisan serve
echo.
echo Then open http://localhost:8000 in your browser
echo.
pause
