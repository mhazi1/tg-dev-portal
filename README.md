# Laravel User Management System

## Project Background

A comprehensive Laravel-based web portal designed to streamline certificate and client management for development teams. This project is a recreation of a task from my internship, rebuilt from written notes after the original codebase was lost. It serves as a demonstration of my Laravel development skills.

## Project Overview

The project is a web portal designed for the development team of the company. Its primary purpose is to streamline the process of handling certificates and clients that the team manages.

## Key Features

### User Roles and Permissions

The web portal implements a Role-Based Access Control (RBAC) system:

| Role | Permissions |
|------|-------------|
| **Support** | - Add certificates and clients |
| **Developer** | - All Support role actions<br>- Verify certificates and clients |
| **Admin** | - All Developer role actions<br>- Add new users to the web portal |

### Unique Registration Process

This web portal uses a manual user registration process managed by the Admin:
- Admin registers the user manually by entering their name, email, and assigning the role
- The system sends an email verification link to the user's email, which includes a link that verifies their email and allow user to set their password
- The user **must verify their email and set a password** before they can log in.

## Technologies Used

- Laravel 11
- PHP 8.1
- MySQL
- Tailwind CSS
- Spatie/Permission Package
- Laravel Mail
- JavaScript

## Installation

### Prerequisites

- PHP 8.1+
- Composer
- MySQL/PostgreSQL/SQLite
- Node.js & NPM

### Installation Steps

1. Clone the repository
```bash
git clone https://github.com/mhazi1/tg-dev-portal.git
cd tg-dev-portal
```

2. Install PHP 
- [Guide on installing PHP for Windows 10/11](https://www.youtube.com/watch?v=n04w2SzGr_U)

3. Install Composer and NPM dependencies
```bash
composer install
npm install
```

4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

5. Database Configuration

Choose one of the following database configurations:

#### MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### PostgreSQL
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### SQLite
```bash
# Create SQLite database file
touch database/database.sqlite
```
Then in .env:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

6. Mail Configuration

This project uses email notifications for user registration. Configure your SMTP settings in `.env`:

#### Mailtrap (Example)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

7. Database Migration and Seeding
```bash
php artisan migrate --seed
```

8. Start the Development Server
```bash
php artisan serve
```

9. Compile Assets
```bash
npm run dev
```


🔑 Default Test Accounts

| Role | Credentials |
|------|-------------|
| Admin | admin@tg-devportal.com / adminpassword |
| Support | support@tg-devportal.com / supportpassword |
| Developer | developer@tg-devportal.com / developerpassword |


## Troubleshooting

### Common Issues

1. Mail Configuration
   - Verify SMTP credentials in `.env`
   - Check Mailtrap inbox for development
   - Ensure proper mail service configuration

2. Database Connection
   - Verify database service is running
   - Check database credentials
   - Ensure proper database permissions

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing
This is a portfolio project demonstrating Laravel development skills. However, suggestions and improvements are welcome. Please feel free to fork the repository and submit pull requests.

## Acknowledgments
- Laravel Documentation
- Spatie Permission Package
- Tailwind CSS
- SweetAlert2
