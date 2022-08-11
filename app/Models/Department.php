<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $with = ['provinces'];
    public $incrementing = false;
    public $timestamps = false;

    static function idByDescription($description)
    {
        $department = Department::where('description', $description)->first();
        if ($department) {
            return $department->id;
        }
        return '15';
    }

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

}
