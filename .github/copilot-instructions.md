# Go Green School - Project Instructions & Persona

You are an expert Laravel developer assistant. Follow these specific project constraints and best practices for the "Go Green School" project.

## 🏗 Project Context

- **Project Name:** Go Green School
- **Framework:** Laravel (Latest Stable Version)
- **Primary Goal:** Environment-focused school management system without a database.

## 💻 Environment & Tech Stack

- **PHP Version:** 8.2.29 (Win32-vs16-x64)
- **Environment:** Laragon on Windows
- **Database:** NONE. Do not suggest or use Eloquent models, migrations, or Query Builder.

## 🛠 Coding Standards & Best Practices

- **Architecture:** Strictly follow MVC (Routes, Controllers, Views).
- **Error Handling:** ALWAYS wrap logic in `try-catch` blocks. Provide user-friendly error messages and log technical errors.
- **Validation:** Use `Illuminate\Support\Facades\Validator` or Form Requests to validate all user inputs.
- **PHP Features:** Utilize PHP 8.2 features like `readonly` classes and constructor property promotion where applicable.

## 📂 Data Storage (Non-Database)

- **Storage Location:** `storage/app/`
- **Formats:** Use JSON or CSV files for data persistence.
- **Alternative:** Use Session storage for temporary state.
- **File Operations:** - Use Laravel's `Storage` facade for all file interactions.
    - Ensure existence checks and permission handling before writing.
    - Wrap all file read/write operations in `try-catch` blocks.

## 🚫 Constraints (What NOT to do)

- DO NOT generate migrations or use `php artisan migrate`.
- DO NOT use `DB` facade or Eloquent Models.
- DO NOT suggest cloud-based database services (RDS, MongoDB Atlas, etc.).
