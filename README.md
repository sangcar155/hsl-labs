
 1) create project folder and initialize git
    mkdir hsl-labs && cd hsl-labs
    git init

 2) Install dependency - create a new Laravel app 
    composer create-project laravel/laravel hsl-labs
    npm install
    npm run dev

 3) basic setup
    cp .env.example .env
    php artisan key:generate

 4) create required top-level docs and folders for the assignment
    touch PLAN.md ARCHITECTURE.md README.md
    mkdir -p database/seeders tests/Feature app/Services app/Actions app/Policies

 5) make an initial commit
    git add .
    git commit -m "chore: initial Laravel skeleton + assignment docs"
6) Configure database connection

    Open the .env file and update your database settings — use MySQL or SQLite as preferred:

    For MySQL:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=hsl_labs
    DB_USERNAME=root
    DB_PASSWORD=
    Then clear and cache your config:
    php artisan config:clear
    php artisan config:cache

 7. Providers table
    php artisan make:migration create_providers_table --create=providers

     Patients table
    php artisan make:migration create_patients_table --create=patients

     Inventories table
    php artisan make:migration create_inventories_table --create=inventories

     Orders table
    php artisan make:migration create_orders_table --create=orders

     Subscriptions table
    php artisan make:migration create_subscriptions_table --create=subscriptions

    Run migrations
    php artisan migrate

     (Optional) Rerun migrations if needed
     php artisan migrate:fresh --seed

8.Generate Seeder Files

    Run these commands in your terminal:

    php artisan make:seeder ProviderSeeder
    php artisan make:seeder PatientSeeder
    php artisan make:seeder InventorySeeder
    php artisan make:seeder OrderSeeder
    php artisan make:seeder SubscriptionSeeder
    php artisan make:seeder UserSeeder

9. Pre-fill tables with sample/fake data:

    Providers

    php artisan db:seed --class=ProviderSeeder


    Patients

    php artisan db:seed --class=PatientSeeder


    Inventory

    php artisan db:seed --class=InventorySeeder

9. Start the development server
    php artisan serve


    Open your browser and go to http://localhost:8000.

    Optional Commands

    Clear cache:

    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear


    Run all seeders at once:

    php artisan db:seed