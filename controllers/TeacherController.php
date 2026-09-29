<?php
// ==============================================================================
// Teacher Controller (C in MVC)
// ==============================================================================

require_once dirname(__DIR__) . '/models/Teacher.php';

class TeacherController {
    private Teacher $model;

    public function __construct(PDO $db) {
        $this->model = new Teacher($db);
    }

    // List all teachers
    public function index(): void {
        $edit_id      = "";
        $edit_name    = "";
        $edit_subject = "";

        $teachers = $this->model->all();
        $pageTitle = "Teachers Management";

        // Render Views
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/teachers/index.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    // Load teacher to be edited
    public function edit(): void {
        $edit_id      = "";
        $edit_name    = "";
        $edit_subject = "";

        if (isset($_GET['id'])) {
            $teacher = $this->model->find((int)$_GET['id']);
            if ($teacher) {
                $edit_id      = $teacher['id'];
                $edit_name    = $teacher['name'];
                $edit_subject = $teacher['subject'];
            }
        }

        $teachers = $this->model->all();
        $pageTitle = "Edit Teacher";

        // Render Views
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/teachers/index.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    // Handle Create and Update POST requests
    public function save(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id      = $_POST['id'] ?? '';
            $name    = trim($_POST['name'] ?? '');
            $subject = trim($_POST['subject'] ?? '');

            if ($id !== "") {
                $this->model->update((int)$id, $name, $subject);
            } else {
                $this->model->create($name, $subject);
            }
        }

        header("Location: index.php?controller=teachers&action=index");
        exit;
    }

    // Handle Delete request
    public function delete(): void {
        if (isset($_GET['id'])) {
            $this->model->delete((int)$_GET['id']);
        }

        header("Location: index.php?controller=teachers&action=index");
        exit;
    }
}
