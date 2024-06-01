<?php

namespace App\Http\Controllers;

use App\Models\RestoList;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestoListController extends Controller
{
    public function index()
    {
        $destinations = RestoList::all();
        return view('admin.all_destination', compact('destinations'));
    }

    public function show($id)
    {
        $destination = RestoList::findOrFail($id);
        $reviewHistory = Review::where('travel_id', $id)->paginate(5);
        return view('resto_detail', compact('destination', 'reviewHistory'));
    }

    public function create()
    {
        return view('admin.create_destination');
    }

    public function store(Request $req)
    {
        $req->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'menu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'alamat' => 'required|string|min:3',
            'maps' => 'required|string|min:3',
            'range' => 'required|string|min:3',
            'total_rating' => 'required|numeric|min:1|max:5',
        ]);

        $files = $req->file('image');
        $fullFileName = $files->getClientOriginalName();
        $image = pathinfo($fullFileName)['filename'] . '_' . rand() . "." . $files->getClientOriginalExtension();
        $files->storeAs('public/images', $image);

        $menuFiles = $req->file('menu');
        $fullMenuFileName = $menuFiles->getClientOriginalName();
        $menuImage = pathinfo($fullMenuFileName)['filename'] . '_' . rand() . "." . $menuFiles->getClientOriginalExtension();
        $menuFiles->storeAs('public/images', $menuImage);

        RestoList::create([
            'image' => $image,
            'menu' => $menuImage,
            'title' => $req->title,
            'description' => $req->description,
            'alamat' => $req->alamat,
            'maps' => $req->maps,
            'range' => $req->range,
            'total_rating' => $req->total_rating,
        ]);

        return redirect('/resto-list')->with('status', 'Restoran berhasil dibuat');
    }

    public function edit($id)
    {
        $destination = RestoList::findOrFail($id);
        return view('admin.edit_destination', compact('destination'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'alamat' => 'required|string|min:3',
            'maps' => 'required|string|min:3',
            'range' => 'required|string|min:3',
            'total_rating' => 'required|numeric|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'menu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $destination = RestoList::findOrFail($id);
        $data = $req->only(['title', 'description', 'alamat', 'maps', 'range', 'total_rating']);

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
            $menuFile = $req->file('menu');
            $menuFilename = pathinfo($menuFile->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $menuFile->getClientOriginalExtension();
            $menuFile->storeAs('public/images', $menuFilename);

            if (Storage::exists('public/images/' . $destination->menu)) {
                Storage::delete('public/images/' . $destination->menu);
            }

            $data['menu'] = $menuFilename;
        }

        $destination->update($data);

        return redirect('/resto-list')->with('status', 'Restoran berhasil diubah');
    }
    public function showReview($id)
    {
        $destination = RestoList::findOrFail($id);
        $reviewHistory = Review::where('travel_id', $id)->paginate(5);
        return view('resto_detail', compact('destination', 'reviewHistory'));
    }

    public function destroy($id)
    {
        $destination = RestoList::findOrFail($id);
        if (Storage::exists('public/images/' . $destination->image)) {
            Storage::delete('public/images/' . $destination->image);
        }
        if (Storage::exists('public/images/' . $destination->menu)) {
            Storage::delete('public/images/' . $destination->menu);
        }
        $destination->delete();

        return redirect('/resto-list')->with('status', 'Restoran berhasil dihapus');
    }
}
