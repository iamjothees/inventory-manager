# Inventory Management System - AI Agent Instructions

## Project Overview
This is an **Inventory Management System** built for tracking and managing product inventory, stock levels, suppliers, and orders.

Built with the **TALL Stack** - a modern Laravel full-stack solution for building reactive, dynamic interfaces.

---

## Tech Stack

### TALL Stack
| Technology | Version | Purpose |
|------------|---------|---------|
| **TailwindCSS** | 3.x | Utility-first CSS framework |
| **Alpine.js** | 3.x | Lightweight reactive JavaScript |
| **Laravel** | 12.x | PHP web application framework |
| **Livewire** | 4.x | Full-stack reactive components |

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| **PHP** | 8.3+ | Server-side programming language |
| **MySQL** | 8.0 | Relational database |
| **Composer** | Latest | PHP dependency manager |

### Frontend & Build
| Technology | Version | Purpose |
|------------|---------|---------|
| **Vite** | Latest | Frontend build tool & dev server |
| **Blade** | (Laravel) | Server-side templating engine |

### Infrastructure
| Technology | Version | Purpose |
|------------|---------|---------|
| **Docker** | Latest | Containerization |
| **Docker Compose** | Latest | Multi-container orchestration |

---

## Development Environment

### Docker Services
- **app** (`inv-man`): Laravel application container on port `8000`
- **db** (`inv-man-db`): MySQL database container on port `8001`

### Commands
```bash
# Start development environment
docker compose up -d

# Run Laravel commands inside container
docker exec -it inv-man php artisan <command>

# Install dependencies
docker exec -it inv-man composer install
docker exec -it inv-man npm install

# Run dev server with hot reload
docker exec -it inv-man composer dev
```

---

## Project Structure
```
inventory-manager/
├── docker-compose.yml    # Docker services configuration
├── Dockerfile            # App container definition
├── src/                  # Laravel application
│   ├── app/              # Application code (Models, Controllers, etc.)
│   ├── config/           # Configuration files
│   ├── database/         # Migrations, seeders, factories
│   ├── public/           # Public assets & entry point
│   ├── resources/        # Views, CSS, JS source files
│   ├── routes/           # Route definitions
│   ├── storage/          # Logs, cache, uploads
│   └── tests/            # PHPUnit tests
└── startup.sh            # Container startup script
```

---

## Coding Standards & Conventions

### PHP/Laravel
- Follow **PSR-12** coding standards
- Use **Laravel Pint** for code formatting: `composer pint`
- Use **Eloquent ORM** for database interactions
- Follow Laravel naming conventions:
  - Models: `PascalCase`, singular (e.g., `Product`, `Supplier`)
  - Controllers: `PascalCase` with `Controller` suffix (e.g., `ProductController`)
  - Tables: `snake_case`, plural (e.g., `products`, `suppliers`)
  - Migrations: descriptive with timestamp prefix

### Database
- Always create migrations for schema changes
- Use foreign key constraints for relationships
- Seed development data using factories and seeders

### Livewire 4
- Create components: `php artisan make:livewire ComponentName`
- Use `wire:model.live` for real-time two-way binding
- Use `wire:click` for actions, `wire:submit` for forms
- Leverage Livewire's built-in validation with `#[Validate]` attributes
- Use `$this->dispatch()` for component communication
- Prefer Livewire components over traditional controllers for interactive UIs

### Frontend (Blade + Alpine.js)
- Use Blade components for reusable UI elements
- Organize CSS with Tailwind utility classes
- Use Alpine.js for client-side interactivity (`x-data`, `x-show`, `x-on`)
- Combine Alpine.js with Livewire using `@entangle` for shared state

---

## Core Domain Entities (Planned)

| Entity | Description |
|--------|-------------|
| **Product** | Items tracked in inventory |
| **Category** | Product categorization |
| **Supplier** | Vendors who supply products |
| **Warehouse** | Storage locations |
| **Stock** | Current inventory levels per product/warehouse |
| **Order** | Purchase/sales orders |
| **OrderItem** | Line items within orders |
| **User** | System users with roles |

---

## Key Features (Planned)

1. **Product Management** - CRUD operations for products
2. **Stock Tracking** - Real-time inventory levels
3. **Low Stock Alerts** - Notifications when stock is low
4. **Supplier Management** - Track supplier information
5. **Order Processing** - Handle purchase and sales orders
6. **Reporting & Analytics** - Inventory reports and dashboards
7. **User Authentication** - Role-based access control
8. **Audit Trail** - Track all inventory changes

---

## Testing
```bash
# Run all tests
docker exec -it inv-man composer test

# Run specific test
docker exec -it inv-man php artisan test --filter=TestName
```

---

## Environment Variables
Key configuration in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=inv-man
DB_USERNAME=inv-man
DB_PASSWORD=
```

---

## Notes for AI Agent
- Always run migrations after creating schema changes
- Use Laravel's built-in validation for request data
- Implement repository pattern for complex data operations
- Write feature tests for critical business logic
- Use queues for time-consuming operations (emails, reports)
