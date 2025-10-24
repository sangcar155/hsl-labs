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

 app
├── Events
│   └── OrderPlaced.php
├── Http
│   ├── Controllers
│   │   └── Provider
│   │       └── OrderController.php
│   ├── Requests
│   │   └── StoreOrderRequest.php
│   └── Middleware
├── Models
│   ├── Provider.php
│   ├── Product.php
│   ├── Order.php
│   └── Inventory.php
├── Policies
│   └── OrderPolicy.php
├── Services
│   └── OrderService.php
├── Listeners
│   └── SendOrderConfirmation.php

database
├── migrations
│   ├── xxxx_xx_xx_create_providers_table.php
│   ├── xxxx_xx_xx_create_products_table.php
│   ├── xxxx_xx_xx_create_orders_table.php
│   └── xxxx_xx_xx_create_inventory_table.php
└── seeders
    ├── ProviderSeeder.php
    ├── ProductSeeder.php
    └── OrderSeeder.php

routes
└── web.php

tests
└── Feature
    └── OrderPlacementTest.php

I have organized the Laravel project to separate responsibilities and keep code scalable as the system grows.
All HTTP request/response logic (controllers and validation requests) are under Http/Controllers and Http/Requests, grouped by domain (here, under Provider/ for provider-only actions).
Business logic is kept out of the controllers and placed in Services, which improves testability and clarity.
Policies handle permission/checks, enforcing that only authorized users can create orders.
Events and Listeners manage asynchronous work (like sending emails).
Database migrations and seeders are organized separately for clean setup and demo data.
Feature tests for each vertical slice of business logic are kept in tests/Feature for easy access and maintenance.