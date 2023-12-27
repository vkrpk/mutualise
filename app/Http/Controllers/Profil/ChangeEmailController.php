<?php
namespace App\Http\Controllers\Profil;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailChangeNotification;

class ChangeEmailController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Email Change Controller
    |--------------------------------------------------------------------------
    |
    | This controller allows the user to change his email address after he
    | verifies it through a message delivered to the enew email address.
    | This uses a temporarily signed url to validate the email change.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Only the authenticated user can change its email, but he should be able
        // to verify his email address using other device without having to be
        // authenticated. This happens a lot when they confirm by phone.
        $this->middleware('auth')->only('change');

        // A signed URL will prevent anyone except the User to change his email.
        $this->middleware('signed')->only('verify');
    }

    /**
     * Changes the user Email Address for a new one
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|current_password'
        ], [
            'required' => 'Champ requis',
            'email' => 'Le format d\'email n\'est pas valide',
            'unique' => 'L\'adresse email est déjà utilisée',
            'current_password' => 'Le mot de passe ne correspond pas'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Send the email to the user
        Notification::route('mail', $request->email)
            ->notify(new EmailChangeNotification(Auth::user()->id));

        // Return the view
        back()->with([
            'email_changed' => $request->email
        ]);
        return response()->json(['passwordAndEmail' => true]);
    }

    /**
     * Verifies and completes the Email change
     *
     * @param Request $request
     * @param string $email
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $user = User::where('id', $request->query->get('user'))->first();
        $request->validate([
            'email' => 'required|email|unique:users'
        ]);

        // Change the Email
        $user->update([
            'email' => $request->email
        ]);

        // And finally return the view telling the change has been done
        return redirect()->route('profilSecurity')->with('status', 'Votre changement d\'email a bien été pris en compte !');
    }
}
