<?php

namespace App\Http\Controllers\Datatable\TodoList;

use App\Http\Controllers\Controller;
use App\Service\TodoList\TodoListService;

class TodoListController extends Controller
{
    protected $todoListService;

    /**
     * @param TodoList $todoListService
     */
    public function __construct(TodoListService $todoListService)
    {
        $this->todoListService = $todoListService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return $this->todoListService->getAll();
    }
}
