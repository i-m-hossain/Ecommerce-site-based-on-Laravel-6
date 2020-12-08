<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Model\Admin\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        return $this->middleware('auth:admin');
    }
    public function index()
    {
        //
        $subs = Newsletter::all();
        return view('admin.auth.newsletter.newsletter',compact('subs'));
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
        $request->validate([
           'email' =>'required| unique:newsletters|max:55'
        ]);
        $newslet = new Newsletter();
        $newslet->email = $request->email;
        $newslet->save();
        return redirect()->back()->with(['message'=>'Thanks for subscribbing to our newsletter', 'alert-type'=>'success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Newsletter::find($id)->delete();
        return redirect()->back()->with(['message'=>'subscriber is deleted', 'alert-type'=>'success']);
    }
}
