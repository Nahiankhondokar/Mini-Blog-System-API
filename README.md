## How to run this **Mini Blog System Application** 
* Clone or Download the project.
* Create .env file & connect mysql database.
* composer install
* php artisan key:generate
* php artisan queue:table
* php artisan migrate --seed (categories seeding)
* php artisan serve

## Project Description
This project is a simple **Mini Blog System Application** where we login, create new blog & comments on the blog, etc. The features are given below,
* User Registration
* User Login/Logout
* Blog CRUD
* Dummy Category List
* Comment on a blog
* Relationships with post, category, user
