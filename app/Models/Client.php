<?php

namespace App\Models;

use Carbon\Carbon;
use App\Casts\Serialize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unique_id', 'mobile', 'nationality', 'gender', 'email', 'name', 'username', 'religion', 'birthday', 'work', 'position', 'hometown', 'location', 'education', 'relationship'
    ];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'unique_id' => Serialize::class,
        // 'mobile' => Serialize::class,
    ];

    /**
     * The clients that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('group', 'data_group_id');
    }

    public function scopeSearch($query, $request) {
        if (isset($request['username'])) {
            $query->where('unique_id', $request->username)
                    ->orWhere('username', $request->username)
                    ->orWhere('mobile', $request->username);
        }
    }

    public function scopeFilter($query, $request) {

        // Find Relationships ex: Single
        if (isset($request['relationship'])) {
            if ($request['relationship'] != 'all') {
                $query->where('relationship', $request['relationship']);
            }
        }

        // Find Country ex: egypt
        if (isset($request['country'])) {
            if ($request['country'] != 'all') {
                $query->where('nationality', $request['country']);
            }
        }

        // Find Gender ['male', 'female', 'other']
        if (isset($request['gender'])) {
            if ($request['gender'] != 'all') {
                $query->where('gender', $request['gender']);
            }
        }

        // Only has email
        if ($request['existEmail']) {
            $query->whereNotNull('email')->where('email', '<>', '');
        }

        // Only has mobile
        if ($request['existMobile']) {
            $query->whereNotNull('mobile')->where('mobile', '<>', '');
        }

        // Only has Username
        if ($request['existUsername']) {
            $query->whereNotNull('username')->where('username', '<>', '');
        }

        // Find array of relations
        if (isset($request['religions'])) {
            $query->where(function($q) use ($request) {
                foreach($request['religions'] as $key => $religion) {
                    if($key == 0) {
                        // $q->where('religion',  'like', '%' . $religion['text'] . '%');
                        $q->where('religion', $religion['text']);
                    } else {
                        $q->orWhere('religion', $religion['text']);
                    }
                }
            });
        }

        // Find array of works
        if (isset($request['works'])) {
            $query->where(function($q) use ($request) {
                foreach($request['works'] as $key => $work) {
                    if($key == 0) {
                        $q->where('work', $work['text']);
                    } else {
                        $q->orWhere('work', $work['text']);
                    }
                }
            });
        }

        // Find array of positions
        if (isset($request['positions'])) {
            $query->where(function($q) use ($request) {
                foreach($request['positions'] as $key => $position) {
                    if($key == 0) {
                        $q->where('position', $position['text']);
                    } else {
                        $q->orWhere('position', $position['text']);
                    }
                }
            });
        }

        // Find array of hometowns
        if (isset($request['hometowns'])) {
            $query->where(function($q) use($request) {
                foreach($request['hometowns'] as $key => $hometown) {
                    if($key == 0) {
                        $q->where('hometown', $hometown['text']);
                    } else {
                        $q->orWhere('hometown', $hometown['text']);
                    }
                }
            });
        }

        // Find array of locations
        if (isset($request['locations'])) {
            $query->where(function($q) use ($request) {
                foreach($request['locations'] as $key => $location) {
                    if($key == 0) {
                        $q->where('location', $location['text']);
                    } else {
                        $q->orWhere('location', $location['text']);
                    }
                }
            });
        }

        // Find array of educations
        if (isset($request['educations'])) {
            $query->where(function($q) use ($request) {
            foreach($request['educations'] as $key => $education) {
                    if($key == 0) {
                        $q->where('education', $education['text']);
                    } else {
                        $q->orWhere('education', $education['text']);
                    }
                }
            });
        }

    }
}
