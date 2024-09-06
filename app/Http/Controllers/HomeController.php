<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::id());

        Log::info('User role: ' . $user->role);

        if ($user->isAdmin()) {
            Log::info('User is admin');
            return redirect()->route('admin.dashboard');
        } elseif ($user->isUser()) {
            Log::info('User is user');
            return redirect()->route('user.dashboard');
        }

        Log::info('User role not recognized');
        return redirect('/home'); // Redirect default jika role tidak sesuai
    }
}
