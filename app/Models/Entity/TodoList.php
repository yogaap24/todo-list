<?php

namespace App\Models\Entity;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoList extends AppModel
{
    use SoftDeletes;

    protected $table       = 'todo_lists';

    protected $fillable    =   [
        'user_id',
        'title',
        'description',
        'due_date',
        'completed',
    ];
}
