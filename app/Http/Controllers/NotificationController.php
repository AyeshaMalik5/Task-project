<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
public function markAsRead($id)
{
    $notification = auth()->user()->notifications()->where('id', $id)->latest()->first();

    if ($notification && $notification->read_at === null) {
        $notification->markAsRead(); // this sets the read_at timestamp
    }
   return redirect()->back()->with('success', 'Marked Read done!');
}
}