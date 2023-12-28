<h1>Turbo VUMC</h1>

This is the Driver and Automobile implementation for VUMC.

Written using Laravel 10 (with Turbo Laravel and Breeze), StimulusJs, TailwindCSS, and MySQL.  

Couple of caveats:
* This was my first time trying out the Hotwire paradigm, using Stimulus, and using TailwindCSS.  This was a fun exercise but there was a LOT to learn.  I did not do the paradigm justice with my implementation.  I am sure my implementation would have been cleaner if I used VueJS, Angular, or just jQuery, but here we are.
* I used Laravel Breeze to bootstrap the project.  This added authentication, a few components and some styling.

Implementation notes:
* I added two approaches for assigning a driver to an automobile to give you some insight into frontend and backend business logic.  
* I added the avatars to give myself an opportunity to use a trait and some reusable code betwixt models (to help check of some OOP approaches).  You'll need an Unsplash API key and secret (they're free) added to the .env as <code>UNSPLASH_ACCESS_KEY</code> and <code>UNSPLASH_PRIVATE_KEY</code>.  When editing an existing automobile or driver, if you click the avatar image a new random image will be pulled.
* I used a repository pattern in the backend.  I like this pattern for models that require business logic in their handling as it gives you one contract to follow when performing CRUD actions or helper functions anywhere in the application.