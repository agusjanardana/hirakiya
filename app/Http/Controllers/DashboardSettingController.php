<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class DashboardSettingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-settings',[
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $user = Auth::user();

        return view('pages.dashboard-account',
            ['user' => $user
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        // check if data has file images , if true save it to storage
        if ($request->hasFile('user_photo')) {
            $data['user_photo'] = $request->file('user_photo')->store('assets/user', 'public');
        }
        $item = Auth::user();
        $item->update($data);

        return redirect()->route($redirect);
    }
}
