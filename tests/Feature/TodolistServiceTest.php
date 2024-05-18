<?php

namespace Tests\Feature;

use App\Service\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);

    }

    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistService);

    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo(1, "Farhan");

        $todolist = Session::get('todolist');

        foreach ($todolist as $value) {
            self::assertEquals($value['id'], 1);
            self::assertEquals($value['todo'], "Farhan");
        }

    }

    public function testgetTodoEmpty()
    {
        $todolist = $this->todolistService->getTodolist();

        self::assertEquals($todolist, []);

    }

    public function testgetTodoNotEmpty()
    {
        $this->todolistService->saveTodo( "Farhan");
        $getTodo = $this->todolistService->getTodolist();

        $expected = [
            ['id' => 1, 'todo' => 'Farhan']
        ];

        self::assertEquals($getTodo, $expected);

    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo('Farhan');
        $this->todolistService->saveTodo('Septiansyah');




        $this->todolistService->removeTodolist("3");
        assertEquals(2,sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist(2);
        assertEquals(1,sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodolist(1);
        assertEquals(0,sizeof($this->todolistService->getTodolist()));



    }


}
