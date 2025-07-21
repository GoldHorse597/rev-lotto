<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Event;
use App\Models\History;

class HomeController extends BaseController
{
    //
     public function index()
    {
        $notices = Notice::latest()->take(5)->get();
        $events = Event::latest()->take(5)->get();
        $notices1 = \DB::table('notices')
            ->select('id', 'title', 'content', 'created_at', \DB::raw("'notice' as type"));

        $events1 = \DB::table('events')
            ->select('id', 'title', 'content', 'created_at', \DB::raw("'event' as type"));
        $games = \DB::table('games')->get();
        $news = $notices1
            ->unionAll($events1)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
      
        return view('web.'.env('THEME').'.index', compact('notices', 'events','news','games'));
    }
}
