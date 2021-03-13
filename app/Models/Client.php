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
        'unique_id', 'mobile', 'nationality'
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

    public function scopeFilter($query, $request) {

        if ($request->filled('religion')) {
            $query->where('religion', $request->religion);
        }

        if ($request->filled('country')) {
            if ($request->counter != 'all') {
                $query->where('nationality', $request->country);
            }
        }

        if ($request->filled('gender')) {
            if ($request->gender != 'all') {
                $query->where('gender', $request->gender);
            }
        }

        if ($request->filled('relationship')) {
            if ($request->gender != 'all') {
                $query->where('relationship', $request->relationship);
            }
        }

        if ($request->filled('work')) {
            $query->where('work', $request->work);
        }

        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        if ($request->filled('hometown')) {
            $query->where('hometown', $request->hometown);
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('birthdate')) {
            if ($request->birthdate != 'all') {
                $from = Carbon::now()->subYears($request->birthdate[0])->format('d-m-Y');
                $to = Carbon::now()->subYears($request->birthdate[1])->format('d-m-Y');
                $query->whereBetween('birthday', [$from, $to]);
            }
        }

    }
}
