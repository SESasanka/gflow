# Gflow Computers

A PHP + MySQL web application for managing an online computer store with customer and admin workflows.

## Features

- User authentication (sign up, sign in, password reset)
- Product browsing and single product view
- Cart and checkout flow
- Watchlist support
- User profile management
- Admin dashboard and reports (users, products, suppliers, invoices)

## Tech Stack

- PHP (procedural pages + process handlers)
- MySQL
- Bootstrap
- JavaScript
- XAMPP (recommended local environment)

## Project Structure

- `index.php` - entry page (sign in / sign up)
- `home.php` - main storefront
- `admin*.php` pages - admin interfaces
- `*Process.php` files - backend action handlers
- `connection.php` - database connection utility
- `img/` and `images/` - static assets

## Local Setup (XAMPP)

1. Place the project in your XAMPP htdocs directory:
   - `c:/xampp/htdocs/gflow/gflow`
2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Create a MySQL database named `gflow`.
4. Import your SQL schema/data into `gflow` (use phpMyAdmin).
5. Update database credentials in `connection.php` if needed.
6. Open in browser:
   - `http://localhost/gflow/gflow/`

## Database Configuration

Current connection is configured in `connection.php` using:

- Host: `localhost`
- Port: `3306`
- Database: `gflow`

If your local credentials differ, edit this line in `connection.php`:

```php
Database::$connection = new mysqli("localhost", "root", "YOUR_PASSWORD", "gflow", "3306");
```

## Notes

- The app currently uses hard-coded DB credentials in `connection.php`.
- For production usage, move secrets to environment variables and secure the deployment.
- Ensure write permissions for any runtime upload directories you use.

## License

This project currently has no license file defined.
