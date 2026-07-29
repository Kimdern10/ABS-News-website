<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\LiveNews;
use App\Models\RadioStream;
use Illuminate\Support\Str;
use App\Models\YoutubeLive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:user,admin,editor',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($request->role);

        return redirect()
            ->route('admin.users.create')
            ->with('success', ucfirst($request->role) . ' account created successfully.');
    }

    /**
     * List all users
     */
    public function userList()
    {
        $users = User::with('roles')
                    ->latest()
                    ->paginate(10);

        return view('admin.users.users-list', compact('users'));
    }

    /**
     * Update user role
     */
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Prevent removing your own super-admin role
        if (
            auth()->id() == $user->id &&
            $user->hasRole('super-admin') &&
            $request->role !== 'super-admin'
        ) {
            return back()->with(
                'error',
                'You cannot remove your own Super Admin role.'
            );
        }

        $user->syncRoles([$request->role]);

        return back()->with('success', 'User role updated successfully.');
    }

    /**
     * Soft delete user
     */
    public function deleteUser(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User moved to trash successfully.');
    }

    /**
     * Ban user
     */
    public function ban(User $user)
    {
        $user->active = 0;
        $user->save();

        return back()->with('success', 'User banned successfully.');
    }

    /**
     * Unban user
     */
    public function unban(User $user)
    {
        $user->active = 1;
        $user->save();

        return back()->with('success', 'User unbanned successfully.');
    }

    /**
     * Trashed users
     */
    public function trashedUsers()
    {
        $users = User::onlyTrashed()
                    ->with('roles')
                    ->latest()
                    ->paginate(10);

        return view('admin.users.trashed', compact('users'));
    }

    /**
     * Restore user
     */
    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->restore();

        return back()->with('success', 'User restored successfully.');
    }

    /**
     * Permanently delete user
     */
    public function forceDeleteUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->forceDelete();

        return back()->with('success', 'User permanently deleted.');
    }

    /**
     * Comments list
     */
    public function comments()
    {
        $comments = Comment::with(['user', 'post'])
                        ->latest()
                        ->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Delete comment
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

    /**
     * Subscribers list
     */
    public function subscribers()
    {
        $subscribers = Subscriber::latest()
                                ->paginate(10);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    /**
     * Delete subscriber
     */
    public function destroys($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        $subscriber->delete();

        return back()->with('success', 'Subscriber deleted successfully.');
    }

    public function liveNewsIndex()
{
    $news = LiveNews::latest()->paginate(10);

    return view('admin.live-news.index', compact('news'));
}

public function liveNewsCreate()
{
    return view('admin.live-news.create');
}

public function liveNewsStore(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image',
    ]);

    $image = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image')
            ->store('live-news', 'public');
    }

    LiveNews::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'content' => $request->content,
        'image' => $image,
        'is_live' => $request->has('is_live'),
        'status' => $request->has('status'),
    ]);

    return redirect()
        ->route('admin.live-news.index')
        ->with('success', 'Live News Created Successfully');
}

public function liveNewsEdit($id)
{
    $liveNews = LiveNews::findOrFail($id);

    return view('admin.live-news.edit', compact('liveNews'));
}

public function liveNewsUpdate(Request $request, $id)
{
    $liveNews = LiveNews::findOrFail($id);

    if ($request->hasFile('image')) {

        if ($liveNews->image) {
            Storage::disk('public')
                ->delete($liveNews->image);
        }

        $liveNews->image = $request->file('image')
            ->store('live-news', 'public');
    }

    $liveNews->title = $request->title;
    $liveNews->slug = Str::slug($request->title);
    $liveNews->content = $request->content;
    $liveNews->is_live = $request->has('is_live');
    $liveNews->status = $request->has('status');

    $liveNews->save();

    return redirect()
        ->route('admin.live-news.index')
        ->with('success', 'Updated Successfully');
}

public function liveNewsDelete($id)
{
    $liveNews = LiveNews::findOrFail($id);

    if ($liveNews->image) {
        Storage::disk('public')
            ->delete($liveNews->image);
    }

    $liveNews->delete();

    return back()->with('success', 'Deleted Successfully');
}

public function youtubeLiveIndex()
{
    $streams = YoutubeLive::latest()->paginate(10);

    return view(
        'admin.youtube-live.index',
        compact('streams')
    );
}

public function youtubeLiveCreate()
{
    return view('admin.youtube-live.create');
}

public function youtubeLiveStore(Request $request)
{
    $request->validate([
        'title' => 'required',
        'youtube_url' => 'required',
        'thumbnail' => 'nullable|image',
    ]);

    $thumbnail = null;

    if ($request->hasFile('thumbnail')) {

        $thumbnail = $request->file('thumbnail')
            ->store('youtube-live', 'public');
    }

    YoutubeLive::create([
        'title' => $request->title,
        'youtube_url' => $request->youtube_url,
        'thumbnail' => $thumbnail,
        'is_live' => $request->has('is_live'),
        'status' => $request->has('status'),
    ]);

    return redirect()
        ->route('admin.youtube-live.index')
        ->with('success', 'Stream Created Successfully');
}

public function youtubeLiveEdit($id)
{
    $stream = YoutubeLive::findOrFail($id);

    return view(
        'admin.youtube-live.edit',
        compact('stream')
    );
}

public function youtubeLiveUpdate(Request $request, $id)
{
    $stream = YoutubeLive::findOrFail($id);

    if ($request->hasFile('thumbnail')) {

        if ($stream->thumbnail) {
            Storage::disk('public')->delete($stream->thumbnail);
        }

        $stream->thumbnail = $request->file('thumbnail')
            ->store('youtube-live', 'public');
    }

    // If this stream is being activated,
    // deactivate all other streams first
    if ($request->has('status')) {

        YoutubeLive::where('id', '!=', $stream->id)
            ->update([
                'status' => 0,
                'is_live' => 0
            ]);
    }

    $stream->title = $request->title;
    $stream->youtube_url = $request->youtube_url;
    $stream->is_live = $request->has('is_live');
    $stream->status = $request->has('status');

    $stream->save();

    return redirect()
        ->route('admin.youtube-live.index')
        ->with('success', 'Updated Successfully');
}

public function youtubeLiveDelete($id)
{
    $stream = YoutubeLive::findOrFail($id);

    if ($stream->thumbnail) {

        Storage::disk('public')
            ->delete($stream->thumbnail);
    }

    $stream->delete();

    return back()->with('success', 'Deleted Successfully');
}

public function radioIndex()
{
    $radios = RadioStream::latest()->paginate(10);

    return view('admin.radio.index', compact('radios'));
}

public function radioCreate()
{
    $radio = RadioStream::first();

    return view('admin.radio.create', compact('radio'));
}

public function radioStore(Request $request)
{
    RadioStream::updateOrCreate(
        ['id' => 1],
        [
            'title'      => $request->title,
            'stream_url' => $request->stream_url,
            'is_live'    => $request->has('is_live'),
            'status'     => $request->has('status'),
        ]
    );

    return redirect()
        ->route('admin.radio.create')
        ->with('success', 'Radio Stream Saved Successfully');
}

public function radioEdit()
{
    $radio = RadioStream::firstOrFail();

    return view('admin.radio.edit', compact('radio'));
}

public function radioUpdate(Request $request)
{
    $radio = RadioStream::firstOrFail();

    $radio->update([
        'title'      => $request->title,
        'stream_url' => $request->stream_url,
        'is_live'    => $request->has('is_live'),
        'status'     => $request->has('status'),
    ]);

    return redirect()
        ->route('admin.radio.create')
        ->with('success', 'Radio Stream Updated Successfully');
}

public function radioToggle($id)
{
    $radio = RadioStream::findOrFail($id);

    $radio->update([
        'status' => !$radio->status
    ]);

    return back()->with(
        'success',
        $radio->status
            ? 'Radio Turned ON'
            : 'Radio Turned OFF'
    );
}

public function radioDelete($id)
{
    $radio = RadioStream::findOrFail($id);

    $radio->delete();

    return redirect()
        ->route('admin.radio.index')
        ->with('success', 'Radio Stream Deleted Successfully');
}

}