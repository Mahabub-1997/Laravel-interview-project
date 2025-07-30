### 🔸 Structure Overview

1. **Courses**
   - Represents a full course (e.g., Web Development, Python for Beginners).
   - Contains multiple modules.

2. **Modules**
   - Subsections of a course (e.g., HTML Basics, Laravel Eloquent).
   - Each course can have unlimited modules.

3. **Content**
   - Nested under a module.
   - Represents videos, notes, lessons, or quizzes (e.g., "What is HTML?", "Blade Templating").

---

### 🛠️ Features

- ✅ Full CRUD for Courses, Modules, and Content
- ✅ Nested data handling using dynamic form fields
- ✅ Laravel Repository & Request Validation Pattern
- ✅ Step-by-step content management
- ✅ User-friendly interface (Blade + Bootstrap)
- ✅ Export options (PDF, Excel, Print – optional)
- ✅ Bangla and English language support for labels

---

### 🧱 Database Relationships

- **Course** `hasMany` → **Module**
- **Module** `belongsTo` → **Course**
- **Module** `hasMany` → **Content**
- **Content** `belongsTo` → **Module**

---

### 📦 Folder Structure

app/
├── Http/
│ ├── Controllers/
│ │ ├── CourseController.php
│ │ ├── ModuleController.php
│ │ └── ContentController.php
│ ├── Requests/
│ │ ├── CourseRequest.php
│ │ ├── ModuleRequest.php
│ │ └── ContentRequest.php
│
├── Models/
│ ├── Course.php
│ ├── Module.php
│ └── Content.php
│
├── Repositories/
│ ├── CourseRepository.php
│ ├── ModuleRepository.php
│ └── ContentRepository.php

yaml
Copy
Edit

---

### 🚀 Getting Started

1. Clone the repository
2. Run `composer install` and `npm install`
3. Setup your `.env` and database
4. Run migrations: `php artisan migrate`
5. Start server: `php artisan serve`
