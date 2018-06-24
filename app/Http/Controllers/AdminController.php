<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\AdminMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     * Require a logged in user
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get data for all registered users
     * Pass user data to admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $users = User::all();

        return view('admin', compact('users'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendMail(Request $request, $id) {

        // Get email body from Request
        $emailBody = $request->emailBody;

        // Find user the mail is addressed to
        $user = User::find($id);

        // Pass mail data to AdminMail
        Mail::to($user)->send(new AdminMail($emailBody));

        return redirect('admin');
    }
}
