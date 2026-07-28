<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eyewitness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EyewitnessController extends Controller
{
    //
  public function index()
{
    $eyewitness = Eyewitness::with('user')
        ->latest()
        ->get();

    return view(
        'admin.eyewitness.index',
        compact('eyewitness')
    );
}




    public function edit($id)
    {

        $news = Eyewitness::findOrFail($id);


        return view(
            'admin.eyewitness.edit',
            compact('news')
        );
    }





    public function update(Request $request, $id)
    {
        $news = Eyewitness::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'location' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $news->image = $request->file('image')
                ->store('eyewitness', 'public');
        }

        $news->title = $request->title;
        $news->content = $request->content;
        $news->location = $request->location;

        $news->save();

        return redirect()
            ->route('admin.eyewitness.index')
            ->with('success', 'Eyewitness updated successfully.');
    }






    public function status(Request $request, $id)
    {

        $news = Eyewitness::findOrFail($id);



        $news->update([

            'status' => $request->status

        ]);



        return back()
            ->with(
                'success',
                'Status changed'
            );
    }

    public function destroy($id)
    {

        $news = Eyewitness::findOrFail($id);


        $news->delete();


        return back()
            ->with(
                'success',
                'Eyewitness moved to trash'
            );
    }

    public function restore($id)
    {

        $news = Eyewitness::withTrashed()
            ->findOrFail($id);


        $news->restore();


        return back()
            ->with(
                'success',
                'Eyewitness restored'
            );
    }

    public function trash()
    {

        $eyewitness =
            Eyewitness::onlyTrashed()
            ->latest()
            ->get();


        return view(
            'admin.eyewitness.trash',
            compact('eyewitness')
        );
    }
}
