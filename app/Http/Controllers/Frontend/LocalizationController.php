<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocalizationController extends Controller
{
    //
    private $localeActive = ['en', 'vi'];

    /**
     * Function change locale when route request
     */
    public function changeLocale(Request $request)
    {
        $locale = $request->locale;
        if (in_array($locale, $this->localeActive)) {
            $request->session()->put('locale', $locale);
            return redirect()->back();
        }
        return abort(400);
    }

    /**
     *
     */
    public function getLocale()
    {
        $locale = session('locale', 'en');
        return response()->json([
            'locale' => $locale
        ], 200);
    }

    /**
     *
     */
    public function getUserAuth()
    {
        $user = User::find(Auth::user())->first();
        if (!empty($user)) {
            return response()->json([
                'user' => $user->load(['roles'])
            ], 200);
        }
    }
}
