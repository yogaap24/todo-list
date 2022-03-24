<?php

namespace App\Service\TodoList;

use App\Models\Table\TodoListTable;
use App\Service\AppService;
use Yajra\DataTables\Facades\DataTables;

class TodoListService extends AppService
{
    public function __construct(TodoListTable $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        $result = $this->model->query()->where('user_id',\auth()->user()->id);
        return DataTables::eloquent($result)->toJson();
    }

    public function getPaginated($search = null, $perPage = 15)
    {
        // TODO: Implement getPaginated() method.
    }

    public function getById($id)
    {
        $result =   $this->model->newQuery()->find($id);

        return $this->sendSuccess($result);
    }

    public function create($data)
    {
        \DB::beginTransaction();

        try {
            $result = [];
            if (!empty($data)) {
                // dd(array_map('array_filter', $data)); die;
                $data = array_map('array_filter', $data);
                foreach ($data['title'] as $key => $todoList) {
                    // dd($todoList); die;
                    $order = $this->model->newQuery()->create([
                        'title'             =>  $todoList,
                        'description'       =>  $data['description'][$key],
                        'due_date'          =>  $data['due_date'][$key],
                        'completed'         =>  false,
                        'user_id'           =>  auth()->user()->id,
                    ]);
                    $result[]   =   $order;
                }
            }

            \DB::commit(); // commit the changes
            return $this->sendSuccess($result,'success');
        } catch (\Exception $exception) {
            \DB::rollBack(); // rollback the changes
            return $this->sendError(null, $this->debug ? $exception->getMessage() : null);
        }
    }

    public function update($id, $data)
    {
        $read   =   $this->model->newQuery()->find($id);
        \DB::beginTransaction();
        // dd($read, $data); die;

        try {

            $read->title         =   $data['title'];
            $read->description   =   $data['description'];
            $read->due_date      =   $data['due_date'];

            $read->save();

            \DB::commit(); // commit the changes
            return $this->sendSuccess($read);
        } catch (\Exception $exception) {
            \DB::rollBack(); // rollback the changes
            return $this->sendError(null, $this->debug ? $exception->getMessage() : null);
        }
    }

    public function delete($id)
    {
        $driver   =   $this->model->newQuery()->find($id);
        // dd($driver); die;
        try {

            $driver->delete();

            \DB::commit(); // commit the changes

            return $this->sendSuccess($driver);
        } catch (\Exception $exception) {
            \DB::rollBack(); // rollback the changes
            return $this->sendError(null, $this->debug ? $exception->getMessage() : null);
        }
    }

    public function verify($id)
    {
        try {

            \DB::beginTransaction();

            $detailTodoList = $this->model->newQuery()
                                        ->where('id',$id)
                                        ->where('completed', false)
                                        ->first();

            $detailTodoList->completed = true;
            $detailTodoList->save();

            \DB::commit();
            return $this->sendSuccess($detailTodoList);

        } catch (\Exception $exception) {
            \DB::rollBack(); // rollback the changes
            return $this->sendError(null, $this->debug ? $exception->getMessage() : null);
        }
    }
}
