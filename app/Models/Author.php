<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name', 'bio', 'date_of_birth', 'nationality']; //allowed fields to be inserted or updated
}
