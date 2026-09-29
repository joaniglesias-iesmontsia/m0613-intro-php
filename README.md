# PHP MVC & OOP: School Management System

Welcome to this educational project designed for learning **PHP**, **Object-Oriented Programming (OOP)**, and the **Model-View-Controller (MVC)** architectural pattern from the ground up.

---

## 📚 Project Overview

This project demonstrates the transition from a traditional single-file procedural script ("Spaghetti PHP") to a clean, maintainable, and scalable **MVC web application** backed by an **SQLite** database using **PDO**.

---

## 🏗️ Architecture: The MVC Pattern

The application is structured following the **Model-View-Controller** pattern, driven by a **Front Controller** and a **Router**:

```
                       ┌─────────────────────────┐
                       │ Browser / User Request  │
                       └────────────┬────────────┘
                                    │
                                    ▼
                       ┌─────────────────────────┐
                       │ Front Controller        │
                       │ (index.php)             │
                       └────────────┬────────────┘
                                    │ Dispatches via routes.php
                                    ▼
                       ┌─────────────────────────┐
                       │   Router (Router.php)   │
                       └────────────┬────────────┘
                                    │ Calls action (index, edit, save, delete)
                                    ▼
                       ┌─────────────────────────┐
                       │       Controller        │
                       │ (e.g. StudentController)│
                       └──────┬────────────┬─────┘
           Interacts with data│            │ Passes data
                              ▼            ▼
         ┌───────────────────────┐      ┌─────────────────────────┐
         │         Model         │      │          View           │
         │  (e.g. Student.php)   │      │  (views/students/...)   │
         └───────────┬───────────┘      └────────────┬────────────┘
                     │ SQL Queries                   │ Renders HTML
                     ▼                               ▼
         ┌───────────────────────┐      ┌─────────────────────────┐
         │   SQLite Database     │      │   HTTP HTML Response    │
         │    (students.db)      │      │       to Browser        │
         └───────────────────────┘      └─────────────────────────┘
```

### 1. Front Controller (`index.php`)
Every HTTP request enters through `index.php`. It:
* Initializes the database connection (`config/db.php`).
* Loads the route definitions (`routes.php`).
* Passes the requested `controller` and `action` to the `Router`.

### 2. Router (`Router.php` & `routes.php`)
* **`routes.php`**: A declarative map associating route names (`students`, `teachers`) with their respective Controller classes.
* **`Router.php`**: Reads the URL parameters (`?controller=...&action=...`), validates the route, instantiates the controller, and executes the requested action method.

### 3. Models (`models/`)
Models represent the application's data and business entities:
* **`Model.php`**: An abstract base class containing shared CRUD database queries (`all()`, `find()`, `delete()`).
* **`Student.php` & `Teacher.php`**: Concrete models that inherit from `Model` and implement entity-specific logic (`create()`, `update()`).

### 4. Views (`views/`)
Views contain **zero SQL queries and zero business logic**. They are pure HTML presentation templates that receive variables prepared by the controller:
* **`views/layout/`**: Shared layout templates (`header.php`, `footer.php`) containing the HTML skeleton, page title, and navigation menu.
* **`views/students/` & `views/teachers/`**: Entity-specific templates displaying the input form and data table.

### 5. Controllers (`controllers/`)
Controllers act as the coordinator between the Model and the View:
* **`index()`**: Fetches all records from the Model and renders the list with an empty form.
* **`edit()`**: Fetches a single record by `id` from the Model to prefill the form for editing.
* **`save()`**: Reads `POST` data and tells the Model to either `create()` (new) or `update()` (existing).
* **`delete()`**: Reads `id` and instructs the Model to remove the record.

---

## 🧩 Object-Oriented Programming (OOP) Concepts

This project showcases fundamental OOP principles:

### 1. Encapsulation
Database operations and entity data are encapsulated within classes. Instead of raw SQL scattered across presentation files, queries are safely enclosed inside dedicated methods (`$studentModel->create(...)`, `$studentModel->all()`).

### 2. Inheritance & The DRY Principle (Don't Repeat Yourself)
Both `Student` and `Teacher` require identical CRUD operations (`all()`, `find()`, `delete()`). Rather than duplicating this code, both classes extend the abstract `Model` base class:

```php
abstract class Model {
    protected PDO $db;
    protected string $table;
    // Common: all(), find(), delete()...
}

class Student extends Model {
    protected string $table = 'students';
    // Specific: create(), update()
}
```

### 3. Type Declarations (PHP 7.4 / 8+)
Properties, parameters, and return types are strictly typed (e.g. `PDO $db`, `int $id`, `string $name`, `array`) to prevent runtime bugs and improve readability.

---

## 🗄️ Database & Security (SQLite + PDO)

* **SQLite (`students.db`)**: A lightweight, serverless, file-based database stored directly in the project. No separate database server installation is needed.
* **PDO (PHP Data Objects)**: Provides a consistent database abstraction interface.
* **Prepared Statements**: All queries using dynamic user inputs use parameterized placeholders (`:id`, `:name`, `:age`, `:subject`) with `$stmt->prepare()` and `$stmt->execute()`. This protects against **SQL Injection**.

---

## 📂 Project Directory Structure

```text
m0613-intro-php/
├── config/
│   └── db.php                  # SQLite PDO connection & schema creation
├── models/
│   ├── Model.php               # Base Model (shared CRUD operations)
│   ├── Student.php             # Student Model (table: students)
│   └── Teacher.php             # Teacher Model (table: teachers)
├── controllers/
│   ├── StudentController.php   # Student request handler (index, edit, save, delete)
│   └── TeacherController.php   # Teacher request handler (index, edit, save, delete)
├── views/
│   ├── layout/
│   │   ├── header.php          # HTML header, DOCTYPE, and navigation bar
│   │   └── footer.php          # Closing HTML tags
│   ├── students/
│   │   └── index.php           # Student form and table view
│   └── teachers/
│       └── index.php           # Teacher form and table view
├── Router.php                  # Router class (dispatches request to controller)
├── routes.php                  # Route definitions table
├── index.php                   # Front Controller (application entry point)
├── students.db                 # SQLite database file (ignored in git)
├── .gitignore                  # Git ignore rules (*.db, *.sqlite)
└── README.md                   # Project documentation
```

---

## 🚀 How to Run Locally

### 1. Start the PHP Built-in Server
Open your terminal in the project directory and run:

```bash
php -S localhost:8000
```

### 2. Open in your Browser
Navigate to:
```
http://localhost:8000
```

### 3. Available Endpoints
* **Manage Students**: `http://localhost:8000/?controller=students&action=index`
* **Edit Student**: `http://localhost:8000/?controller=students&action=edit&id=1`
* **Manage Teachers**: `http://localhost:8000/?controller=teachers&action=index`
* **Edit Teacher**: `http://localhost:8000/?controller=teachers&action=edit&id=1`

---

## 💡 Key Takeaways for Students

| Concept | Traditional Spaghetti PHP | Modern MVC Pattern |
| :--- | :--- | :--- |
| **Organization** | HTML, SQL, PHP logic mixed in one file | Strict separation: Models (data), Views (UI), Controllers (logic) |
| **Database** | Raw procedural queries | PDO with prepared statements inside Model classes |
| **Routing** | Scattered links to different `.php` files | Centralized Front Controller (`index.php`) and `Router` |
| **Maintenance** | Hard to scale, changes break multiple parts | Modular: modifying UI does not affect database queries |