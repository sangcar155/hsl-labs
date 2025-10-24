
 1) create project folder and initialize git
    mkdir hsl-labs && cd hsl-labs
    git init

 2) create a new Laravel app (Laravel 10)
   composer create-project laravel/laravel hsl-labs


 3) basic setup
    cp .env.example .env
    php artisan key:generate

 4) create required top-level docs and folders for the assignment
    touch PLAN.md ARCHITECTURE.md README.md
    mkdir -p database/seeders tests/Feature app/Services app/Actions app/Policies

 5) make an initial commit
    git add .
    git commit -m "chore: initial Laravel skeleton + assignment docs"
