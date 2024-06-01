<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use App\Models\RestoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $destination = RestoList::findOrFail($id);

        $data = [
            'user_id' => Auth::id(),
            'travel_id' => $destination->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'image' => $request->hasFile('photo') ? $request->file('photo')->store('reviews', 'public') : null,
        ];

        Review::create($data);

        return redirect('/success-review')->with('status', 'Review for ' . $destination->title . ' has been submitted.');
    }




    public function reviewHistory()
    {
        $reviewHistory = (Auth::user()->is_admin == 1) ? Review::all() : Review::where('user_id', Auth::user()->id)->get();
        return view('review_history', compact('reviewHistory'));
    }
    
}