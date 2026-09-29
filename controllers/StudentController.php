<?php
// ==============================================================================
// Student Controller (C in MVC)
// ==============================================================================

require_once dirname(__DIR__) . '/models/Student.php';

class StudentController {
    private Student $model;

    public function __construct(PDO $db) {
        $this->model = new Student($db);
    }

    // List all students
    public function index(): void {
        $edit_id   = "";
        $edit_name = "";
        $edit_age  = "";

        $students = $this->model->all();
        $pageTitle = "Students Management";

        // Render Views
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/students/index.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    // Load student to be edited
    public function edit(): void {
        $edit_id   = "";
        $edit_name = "";
        $edit_age  = "";

        if (isset($_GET['id'])) {
            $student = $this->model->find((int)$_GET['id']);
            if ($student) {
                $edit_id   = $student['id'];
                $edit_name = $student['name'];
                $edit_age  = $student['age'];
            }
        }

        $students = $this->model->all();
        $pageTitle = "Edit Student";

        // Render Views
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/students/index.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    // Handle Create and Update POST requests
    public function save(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id   = $_POST['id'] ?? '';
            $name = trim($_POST['name'] ?? '');
            $age  = (int)($_POST['age'] ?? 0);

            if ($id !== "") {
                $this->model->update((int)$id, $name, $age);
            } else {
                $this->model->create($name, $age);
            }
        }

        header("Location: index.php?controller=students&action=index");
        exit;
    }

    // Handle Delete request
    public function delete(): void {
        if (isset($_GET['id'])) {
            $this->model->delete((int)$_GET['id']);
        }

        header("Location: index.php?controller=students&action=index");
        exit;
    }
}
