<?php

namespace App\Http\Controllers;

use App\Models\RestoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function home()
    {
        $destinations = RestoList::all();
        return view('home', compact('destinations'));
    }

    public function success_review()
    {
        return view('success_review');
    }

    public function search(Request $req)
    {
        $req->validate(['search' => 'required']);
        $searchResults = RestoList::where('title', 'like', '%' . $req->search . '%')->get();
        return view('search_results', [
            'search' => $req->search,
            'searchResults' => $searchResults,
        ]);
    }

    public function resetPassword()
    {
        return view('auth.passwords.reset');
    }

    public function profile(Request $req)
    {
        $destination = RestoList::first();
        return view('profile', compact('destination'));
    }



    public function editProfile(Request $req)
    {
        $user = Auth::user();

        if ($user->is_resto) {
            $req->validate([
                'description' => 'required|string|min:3',
                'range' => 'required|string|min:3',
                'maps' => 'required|string|min:3',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'menu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $destination = RestoList::where('user_id', $user->id)->firstOrFail();

            $data = $req->only(['description', 'range', 'maos']);

            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $filename);


                if (Storage::exists('public/images/' . $destination->image)) {
                    Storage::delete('public/images/' . $destination->image);
                }
                $data['image'] = $filename;
            }

            if ($req->hasFile('menu')) {
                $file = $req->file('menu');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $filename);

                if (Storage::exists('public/images/' . $destination->menu)) {
                    Storage::delete('public/images/' . $destination->menu);
                }

                $data['menu'] = $filename;
            }
            $destination->update($data);

            return redirect('/my-profile')->with('status', 'Profil berhasil diubah');
        } else {
            $req->validate([
                'name' => 'required|string|min:3',
                'email' => 'required|string|min:3|unique:users,email,' . $user->id,
                'phone_number' => 'required|numeric|digits_between:5,15',
                'address' => 'required|string'
            ]);

            $user->update([
                'name' => $req->name,
                'email' => $req->email,
                'phone_number' => $req->phone_number,
                'address' => $req->address,
            ]);

            return redirect('/my-profile')->with('status', 'Profil berhasil diubah');
        }
    }


}
