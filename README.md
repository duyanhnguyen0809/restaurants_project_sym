# Restaurants Project

Welcome to the **Restaurants Project**! This is a Symfony-based application for managing restaurants, menus, tables, and reservations. The project includes role-based authentication with three predefined accounts for testing purposes.

---

## Features

- Manage Restaurants, Menus, Tables, and Reservations.
- Role-based access control:
  - **Admin**: Full access to the application, including admin-specific features.
  - **User**: Access to user-specific pages (e.g., profile, reservations).
  - **Banned**: Restricted access with a message displayed.

---

## Testing the Application

You can log in using the following test accounts:

| Role   | Email                  | Password    | Access Description               |
|--------|------------------------|-------------|-----------------------------------|
| Admin  | `admin@example.com`    | `admin123`  | Full access to admin features.   |
| User   | `user@example.com`     | `user123`   | Access to user-specific pages.   |
| Banned | `banned@example.com`   | `banned123` | Restricted access (banned user). |

---

## Setup Instructions

### 1. Clone the Repository
Clone the repository and navigate to the project directory:
```bash
git clone https://github.com/duyanhnguyen0809/restaurants_project_sym.git
cd restaurants_project_sym
```

### 2. Install Dependencies
Install PHP dependencies using Composer:
```bash
composer install
```

Install JavaScript and CSS dependencies using npm:
```bash
npm install
```

Compile frontend assets:
```bash
npm run dev
```

### 3. Configure the Environment
Create a `.env.local` file and set up your database credentials:
```env
DATABASE_URL="mysql://username:password@127.0.0.1:3306/restaurants_db"
```
Replace `username` and `password` with your MySQL credentials.

### 4. Set Up the Database
Run the following commands to create the database, apply migrations, and load test data:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

### 5. Run the Development Server
Start the Symfony development server:
```bash
symfony server:start
```

### 6. Access the Application
Open your browser and navigate to:
```
http://127.0.0.1:8000
```

You can now log in using the test accounts listed above.

---

## Additional Notes

- Ensure the `npm run dev` command is running to compile assets (CSS, JS).
- Modify or extend roles and permissions in `security.yaml` if needed.


