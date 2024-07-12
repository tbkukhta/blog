# Blog

*PHP 8.1, Laravel 10, MariaDB 10, jQuery 3, Bootstrap 4*

This is a simple web application providing a blog with posts as frontend side of the project and admin panel to fill and edit the blog as backend side.  
The application has an API module with Bearer token authentication.  
Caching is implemented by using Redis.  
Only users with status `Admin` have access to admin panel and can edit database fields values.

**Site features**:
- View and search posts by categories and tags
- Register/login, edit user profile
- Add comments for posts

**Admin panel features:**
- Manage and search users, posts, categories, tags, comments, adverts

**API requests:**
- `/api/v1/register` **(POST)** - register user
- `/api/v1/login` **(POST)** - login
- `/api/v1/logout` **(GET)** - logout
- `/api/v1/categories` **(GET)** - show categories list
- `/api/v1/categories` **(POST)** - create category
- `/api/v1/categories/{category_id}` **(GET)** - show category
- `/api/v1/categories/{category_id}` **(PUT)** - update category
- `/api/v1/categories/{category_id}` **(DELETE)** - delete category
- `/api/v1/tags` **(GET)** - show tags list
- `/api/v1/tags` **(POST)** - create tag
- `/api/v1/tags/{tag_id}` **(GET)** - show tag
- `/api/v1/tags/{tag_id}` **(PUT)** - update tag
- `/api/v1/tags/{tag_id}` **(DELETE)** - delete tag
- `/api/v1/posts` **(GET)** - show posts list
- `/api/v1/posts` **(POST)** - create post
- `/api/v1/posts/{post_id}` **(GET)** - show post
- `/api/v1/posts/{post_id}` **(PUT)** - update post
- `/api/v1/posts/{post_id}` **(DELETE)** - delete post

*example API request:*  

`/api/v1/posts/1` **(PUT)**  

*example json data for the request above:*  
```php
{
    "title": "Post 1",
    "description": "Post 1 description",
    "content": "Post 1 content",
    "category_id": "1",
    "tags": [1, 2],
    "status": "1"
}
```

## Installation

- **composer install**
- **npm i**
- **php artisan ckfinder:download**
- **php artisan migrate**
- **php artisan db:seed** (Use this command to create default user with admin role and fill database fields with test data. You can edit default seeding options in `database/seeders/DatabaseSeeder.php`. Or skip this command to leave empty database)
- **npx mix --production**

## Settings
Edit `.env` file to change default settings.  
You can set such options like database settings, string length for validation rules, pagination count, popular posts/categories/tags count and cache interval for sidebar and footer elements.  
Caching elements, such as adverts and popular posts/categories/tags, update automatically on corresponding models create/update/delete at admin panel.  
Use `php artisan cache:clear` command to clear cache manually.  
Last modified adverts display on the site.
