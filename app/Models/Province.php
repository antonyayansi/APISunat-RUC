<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $with = ['districts'];
    public $incrementing = false;
    public $timestamps = false;

    static function idByDescription($description)
    {
        $province = Province::where('description', $description)->first();
        if ($province) {
            return $province->id;
        }
        return '1501';
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
