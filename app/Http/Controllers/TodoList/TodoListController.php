<?php

namespace App\Http\Controllers\TodoList;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Service\TodoList\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends ApiController
{
    protected $todoListService;

    public function __construct(
        TodoListService $todoListService,
        Request $request)
    {
        $this->todoListService    =   $todoListService;
        parent::__construct($request);
    }

    public function index()
    {
        return view("todoList.index");
    }

    public function show($id)
    {
        $result =   $this->todoListService->getById($id);

        try {
            if ($result->success) {
                $response = $result->data;
                return $this->sendSuccess($response, $result->message, $result->code);
            }

            return $this->sendError($result->data, $result->message, $result->code);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(),"",500);
        }
    }

    public function store(Request $request)
    {
        $input  =   $request->all();
        $result =   $this->todoListService->create($input);

        try {
            if ($result->success) {
                $response = $result->data;
                return $this->sendSuccess($response, $result->message, $result->code);
            }

            return $this->sendError($result->data, $result->message, $result->code);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(),"",500);
        }
    }

    public function update(Request $request)
    {
        $input  =   $request->all();
        $result =   $this->todoListService->update($input['id'],$input);

        try {
            if ($result->success) {
                $response = $result->data;
                return $this->sendSuccess($response, $result->message, $result->code);
            }

            return $this->sendError($result->data, $result->message, $result->code);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(),"",500);
        }
    }

    public function destroy($id)
    {
        $result =   $this->todoListService->delete($id);

        try {
            if ($result->success) {
                $response = $result->data;
                return $this->sendSuccess($response, $result->message, $result->code);
            }

            return $this->sendError($result->data, $result->message, $result->code);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(),"",500);
        }
    }

    public function verify($id)
    {
        $result = $this->todoListService->verify($id);
        try {
            if ($result->success) {
                $response = $result->data;
                return $this->sendSuccess($response, $result->message, $result->code);
            }

            return $this->sendError($result->data, $result->message, $result->code);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage(),"",500);
        }
    }
}
