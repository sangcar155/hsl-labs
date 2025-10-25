ERD Diagram
+------------------+       +------------------+       +--------------------+
|   providers      | 1---* |    orders        | *---* |    products        |
|------------------|       |------------------|       |--------------------|
| id               |       | id               |       | id                 |
| name             |       | provider_id      |       | name               |
| email            |       | total_amount     |       | sku                |
| clinic_name      |       | status           |       | stock_quantity     |
| created_at       |       | created_at       |       | created_at         |
+------------------+       +------------------+       +--------------------+

       |
       | 1
       | 
       * 
+------------------+
|    patients      |
|------------------|
| id               |
| provider_id      |
| name             |
| email            |
| surgery_date     |
| subscription_plan|
| created_at       |
+------------------+
High-Level System Explanation

   * The HSL Labs dashboard connects Providers, Patients, Orders, and Products.

   * Each Provider manages their own patients and inventory.

   * Orders represent wholesale purchases of products by providers from HSL Labs.

   * When an order is placed, the provider’s inventory updates accordingly.

   * Patients are linked to providers and may have ongoing subscriptions to the product.

   * The dashboard aggregates this data, allowing providers to view sales, stock, and subscription renewals in real time.

   * A background process or event system (queue/job) handles email confirmations and potential payment operations asynchronously.
    ==================================================       
    
LARAVEL PROJECT STRUCTURE
hsl-labs/
│
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── ProviderController.php
│   │   │   ├── OrderController.php
│   │   │   ├── InventoryController.php
│   │   │   ├── PatientController.php
│   │   │   └── SubscriptionController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   │       ├── OrderRequest.php
│   │       └── InventoryRequest.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Provider.php
│   │   ├── Patient.php
│   │   ├── Inventory.php
│   │   ├── Order.php
│   │   └── Subscription.php
│   │
│   ├── Policies/
│   │   └── OrderPolicy.php
│   │
│   ├── Services/
│   │   ├── OrderService.php
│   │   ├── InventoryService.php
│   │   └── NotificationService.php
│   │
│   ├── Events/
│   │   └── OrderPlaced.php
│   │
│   ├── Listeners/
│   │   └── SendOrderConfirmation.php
│   │
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   │
│   └── Traits/
│       └── HandlesInventory.php
│
├── bootstrap/
│   └── app.php
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── mail.php
│
├── database/
│   ├── factories/
│   ├── migrations/
│   │   ├── 2025_10_24_000000_create_providers_table.php
│   │   ├── 2025_10_24_000001_create_patients_table.php
│   │   ├── 2025_10_24_000002_create_inventories_table.php
│   │   ├── 2025_10_24_000003_create_orders_table.php
│   │   └── 2025_10_24_000004_create_subscriptions_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── ProviderSeeder.php
│       ├── PatientSeeder.php
│       ├── InventorySeeder.php
│       ├── OrderSeeder.php
│       ├── SubscriptionSeeder.php
│       └── UserSeeder.php
│
├── public/
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── images/
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── dashboard/
│   │   │   ├── home.blade.php
│   │   │   ├── orders.blade.php
│   │   │   ├── inventory.blade.php
│   │   │   └── patients.blade.php
│   │   └── auth/
│   │       ├── login.blade.php
│   │       └── register.blade.php
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── tests/
│   ├── Feature/
│   │   └── ProviderOrderTest.php
│   └── Unit/
│       └── OrderServiceTest.php
│
├── .env
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── README.md
├── PLAN.md
└── ARCHITECTURE.md

I have organized the Laravel project to separate responsibilities and keep code scalable as the system grows.
All HTTP request/response logic (controllers and validation requests) are under Http/Controllers and Http/Requests, grouped by domain (here, under Provider/ for provider-only actions).
Business logic is kept out of the controllers and placed in Services, which improves testability and clarity.
Policies handle permission/checks, enforcing that only authorized users can create orders.
Events and Listeners manage asynchronous work (like sending emails).
Database migrations and seeders are organized separately for clean setup and demo data.
Feature tests for each vertical slice of business logic are kept in tests/Feature for easy access and maintenance.