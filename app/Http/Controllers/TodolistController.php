<?php

namespace App\Http\Controllers;

use App\Service\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    /**
     * @param TodolistService $todolistService
     */
    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }


    public function todolist()
    {
        $todolist = $this->todolistService->getTodolist();

        return view('welcome', [
            'todolist' => $todolist
        ]);


    }

    public function createTodolist(Request $request)
    {
        $todo = $request->input('todo');
        $todolist = $this->todolistService->getTodolist();
        if (empty($todo)) {
            return response()->view('welcome', [
                'todolist' => $todolist,
                'error' => 'Todo is Required'
            ]);
        }

        $this->todolistService->saveTodo($todo);
        return redirect()->action([TodolistController::class,'todolist']);

    }

    public function removeTodolist(string $todoId)
    {
        $this->todolistService->removeTodolist($todoId);
        return redirect()->action([TodolistController::class,'todolist']);


    }
}
