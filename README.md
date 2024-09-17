
## *********************************************************************************************************

## https://devrockspro.online/public/register
## https://devrockspro.online/public/login


## Task Management Application
This is a simple task management system built with Laravel. It allows users to register, log in, create, edit, delete, and filter tasks. The application also exposes RESTful API endpoints for task operations, protected by token-based authentication.
## Features
User authentication (registration, login).
Create, edit, and delete tasks with a title, description, due date, and priority (Low, Medium, High).
View tasks filtered by priority and due date.
RESTful API with token-based authentication.
Responsive frontend using Laravel Blade templating.
## Prerequisites
PHP 8.2
Composer
MySQL
Node.js & npm (for frontend assets)
Laravel 11
A web server (Apache/Nginx)
## Setup Instructions
1.Clone the repository:
git clone https://github.com/your-repo.git
cd your-repo
2.Install dependencies:
composer install
npm install
npm run dev
3.Set up environment variables: Copy .env.example to .env and configure the necessary variables:
cp .env.example .env
    *Update the database credentials:
    DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
4.Generate an application key:
php artisan key:generate
5.Run database migrations:
php artisan migrate
6.Start the development server:
php artisan serve
7.Set up token-based authentication: If using the API, make sure to generate personal access tokens(Optional):
php artisan passport:install

## API Documentation
All API requests must include an Authorization header with the Bearer token:
Authorization: Bearer <token>
Task Endpoints:
Method	     Endpoint	        Description	                        Request Body
GET	        /api/tasks	        Get all tasks	                    None
GET     	/api/tasks/{id}	    Get a specific task	                None
POST	    /api/tasks	        Create a new task	                { title, description, due_date, priority }
PUT	        /api/tasks/{id}	    Update an existing task	            { title, description, due_date, priority }
DELETE	    /api/tasks/{id}	    Delete a task	                    None

## Sample Request/Response:
Create Task
Request:
POST /api/tasks
{
  "title": "New Task",
  "description": "Task description",
  "due_date": "2024-09-30",
  "priority": "High"
}

Response:
{
  "id": 1,
  "title": "New Task",
  "description": "Task description",
  "due_date": "2024-09-30",
  "priority": "High",
  "user_id": 1,
  "created_at": "2024-09-15T12:34:56.000000Z",
  "updated_at": "2024-09-15T12:34:56.000000Z"
}
Testing:
## 1. Email : rupak.manna99@gmail.com
    password: 12345678
## 2. Email : test@gmail.com
    password: Test@123
## 3. Email : user@gmail.com
    password: User@123

Assumptions & Design Decisions:
The task priority system is simple with three levels: Low, Medium, High.
Only authenticated users can manage their own tasks, ensuring privacy.
The API uses token-based authentication for security, leveraging Laravel Passport.