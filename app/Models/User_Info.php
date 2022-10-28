<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    protected $fillable = [ 'user_id', 'prefix', 'firstname', 'middlename', 'lastname', 'suffix', 'contact', 'address'];
    // `user_id`, `prefix`, `firstname`, `middlename`, `lastname`, `suffix`, `contact`, `address`
}
