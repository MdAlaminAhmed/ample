# Copilot Instructions for Ample Billing & Inventory System

## Architecture Overview
This is a PHP-based billing and inventory management system using procedural PHP patterns with basic OOP for database operations.

**Core Structure:**
- **Single Entry Point**: `index.php` handles all page routing via `?page=` parameter
- **Page Router**: `pages/` contains all UI pages, loaded dynamically in index.php
- **Action Handlers**: `app/action/` contains form processors and CRUD operations
- **Global Objects**: `$obj` (Objects class) and `$Ouser` (User class) initialized in `app/init.php`

## Key Patterns & Conventions

### Database Operations
- Use the global `$obj` instance for all CRUD operations via `Objects` class
- Standard methods: `$obj->create($table, $fields)`, `$obj->update($table, $column, $id, $fields)`, `$obj->find($table, $column, $value)`
- All forms submit to corresponding files in `app/action/` directory
- Products get auto-generated codes: `"P" . time()`

### Page Structure
- Pages in `pages/` directory follow naming: `{entity}_list.php`, `{entity}_edit.php`, `add_{entity}.php`
- All pages wrapped in `<div class="content-wrapper">` for AdminLTE layout
- Navigation via `index.php?page={page_name}` (without .php extension)

### Authentication & Session
- Login check via `$Ouser->is_login()` in header.php
- Admin check via `$Ouser->is_admin()` 
- Session stores: `$_SESSION['user_id']` and `$_SESSION['user_role']`
- Passwords hashed with `md5()` (legacy pattern in codebase)

### File Upload Patterns
- Product images stored with naming: `product_{product_code}.{ext}`
- Upload directory: `assets/images/products/`
- Allowed extensions: jpg, jpeg, png, gif

### Date Handling
- Database format: `dateForDb($date)` converts to Y-m-d
- Display format: `dateForUser($date)` converts to d-m-Y  
- Timezone set to "Asia/Kolkata"

## Core Entities & Tables
- **products**: Main inventory with categories, SKU, buy/sell prices
- **catagory**: Product categories (note: table name uses "catagory" not "category")
- **member**: Customer management
- **invoice/invoice_details**: Sales transactions 
- **purchase_products**: Purchase/procurement
- **expense/expense_catagory**: Expense tracking
- **suppliar**: Supplier management (note: "suppliar" not "supplier")
- **staff**: Employee records

## Development Workflow
**Local Environment**: XAMPP stack (localhost/ample/)
**Database**: Import `database/ample.sql` into MySQL
**Config**: Update database credentials in `app/config/config.php`

### Adding New Features
1. Create page file in `pages/` directory
2. Add corresponding action handler in `app/action/`
3. Use global `$obj` for database operations
4. Follow existing modal patterns in `inc/` for forms
5. Add navigation links in `inc/sidebar.php`

### AJAX & Search Features
- Product search via `app/ajax/product_search.php` (searches name, product_id, SKU, brand)
- Quick sell uses AJAX product search instead of dropdown selection
- Search results show product image, name, code, stock, and price
- JavaScript files loaded via `inc/footer.php` with conditional loading

### UI Framework
- AdminLTE 3 theme for dashboard layout
- Bootstrap 4 for forms and components
- DataTables for listing pages
- Select2 for dropdowns

## Critical Files
- `app/init.php`: Global object initialization and session start
- `app/classes/Object.php`: Database abstraction layer
- `inc/header.php`: Authentication check and common includes
- `index.php`: Main routing logic