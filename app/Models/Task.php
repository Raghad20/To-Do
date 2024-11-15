<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=['title','description','type_id'];
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'task_user')->withPivot('is_done', 'due_date');
    }
}
