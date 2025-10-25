# HSL Labs – Provider Dashboard (Laravel Prototype)

A minimal Laravel application that lets Licensed Providers manage product orders, inventory, and patient subscriptions.  
See [PLAN.md](./PLAN.md) for scope & milestones and [ARCHITECTURE.md](./ARCHITECTURE.md) for the high‑level design.

A minimal Laravel application that lets Licensed Providers manage product orders, inventory, and patient subscriptions.

See:

PLAN.md
 → project scope & milestones

ARCHITECTURE.md
 → high-level design

 Prerequisites

Make sure you have:

PHP 8.1+

Composer (latest)

Node.js & NPM – only if you plan to compile frontend assets

MySQL or SQLite for database

Git

Installation
1 Create the project folder & initialize Git
mkdir hsl-labs && cd hsl-labs
git init

2 Scaffold a fresh Laravel app
composer create-project laravel/laravel .

3 Install frontend dependencies (optional)
npm install && npm run dev

4 Prepare the environment file
cp .env.example .env
php artisan key:generate


Then edit .env and set your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hsl_labs
DB_USERNAME=root
DB_PASSWORD=


Finally, clear & cache configuration:

php artisan config:clear
php artisan config:cache

 Database Setup & Seeders
Create Migrations
php artisan make:migration create_providers_table --create=providers
php artisan make:migration create_patients_table --create=patients
php artisan make:migration create_inventories_table --create=inventories
php artisan make:migration create_orders_table --create=orders
php artisan make:migration create_subscriptions_table --create=subscriptions


Run migrations:

php artisan migrate

(Optional) Fresh start with seeders
php artisan migrate:fresh --seed


Create seeders:

php artisan make:seeder ProviderSeeder
php artisan make:seeder PatientSeeder
php artisan make:seeder InventorySeeder
php artisan make:seeder OrderSeeder
php artisan make:seeder SubscriptionSeeder
php artisan make:seeder UserSeeder


Run a specific seeder:

php artisan db:seed --class=ProviderSeeder


Or run all seeders:

php artisan db:seed

 Running the Vertical Slice

Scenario: Provider places a wholesale product order

Start the development server
php artisan serve

The app uses Laravel Policies to handle authorization logic.
Policies ensure that only specific user roles (e.g., provider) can perform certain actions such as creating or viewing orders.

Implementation Summary

Created OrderPolicy using:

php artisan make:policy OrderPolicy --model=Order


Registered it in app/Providers/AuthServiceProvider.php

Used inside OrderController with:

$this->authorize('create', Order::class);


Only users with the role provider can create new orders.

Files Involved

app/Policies/OrderPolicy.php

app/Providers/AuthServiceProvider.php

app/Http/Controllers/OrderController.php

Fill in product/order details.

Submit the form.

The system:

Creates the order

Decrements inventory

Fires an OrderPlaced event
Event / Listener (Email Notification)

The project uses Laravel Events and Listeners to handle side effects such as sending emails when an order is placed.
This keeps the controller and service layers clean and focused on business logic.

Implementation Summary

Generated event and listener:

php artisan make:event OrderPlaced
php artisan make:listener SendOrderConfirmationEmail --event=OrderPlaced

The event (OrderPlaced) is fired after an order is successfully created.

The listener (SendOrderConfirmationEmail) sends a confirmation email to the provider.

The event–listener pair is registered in EventServiceProvider.

Files Involved

app/Events/OrderPlaced.php

app/Listeners/SendOrderConfirmationEmail.php

app/Providers/EventServiceProvider.php

app/Mail/OrderPlacedMail.php (for email template)

Trigger

The event is triggered inside OrderService:

event(new \App\Events\OrderPlaced($order));
Returns a JSON confirmation

Example JSON response:

{
  "message": "Order placed successfully!",
  "order": {
    "provider_id": 1,
    "inventory_id": 1,
    "patient_id": 1,
    "quantity": 2
  }
}

Testing with Postman (API Endpoint)

Endpoint:

POST http://127.0.0.1:8000/api/orders


Request Body:

{
  "provider_id": 1,
  "inventory_id": 1,
  "patient_id": 1,
  "quantity": 2
}


Response (201 Created):

{  "message": "Order placed successfully!",
  "data": {
    "provider_id": 1,
    "inventory_id": 1,
    "patient_id": 1,
    "quantity": 2
  }
}{
    "message": "Order placed successfully!",
    "data": {
        "provider_id": 1,
        "patient_id": 1,
        "inventory_id": 1,
        "quantity": 2,
        "total": 255.42,
        "status": "confirmed",
        "updated_at": "2025-10-25T11:48:26.000000Z",
        "created_at": "2025-10-25T11:48:26.000000Z",
        "id": 13,
        "provider": {
            "id": 1,
            "name": "Katrine Pagac V",
            "email": "georgianna93@example.net",
            "clinic_name": "Mosciski, Torphy and Carroll",
            "created_at": "2025-10-25T01:38:08.000000Z",
            "updated_at": "2025-10-25T01:38:08.000000Z"
        },
        "inventory": {
            "id": 1,
            "product_name": "culpa",
            "quantity": 42,
            "price": "127.71",
            "created_at": "2025-10-25T02:10:08.000000Z",
            "updated_at": "2025-10-25T11:48:26.000000Z"
        },
        "patient": {
            "id": 1,
            "name": "Jeromy Kassulke II",
            "email": "ziemann.chelsea@example.org",
            "phone": "254.948.6794",
            "created_at": "2025-10-25T02:24:05.000000Z",
            "updated_at": "2025-10-25T02:24:05.000000Z"
        }
    }
}
Dashboard View
Once orders are created, view them in the browser:

http://127.0.0.1:8000/dashboard/orders


You’ll see a list view showing:
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/73fb14e0-bed1-42b7-a28b-51c0b693b89a" />

Provider name

Inventory item

Quantity

Total

Status

 Example – Orders Dashboard View:

Running Automated Tests

Run all tests:

php artisan test


Run only order-related tests:

php artisan test --filter=ProviderOrderTest


Tests included:

Successful order placement reduces inventory

Ordering more than available stock triggers validation error

Utility Commands
php artisan cache:clear
php artisan config:clear
php artisan route:clear

Further Reading

PLAN.md
 — concise project plan & milestones

ARCHITECTURE.md
 — high-level architecture diagram
