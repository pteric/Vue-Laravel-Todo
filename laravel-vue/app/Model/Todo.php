<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todo_item';
    protected $primaryKey = 'id';
}
