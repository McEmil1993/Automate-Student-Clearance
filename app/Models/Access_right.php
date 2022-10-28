<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_right extends Model
{
    protected $fillable = [ 'type', 'access_right', 'row','all', 'add', 'update', 'delete'];
}
