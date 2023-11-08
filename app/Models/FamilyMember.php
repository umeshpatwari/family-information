<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Family;

class FamilyMember extends Model
{
    use HasFactory;
    protected $table = 'family_members';
    protected $fillable = ['id','family_id','name', 'birthdate', 'birthdate','marital_status','wedding_date','education','photo'];

    public $timestamps = false;

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
