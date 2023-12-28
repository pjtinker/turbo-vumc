<h1>Turbo VUMC</h1>

This is the Driver and Automobile implementation for VUMC.

Build using:
* PHP 8.2
* <a href="https://laravel.com/docs/10.x/">Laravel 10</a>
* <a href="https://github.com/hotwired-laravel/turbo-laravel">Turbo Laravel </a> 
* <a href="https://github.com/hotwired-laravel/stimulus-laravel">Stimulus Laravell </a>
* <a href="https://github.com/hotwired-laravel/turbo-breeze">Turbo Breeze </a>

Couple of caveats:
* This was my first time trying out the Hotwire paradigm, using Stimulus, and using TailwindCSS.  This was a fun exercise but there was a LOT to learn.  I did not do the paradigm justice with my implementation and I am sure my approach would have been cleaner if I used VueJS, Angular, or just jQuery, but here we are.
* Turbo Breeze (a fork of Laravel Breeze) adds authentication out of the box.
* I borrowed heavily from the styles used in the <a href="https://turbo-laravel.com/guides/introduction">Turbo Laravel Bootcamp</a> 

Implementation notes:
* I added two approaches for assigning a driver to an automobile to give you some insight into frontend and backend business logic.  
* I added the avatars to give myself an opportunity to use a trait and some reusable code betwixt models (to help check off some OOP approaches).  You'll need an Unsplash API key and secret (they're free) added to the .env as <code>UNSPLASH_ACCESS_KEY</code> and <code>UNSPLASH_PRIVATE_KEY</code> if you build locally.  When editing an existing automobile or driver, if you click the avatar image a new random image will be pulled.
* I used a repository pattern with a service layer in the backend.  I like this pattern for models that require business logic in their handling as it gives you one contract to follow when performing CRUD actions and a separate layer in which to apply business logic.

Local Installation
* 1. Clone the project
* 2. Run <code>composer install</code>
* 3. Run <code>cp .env.example .env</code>
* 4. Run <code>php artisan key:generate</code>
* 5. Run <code>php artisan migrate:fresh --seed</code>
* 6. Run <code>php artisan serve</code>
* 7. Go to link localhost:8000

Sail share
* I can also deploy the code to a public site via <code>sail share</code> if you'd rather not go through the local installation.  