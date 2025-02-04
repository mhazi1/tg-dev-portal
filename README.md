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

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing
This is a portfolio project demonstrating Laravel development skills. However, suggestions and improvements are welcome. Please feel free to fork the repository and submit pull requests.

## Acknowledgments
- Laravel Documentation
- Spatie Permission Package
- Tailwind CSS
- SweetAlert2
