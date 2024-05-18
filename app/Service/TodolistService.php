<?php

namespace App\Service;

interface TodolistService
{
    public function saveTodo(string $todo) : void;

    public function getTodolist():array;

    public function removeTodolist(string $todoId);

}
