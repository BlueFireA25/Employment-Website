<?php

namespace App\Models;

use App\Models\User;
use App\Models\Salary;
use App\Models\Category;
use App\Models\Location;
use App\Models\Candidate;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacant extends Model
{
    protected $fillable = [
        'title', 'image', 'description', 'skills', 'category_id', 'experience_id', 'location_id', 'salary_id'
    ];

    // Relation 1:1 Category and Vacant
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation 1:1 Salary and Vacant
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    // Relation 1:1 Location and Vacant
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Relation 1:1 Experience and Vacant
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    // Relation 1:1 Recruiter and Vacant
    public function recruiter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation 1:n Vacant and Candidates
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
