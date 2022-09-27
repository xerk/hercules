<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Models\CardCode;
use App\Models\PointLog;
use Illuminate\Http\Request;
use App\Notifications\PurchasePoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard/Purchase/Show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function redeem(Request $request)
    {
        Validator::make($request->all(), [
            'code' => ['required', 'min:60', 'max:60'],
        ])->validateWithBag('redeemCode');

        $card = CardCode::where('code', $request->code)->first();
        if ($card && $card->expire_date >= Carbon::now()) {
            $user = User::find(Auth::id());

            $user->point = $user->point + $card->amount;
            
            $user->save();

            $user->notify(new PurchasePoint($card->amount));

            $pointLog = PointLog::create([
                'log' => 'The user has been Redeem code',
                'point' => '+' . $card->amount,
                'user_id' => $user->id,
                'status' => 'succeed',
            ]);

            $card->delete();
        } else {
            return back()->withErrors([
                'message' => 'Token is invalide or expired, please try again.',
            ]);
        }
        return Redirect::route('purchase')->with('success', 'Redeem successfully.');
    }
}
