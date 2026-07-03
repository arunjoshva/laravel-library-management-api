# Laravel Library Management API

A RESTful Library Management API built with **Laravel 13** and **PostgreSQL**. The application provides secure authentication using Laravel Sanctum and CRUD operations for managing Authors and Books. The API is deployed on Render and uses Neon as its cloud hosted PostgreSQL database.

---

## Live Demo

**Base URL**

```text
https://laravel-library-management-api.onrender.com
```

---

## Tech Stack

* Laravel 13
* PHP 8.x
* PostgreSQL
* Laravel Sanctum
* Neon PostgreSQL
* Render
* Postman
* Git & GitHub

---

## Features

### Authentication

* User Registration
* User Login
* User Logout
* User Profile
* Token-based Authentication using Laravel Sanctum

### Authors

* Create Author
* View All Authors
* View Single Author
* Update Author
* Delete Author

### Books

* Create Book
* View All Books
* View Single Book
* Update Book
* Delete Book

---

## API Endpoints

### Authentication

| Method | Endpoint        |
| ------ | --------------- |
| POST   | `/api/register` |
| POST   | `/api/login`    |
| POST   | `/api/logout`   |
| GET    | `/api/profile`  |

### Authors

| Method | Endpoint            |
| ------ | ------------------- |
| GET    | `/api/authors`      |
| POST   | `/api/authors`      |
| GET    | `/api/authors/{id}` |
| PUT    | `/api/authors/{id}` |
| DELETE | `/api/authors/{id}` |

### Books

| Method | Endpoint          |
| ------ | ----------------- |
| GET    | `/api/books`      |
| POST   | `/api/books`      |
| GET    | `/api/books/{id}` |
| PUT    | `/api/books/{id}` |
| DELETE | `/api/books/{id}` |

---

## Authentication

After logging in, include the access token in the request header.

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```

---

## Sample Request

### Register

**POST**

```http
/api/register
```

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"    
}
```

---

### Login

**POST**

```http
/api/login
```

```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

---

### Create Author

**POST**

```http
/api/authors
```

```json
{
    "name": "Robert C. Martin",
    "bio": "Software engineer and author.",
    "date_of_birth": "1952-12-05",
    "nationality": "American"
}
```

---

### Create Book

**POST**

```http
/api/books
```

```json
{
    "title": "Clean Code",
    "author_name": "Robert C. Martin",
    "isbn": "9780132350884",
    "description": "A handbook of agile software craftsmanship.",
    "published_year": 2008,
    "total_copies": 3000,
    "available_copies": 1500
}
```

---

Start the development server:

```bash
php artisan serve
```

---

## Deployment

* **Application Hosting:** Render
* **Database Hosting:** Neon PostgreSQL

---