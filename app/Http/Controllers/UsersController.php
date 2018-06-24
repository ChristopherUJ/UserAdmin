<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Non admin users only have access to their own use properties
        $user = Auth::user();

        // Admin users have access to other user's properties
        // User id sent from admin page
        if (auth()->user()->isAdmin()) {
            $user = User::find($id);
        }

        // Get profile image from request data
        $profile_image = $request->file('profile');

        // Check if an image has been uploaded
        // Store the image if it has been uploaded
        if (!is_null($profile_image)) {
            $user->profile = $request->profile->store('/img/profile');
            // Add storage directory to path
            $user->profile = 'storage/' . $user->profile;
        }

        // Update the rest of the user's data
        $user->company = $request->input('company');
        $user->name_first = $request->input('name_first');
        $user->name_last = $request->input('name_last');
        $user->telNum = $request->input('telNum');
        $user->email = $request->input('email');

        // Save updated data
        $user->save();

        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Check that user is an Admin user
        // User id sent from admin page
        if (auth()->user()->isAdmin()) {
            $user = User::find($id);
        }

        // Delete specified user
        $user->delete();

        return redirect('admin');
    }
}
