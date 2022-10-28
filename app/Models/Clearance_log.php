<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance_log extends Model
{
    protected $fillable = ['student_id', 'school_year','sem', 'assignee_id','clearance_status'];
}
