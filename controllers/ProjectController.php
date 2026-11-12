<?php
// ==============================================================================
// Project Controller (C in MVC)
// ==============================================================================

require_once dirname(__DIR__) . '/models/Project.php';

class ProjectController {
    private Project $model;

    public function __construct(PDO $db) {
        $this->model = new Project($db);
    }

    // List all projects
    public function index(): void {
        $edit_id   = "";
        $edit_name = "";
        $edit_description = "";

        $projects = $this->model->all();
        $pageTitle = "Projects Management";

        // Render Views
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/projects/index.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    // Load project to be edited
    public function edit(): void {
        $edit_id   = "";
        $edit_name = "";
        $edit_description = "";

        if (isset($_GET['id'])) {
            $project = $this->model->find((int)$_GET['id']);
            if ($project) {
                $edit_id   = $project['id'];
                $edit_name = $project['name'];
                $edit_description = $project['description'];
            }
        }

        $projects = $this->model->all();
        $pageTitle = "Edit Projects";

        // Render Views
        require_once dirname(__DIR__) . '/views/layout/header.php';
        require_once dirname(__DIR__) . '/views/projects/index.php';
        require_once dirname(__DIR__) . '/views/layout/footer.php';
    }

    // Handle Create and Update POST requests
    public function save(): void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id   = $_POST['id'] ?? '';
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if ($id !== "") {
                $this->model->update((int)$id, $name, $description);
            } else {
                $this->model->create($name, $description);
            }
        }

        header("Location: index.php?controller=projects&action=index");
        exit;
    }

    // Handle Delete request
    public function delete(): void {
        if (isset($_GET['id'])) {
            $this->model->delete((int)$_GET['id']);
        }

        header("Location: index.php?controller=projects&action=index");
        exit;
    }
}
