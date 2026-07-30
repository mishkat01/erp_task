# ERP Task — Procurement Management System

A role-based procurement ERP built with Laravel, Bootstrap, and Alpine.js. Employees raise purchase requisitions, managers approve or reject them, and the procurement team manages the product/supplier catalog and converts approved requisitions into purchase orders.

## Features

**Employee Panel**
- Submit purchase requisitions with multiple line items
- Track the status of submitted requisitions (Pending / Approved / Rejected)
- Edit or delete a requisition while it is still pending

**Manager Panel**
- Review pending requisitions
- Approve or reject requisitions (rejection requires a reason)
- Approved requisitions become locked — no further edits or deletion

**Procurement Panel**
- Dashboard: total products, total suppliers, pending PR count, approved PR count
- Product CRUD (SKU, name, unit, current stock)
- Supplier CRUD (name, phone, email, address)
- Create a Purchase Order from any approved requisition
- Search requisitions by PR number, employee, or department; filter by status
- PR list and PO list reports

**Core rules enforced**
- Auto-generated PR numbers (`PR-00001`) and PO numbers (`PO-00001`)
- No duplicate products within a single requisition
- Quantity must be greater than zero
- Requisitions and purchase orders are created inside database transactions
- Purchase orders can only be created from an approved requisition
- Role-based access — each panel is only reachable by its own role

## Tech Stack

- PHP 8.3+ / Laravel 13
- MySQL
- Bootstrap 5 + Alpine.js
- Vite

## Requirements

- PHP >= 8.3 with the extensions Laravel needs (`pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`)
- Composer
- Node.js >= 18 and npm
- MySQL (or MariaDB, e.g. via XAMPP)

## Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd erp_task
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   ```

4. **Create your environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure the database**

   Create an empty database (e.g. `erp_task`), then update `.env` if your credentials differ from the defaults:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=erp_task
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations and seed reference data**
   ```bash
   php artisan migrate --seed
   ```
   This creates all tables and seeds departments, a batch of demo products, and one demo login for each role (see [Demo Credentials](#demo-credentials) below).

7. **Build frontend assets**
   ```bash
   npm run build
   ```
   For active development, use `npm run dev` in a separate terminal instead — it watches and hot-reloads assets.

8. **Serve the application**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000`. (If you're running this under XAMPP/Apache instead, point your vhost at the `public/` directory and skip this step.)

## Demo Credentials

`php artisan migrate --seed` creates one login per role (password is the same for all three: **`password`**), so you can log in and test every panel right away:

| Role         | Email                    | Password   |
|--------------|--------------------------|------------|
| Employee     | `employee@demo.test`     | `password` |
| Procurement  | `procurement@demo.test`  | `password` |
| Manager      | `manager@demo.test`      | `password` |

Each account is redirected to its own dashboard on login and can only access the routes for that role. You can also register new accounts at `/register` and pick a **Role** (Employee, Procurement, or Manager) — Employees also select a Department.

## Getting Started

A demo `Product` catalog is already seeded, so you can try the full flow right away:
1. Log in as **Procurement** (`procurement@demo.test`) → add a Supplier (Suppliers page). Products already exist from the seeder.
2. Log in as **Employee** (`employee@demo.test`) → submit a requisition against one of the seeded products.
3. Log in as **Manager** (`manager@demo.test`) → approve (or reject) the requisition.
4. Back in the **Procurement** account → create a Purchase Order from the approved requisition.

## Running Tests

```bash
php artisan test
```

Tests run against an in-memory SQLite database (configured in `phpunit.xml`) and do not touch your local MySQL data.
