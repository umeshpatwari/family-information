<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FamilyMember;

class Family extends Model
{
    use HasFactory;
    protected $table = 'families';
    protected $fillable = ['id','name', 'surname', 'birthdate','mobile_no', 'address', 'state', 'city', 'pincode','marital_status','wedding_date','hobbies','photo'];

    public $timestamps = false;

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }
}
