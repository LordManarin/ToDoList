<?php
namespace Source\Domain\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Task extends Eloquent{
    public $timestamps = false;
    protected $table = 'tasks';
    protected $fillable = [
        "id",
        "user_id",
        "task",
        "description",
        "done"
    ];
}