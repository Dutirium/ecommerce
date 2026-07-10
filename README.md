# E-Commerce Platform

A full-stack e-commerce platform built with **Laravel 13**, featuring product management, multiple product images, wishlist and cart systems, secure checkout, Razorpay payments, order tracking, email confirmations, PDF receipts, and an admin dashboard.

The project was built as a practical exploration of Laravel architecture, with emphasis on MVC, Eloquent relationships, secure checkout flows, database transactions, and clean separation of responsibilities.

---

## Features

### Customer Experience

* User authentication
* Product browsing
* Product detail pages
* Multiple product image gallery
* Product size selection
* Related product recommendations
* AJAX wishlist management
* AJAX Add to Cart
* Dynamic cart quantity updates
* Cart item removal
* Order checkout
* Cash on Delivery
* Razorpay online payments
* Order confirmation emails
* PDF receipts
* Customer order history
* Detailed order tracking

### Admin Dashboard

* Create products
* Edit existing products
* Upload multiple product images
* Append additional images during product editing
* Manage product price and stock
* Activate or deactivate products
* Secure admin-only access

---

## Tech Stack

### Backend

* Laravel 13
* PHP 8.5
* MySQL
* Eloquent ORM
* Laravel Blade
* Laravel Storage

### Frontend

* HTML
* CSS
* JavaScript
* Fetch API
* Tailwind CSS 3
* Vite

### Integrations

* Razorpay Payment Gateway
* Email Order Confirmations
* PDF Receipt Generation

---

## Architecture

The application follows Laravel's MVC architecture:

```text
Browser
   ↓
Route
   ↓
Controller
   ↓
Service Layer / Eloquent Model
   ↓
Database
   ↓
Blade View
   ↓
HTML + JavaScript
```

Checkout logic is separated into an `OrderService`, keeping payment controllers focused on payment-specific responsibilities while sharing the same secure order creation flow.

---

## Core Data Model

The application uses the following primary models:

```text
User
 ├── Cart
 │    └── CartItem
 │
 ├── Wishlist
 │
 └── Orders
      └── OrderItems

Product
 ├── ProductImages
 ├── CartItems
 ├── Wishlist Entries
 └── OrderItem Snapshots
```

Order items preserve purchase-time data such as:

* Product name
* Selected size
* Unit price
* Quantity
* Subtotal

This ensures historical orders remain accurate even if the original product is later modified.

---

## Secure Checkout Flow

The checkout system supports both **Cash on Delivery** and **Razorpay** payments.

```text
Cart
   ↓
Checkout
   ↓
Payment Method
   ├── Cash on Delivery
   │        ↓
   │   Create Order
   │
   └── Razorpay
            ↓
       Create Payment Order
            ↓
       Razorpay Checkout
            ↓
       Verify Signature
            ↓
       Create Order
```

The order creation service uses:

* Database transactions
* Row locking
* Server-side price calculations
* Stock validation
* Stable product locking order
* Stock decrementing
* Order item snapshots
* Automatic cart clearing
* Transaction retry handling

Client-provided prices are never trusted during order creation.

---

## Product Image System

Products support multiple images.

Uploaded files are managed using Laravel Storage:

```text
storage/app/public/products/
```

The public storage symlink exposes them through:

```text
public/storage/
```

Each product image supports:

* Image path
* Primary image status
* Sort order

The product detail page provides a thumbnail gallery where customers can switch the main displayed image without reloading the page.

---

## Cart System

The cart supports product size variants.

A cart item is uniquely identified by:

```text
cart_id + product_id + size
```

This allows the same product in different sizes to exist as separate cart entries.

Cart operations use asynchronous JavaScript requests for:

* Adding products
* Increasing quantity
* Decreasing quantity
* Removing products
* Updating subtotal
* Updating total price

---

## Wishlist System

Authenticated customers can add and remove products from their wishlist without reloading the page.

The wishlist uses Laravel controllers and Eloquent relationships on the backend, with the Fetch API handling asynchronous interactions on the frontend.

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/Dutirium/ecommerce.git
cd ecommerce
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create the environment file

```bash
cp .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Configure the database

Update the following values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Create the storage link

```bash
php artisan storage:link
```

### 9. Build frontend assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 10. Start the application

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## Environment Configuration

The application requires environment configuration for:

* Database connection
* Mail service
* Razorpay credentials
* Application URL

Example:

```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

RAZORPAY_KEY=
RAZORPAY_SECRET=
```

Never commit the real `.env` file or production credentials to source control.

---

## Production Build

For production deployment:

```bash
composer install --no-dev --optimize-autoloader

npm ci
npm run build

php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Production environment settings should include:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

---

## Security Considerations

The project includes several security-focused implementation choices:

* CSRF protection
* Authentication middleware
* Admin authorization checks
* Resource ownership validation
* Server-side validation
* Server-side price calculation
* Razorpay signature verification
* Database transactions
* Row locking during checkout
* Stock validation before order creation
* Environment-based secret management

---

## Project Status

The application is functionally complete as an MVP.

Current scope includes:

* Product management
* Product galleries
* Wishlist
* Shopping cart
* Size selection
* Checkout
* COD payments
* Razorpay payments
* Order emails
* PDF receipts
* Order history
* Admin product management
* Responsive mobile access

The project intentionally avoids unnecessary complexity such as a full SKU inventory engine, color variants, image drag-and-drop management, and advanced warehouse management.

---

## Author

**Rajat Kanyal**

B.Tech Data Science student focused on backend development, machine learning, artificial intelligence, and scalable software systems.

---

## License

This project is intended for educational and portfolio purposes.
