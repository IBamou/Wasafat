# Wasafat 🍽️

A recipe management application built with PHP MVC structure.

## Features

- 🔐 User authentication (signup/login/logout)
- 📝 Recipe management (create, read, update, delete)
- 📂 Category management
- 📊 Dashboard with statistics
- 📱 Responsive design

## Requirements

- PHP 8.0+
- MySQL 5.7+
- XAMPP or similar
- Composer (for PHP dependencies)

## Installation

### 1. Clone the repository
```bash
git clone https://github.com/IBamou/Wasafat.git
cd Wasafat
```

### 2. Install dependencies
```bash
composer install
```

### 3. Setup database
1. Start Apache and MySQL in XAMPP
2. Open `phpMyAdmin` (http://localhost/phpmyadmin)
3. Create a database called `wasafat_db`
4. Import the SQL file:
   - Go to `app/Configs/wasafaDB.sql`
   - Or run the queries from `query.sql`

### 4. Configure database
Edit `app/Configs/Database.php` if needed:
```php
private $host = 'localhost';
private $dbname = 'wasafat_db';
private $dbuser = 'root';      // Your MySQL username
private $password = '';        // Your MySQL password
```

### 5. Run the app
Open `http://localhost/Wasafat/` in your browser

---

## Default Credentials

After installation, you can sign up for a new account or use existing credentials.

## Project Structure

```
Wasafat/
├── app/
│   ├── Configs/        # Database configuration
│   ├── Controllers/     # MVC Controllers
│   ├── Helpers/        # Helper functions
│   ├── Middleware/     # Auth middleware
│   ├── Models/         # Database models
│   ├── Services/       # Business logic
│   └── Views/          # UI templates
├── public/
│   ├── css/            # Stylesheets
│   └── js/             # JavaScript files
├── router/              # Main router
├── query.sql           # Database schema
└── README.md          # This file
```

## Usage

### Routes

| URL | Description |
|-----|-------------|
| `/` | Home page |
| `/login` | User login |
| `/signup` | User registration |
| `/dashboard` | User dashboard |
| `/recipes` | List recipes |
| `/recipes/create` | Create new recipe |
| `/recipes/{id}` | View recipe |
| `/recipes/edit/{id}` | Edit recipe |
| `/categories` | List categories |
| `/categories/create` | Create category |
| `/profile` | User profile |

## Tech Stack

- **Backend**: PHP 8, MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Design**: Custom CSS with Noto Serif + Plus Jakarta Sans fonts

## License

MIT
