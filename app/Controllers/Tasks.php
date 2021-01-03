<?php

namespace App\Controllers;

use App\Models\TasksModel;

use \App\Entities\Task;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{

    private $model;

    private $user;

    public function __construct()
    {
        $this->model = new TasksModel();

        $this->user = service('auth')->getCurrentUser();
    }

    public function index()
    {
        $data = $this->model->getTasksByUserId($this->user->id);

        return view('Tasks/index', [
            "tasks" => $data,
            'pages' => $this->model->pager
        ]);
    }

    public function show($id)
    {
        $data = $this->getTaskOr404($id);

        return view("Tasks/show", [
            'task' => $data,
        ]);
    }

    public function new()
    {
        $task = new Task();

        return view("Tasks/new", [
            'task' => $task
        ]);
    }

    public function create()
    {
        $task = new Task(esc($this->request->getPost()));

        $task->user_id = $this->user->id;

        if ($this->model->insert($task)) {
            return redirect()
                ->back()
                ->with("info", "Task has been added");
        } else {
            return redirect()
                ->back()
                ->with("errors", $this->model->errors())
                ->with("warning", "Invalid data")
                ->withInput();
        }
    }

    public function edit($id)
    {
        $data = $this->getTaskOr404($id);

        return view("Tasks/edit", [
            'task' => $data
        ]);
    }

    public function update($id)
    {
        $task = $this->getTaskOr404($id);

        $post = esc($this->request->getPost());

        unset($post['user_id']);

        $task->fill($post);

        if (!($task->hasChanged())) {

            return redirect()
                ->back()
                ->with("errors", $this->model->errors())
                ->with("warning", "Nothing to update")
                ->withInput();
        }

        if ($this->model->save($task)) {
            return redirect()->back()->with('info', "record has been updated");
        } else {
            return redirect()->back()->with('warning', "Invalid data")->withInput();
        }
    }

    public function delete($id)
    {
        $task = $this->getTaskOr404($id);

        if ($this->request->getMethod() == "post") {

            $this->model->delete($id);

            return redirect()->to('/tasks')->with('info', 'task has been deleted');
        }

        return view("Tasks/delete", [
            'task' => $task
        ]);
    }

    public function search()
    {
        $tasks = $this->model->search($this->request->getGet("q"), $this->user->id);

        return $this->response->setJSON($tasks);
    }

    public function getTaskOr404($id)
    {
        $task = $this->model->getTaskByUserId($id, $this->user->id);

        if ($task == null) {
            throw new PageNotFoundException("Task with id: {$id} Not Found");
        }

        return $task;
    }
}
