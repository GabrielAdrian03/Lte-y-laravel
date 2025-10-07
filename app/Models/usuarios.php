<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

//class usuarios extends Model
//{
//    use HasFactory;
//}

class User extends Authenticatable
{
    use HasRoles;

    // ...
}