# Reading List

Reading List is a small Laravel app for tracking books you want to read, are currently reading, or have finished.  
You can add, edit, delete, and filter books by their reading status.

## Features

- Add a book with a title, author, and status
- Edit existing books
- Delete books after confirming the action
- Filter the list by To read, Reading, or Finished
- Validation for required fields and allowed statuses

## Requirements

- PHP
- Composer
- Node.js and npm
- SQLite

Laravel Herd includes PHP, Composer, and other Laravel tools on Windows.

## How to run the app

### 1. Clone the repository

```powershell
git clone https://github.com/yashnagose13/reading-list.git
cd reading-list
```

### 2. Install PHP and frontend dependencies

```powershell
composer install
npm install
npm run build
```

### 3. Set up the environment file

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

### 4. Create the SQLite database and run migrations

```powershell
New-Item -ItemType File -Path database\database.sqlite -Force
php artisan migrate
```

### 5. Start the application

```powershell
php artisan serve
```

Open this URL in your browser:

```text
http://127.0.0.1:8000/books
```

If you use Laravel Herd and place the project inside your Herd folder, you can instead open:

```text
http://reading-list.test/books
```

## AI usage

OpenAI ChatGPT (Codex) was used as a learning assistant. It explained Laravel resource routes, helped draft the migration, model, controller methods, Blade forms, validation, filtering, and Git/GitHub commands. I reviewed the code, entered it into the project, and tested each feature locally.