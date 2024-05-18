<?php

namespace App\Service\Impl;

use App\Service\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{


    public function saveTodo(string $todo): void
    {
        if (!Session::exists('todolist')) {
            Session::put("todolist", []);
        }

        $id = sizeof($this->getTodolist()) + 1;

        Session::push("todolist", [
            'id' => $id,
            'todo' => $todo
        ]);
    }

    public function getTodolist(): array
    {
        return Session::get('todolist', []);
    }

    public function removeTodolist(string $todoId)
    {
        $todoId = intval($todoId);
        $todolist = Session::get('todolist');

        foreach ($todolist as $index => $value) {
            if (intval($value['id']) == $todoId) {
                unset($todolist[$index]);
                break;
            }
        }

        foreach ($todolist as $index => $value) {


            if (intval($value['id']) > $todoId) {
                $todolist[$index]['id'] = intval($value['id']) - 1;
            }
        }

        $todolist = array_values($todolist);

        Session::put("todolist", $todolist);
    }
}
