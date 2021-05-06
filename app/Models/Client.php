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
        return $this->belongsToMany(User::class)->withPivot('group');;
    }

    public function scopeFilter($query, $request) {

        if ($request->filled('religion')) {
            $query->where('religion',  'like', '%' . $request->religion . '%');
        }

        if ($request->filled('country')) {
            if ($request->country != 'all') {
                $query->where('nationality', $request->country);
            }
        }

        if ($request->filled('gender')) {
            if ($request->gender != 'all') {
                $query->where('gender', $request->gender);
            }
        }

        if ($request->filled('relationship')) {
            if ($request->relationship != 'all') {
                $query->where('relationship', $request->relationship);
            }
        }

        if ($request->filled('work')) {
            $query->where('work',  'like', '%' . $request->work . '%');
        }

        if ($request->filled('position')) {
            $query->where('position',  'like', '%' . $request->position . '%');
        }

        if ($request->filled('hometown')) {
            $query->where('hometown', 'like', '%' . $request->hometown . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('education')) {
            $query->where('education', 'like', '%' . $request->education . '%');
        }

        if ($request->filled('birthdate')) {
            if ($request->birthdateFrom != 'all' && $request->birthdateTo != 'all') {
                $from = Carbon::now()->subYears($request->birthdateFrom)->format('d-m-Y');
                $to = Carbon::now()->subYears($request->birthdateTo)->format('d-m-Y');
                $query->whereBetween('birthday', [$from, $to]);
            }
        }

        if ($request->existEmail) {
            $query->whereNotNull('email')->where('email', '<>', '');
        }

        if ($request->existMobile) {
            $query->whereNotNull('mobile')->where('mobile', '<>', '');
        }

        if ($request->existUsername) {
            $query->whereNotNull('username')->where('username', '<>', '');
        }

    }
}
