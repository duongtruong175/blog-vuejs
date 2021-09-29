<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LocalizationController extends Controller
{
    //
    private $localeActive = ['en', 'vi'];

    /**
     * Function change locale when route request
     */
    public function changeLocale(Request $request, $locale)
    {
        if (in_array($locale, $this->localeActive)) {
            $request->session()->put('locale', $locale);
            return redirect()->back();
        }
        return abort(400);
    }

    /**
     * Function change locale when route request
     */
    public function changeLocaleApi(Request $request, $locale)
    {
        if (in_array($locale, $this->localeActive)) {
            $request->session()->put('locale', $locale);
            return response()->json([
                'locale' => $locale
            ], 200);
        }
        return response()->json([
            'message' => 'The given data was not valid.'
        ], 404);
    }
}
