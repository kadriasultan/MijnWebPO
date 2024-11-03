<!--peojectController -->
<?php
require_once 'db.php';
require_once 'models/Project.php';

//class
class ProjectController {
    private $projectModel;

    public function __construct($pdo) {
        $this->projectModel = new Project($pdo);
    }

    public function index() {
        $projects = $this->projectModel->getAllProjects();
        include 'views/projects.view.php';
    }

    public function add() {
        include 'views/add_project.view.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $url = $_POST['url'];

            if ($this->projectModel->addProject($name, $description, $url)) {
                echo "Project succesvol toegevoegd!";
            } else {
                echo "Er was een fout bij het toevoegen van het project.";
            }
        }
    }
}
?>
