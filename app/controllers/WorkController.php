<?php

class WorkController extends Controller
{
    private $work;
    private $router;

    function __construct($router)
    {
        $this->work = $this->model("WorkModel");
        $this->router = $router;
    }

    function index()
    {
        // echo $this->getRouter()->route('work.index');
        // Call Models
        $works = $this->work->getWork();
        // $router = $this->router;
        // Call Views
        $this->view("index", compact('works'));
    }

    function create()
    {
        $this->view("create");
    }

    function store()
    {
        if (isset($_POST)) {

            $data = $_POST;

            // Validate and sanitize data
            // ...

            $this->work->create($data);

            header('Location: ' . $this->router->route('work.index'));
            exit();
        }
    }

    function edit($id)
    {
        $work = $this->work->findOrFail($id);
        if (count($work) > 0) {
            return $this->view("edit", compact('work'));
        }

        http_response_code(404);
        echo "Page not found.";
        return;
    }

    function update($id)
    {
        // Get POST data
        if (isset($_POST)) {

            $data = $_POST;

            // Validate and sanitize data
            // ...

            $this->work->update($data, $id);
            header('Location: ' . $this->router->route('work.index'));
            exit();
        }
    }

    function destroy($id)
    {
        $this->work->delete($id);

        header('Location: ' . $this->router->route('work.index'));
        exit();
    }
}
