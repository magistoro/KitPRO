<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];
    
    
    public static function getAdminRoleID(){
        return self::where('name', 'admin')->first()->id;
    } 
    public static function getManagerRoleID(){
        return self::where('name', 'manager')->first()->id;
    } 
    public static function getUserRoleID(){
        return self::where('name', 'user')->first()->id;
    }

    public function products():HasMany
    {
        return $this->hasMany(User::class);
    }


}
