<?php 

namespace TodoApp\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $connection = 'tenant_database';

    protected $table = 'todos';

    protected $primaryKey = 'todo_id';

    protected $fillable = ['body', 'completed', 'created_by', 'updated_by'];
}