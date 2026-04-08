# Wasafat 🍽️

A recipe management application built with PHP MVC structure.

## Features

- User authentication (signup/login/logout)
- Recipe management (create, read, update, delete)
- Category management
- Dashboard with statistics
- Responsive design

## Requirements

- PHP 8.0+
- MySQL 5.7+
- XAMPP or similar

## Installation

1. Clone the repository
2. Start Apache and MySQL in XAMPP
3. Import the database:
   - Go to `phpMyAdmin`
   - Create a database called `wasafat_db`
   - Import `app/Configs/wasafaDB.sql`

4. Configure database:
   - Edit `app/Configs/Database.php`
   - Update credentials if needed

5. Access the app:
   - Open `http://localhost/Wasafat/` in your browser

## Project Structure

```
Wasafat/
├── app/
│   ├── Configs/       # Database configuration
│   ├── Controllers/  # MVC Controllers
│   ├── Helpers/    # Helper functions
│   ├── Middleware/ # Auth middleware
│   ├── Models/    # Database models
│   ├── Services/   # Business logic
│   └── Views/     # UI templates
├── public/
│   ├── css/       # Stylesheets
│   └── js/        # JavaScript files
├── router/         # Main router
└── query.sql     # Database schema
```

## Tech Stack

- **Backend**: PHP 8, MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Design**: Custom CSS with Noto Serif + Plus Jakarta Sans fonts

## License

MIT