<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class CustomerController extends Controller
{
    //
    public function notice(Request $request)
    {
        $query = Notice::query();
        $title = $request->query('title');
        if (!empty($title))
             $query->where('name','title', '%'.$title.'%');
        $notices = $query->paginate(20);
        $totalCnt = Notice::count();
        return view('web.customer.notice',compact('notices','totalCnt'));
    }
    public function noticeView()
    {
        return view('web.customer.notice');
    }
    public function event()
    {
        return view('web.customer.notice');
    }
    public function eventView()
    {
        return view('web.customer.notice');
    }

    public function faq()
    {
        return view('web.customer.notice');
    }

}
