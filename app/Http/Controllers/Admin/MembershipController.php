<?php

namespace App\Http\Controllers\Admin;

use App\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\MembershipTotal;
use App\User;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.membership', ['users' => User::with('membership')->has('membership')->orderBy('birth_date')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    public function updateTotal(Request $request)
    {
        Membership::query()->update(['total' => $request->total]);
        return redirect()->route('membership.index');
    }

    public function updateAll(Request $request)
    {
        foreach ($request->players as $id => $data) {
            $membership = Membership::where('player_id', $id)->take(1)->first();
            $membership->amount = $data['amount'];
            $membership->note = $data['note'];
            $membership->total = $data['total'];
            $membership->save();
        }
        return redirect()->route('membership.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
