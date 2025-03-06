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
* Dummy Category List by Seeding
* Comment on a blog
* Relationships with post, category, user

### Note
I tried to build APIs for communicate with frontend for mini blog project. We can add many features to this application to make it more user-friendly and enhance the user experience. 