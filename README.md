# Blog

*PHP 8.1, Laravel 10, MariaDB 10, jQuery 3, Bootstrap 4*

This is a simple web application providing a blog with posts as frontend side of the project and admin panel to fill and edit the blog as backend side.

**Site features**:
- View and search posts by categories and tags
- Register/login, edit user profile
- Add comments for posts

**Admin panel features:**
- Manage and search users, posts, categories, tags, comments, adverts

## Installation

- **composer install**
- **npm i**
- **php artisan ckfinder:download**
- **php artisan migrate**
- **php artisan db:seed** (Use this command to create default user with admin role and fill database fields with test data. You can edit default seeding options in `database/seeders/DatabaseSeeder.php`. Or skip this command to leave empty database)
- **npx mix --production**

## Settings
Edit `.env` file to change default settings. You can set such options like database settings, string length for validation rules, pagination count, popular posts/categories/tags count and cache interval for sidebar and footer elements. Caching elements, such as adverts and popular posts/categories/tags, update automatically on corresponding models create/update/delete at admin panel. Use `php artisan cache:clear` command to clear cache manually. Last modified adverts display on the site.
