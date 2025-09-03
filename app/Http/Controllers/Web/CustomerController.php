<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Event;
use App\Models\Inquiry;

class CustomerController extends BaseController
{
    //
    public function notice(Request $request)
    {
        $query = Notice::query();
        $title = $request->query('title');
        if (!empty($title)){}
             $query->where('title','Like', '%'.$title.'%');
        $notices = $query->orderBy('created_at', 'DESC')->paginate(10);
        $totalCnt = $query->count();
        return view('web.customer.notice',compact('notices','totalCnt','title'));
    }
    
    public function event(Request $request)
    {
        $query = Event::query();
        $title = $request->query('title');
        if (!empty($title))
             $query->where('title','Like', '%'.$title.'%');
        $events = $query->orderBy('created_at', 'DESC')->paginate(10);
        $totalCnt = $query->count();
        return view('web.customer.event',compact('events','totalCnt','title'));
    }
    public function noticeView(Request $request)
    {
        $id = $request->id;
        $item = Notice::where('id',$id)->first();
        $next = Notice::where('id',$id+1)->first();
        $prev = Notice::where('id',$id-1)->first();
        $type = "notice";
        $type_name = "공지";
        $item->hits = $item->hits + 1;
        $item->save();
        return view('web.customer.view',compact('type','type_name','item','next','prev'));
    }
    public function eventView(Request $request)
    {
        $id = $request->id;
        $item = Event::where('id',$id)->first();
        $next = Event::where('id',$id+1)->first();
        $prev = Event::where('id',$id-1)->first();
        $type = "event";
        $type_name = "이벤트";
        $item->hits = $item->hits + 1;
        $item->save();
        return view('web.customer.view',compact('type','type_name','item','next','prev'));
    }
    public function faqView(Request $request)
    {
        $id = $request->id;
        $item = Inquiry::where('id',$id)->first();
        $item1 = Inquiry::where('referer_id',$id)->first();
        $type = "faq";
        $type_name = "1:1 문의";
        return view('web.customer.view',compact('type','type_name','item','item1'));
    }
    public function faq(Request $request)
    {
        $authUser = \Auth::guard('web')->user();
        $query = Inquiry::query();
        $title = $request->query('title');
        if (!empty($title))
             $query->where('title','Like', '%'.$title.'%');
        $query = $query->orderBy('created_at', 'DESC')->where('sender_id',$authUser->id)->where('referer_id',0);
       
        $totalCnt = $query->count();
        $faqs = $query->paginate(10);
        $hasPendingFaq = $faqs->contains(function($faq) {
            return $faq->status == 0;
        });
        return view('web.customer.faq',compact('faqs','totalCnt','title','hasPendingFaq'));
    }
    public function faqWrite(Request $request){
        $authUser = \Auth::guard('web')->user();
       
        $hasPendingFaq = Inquiry::where('sender_id', $authUser->id)
                        ->where('referer_id', 0)
                        ->where('status', 0)
                        ->exists();
        if($hasPendingFaq)
        {
            return back()->withErrors('이전 문의를 확인하지 않으셨습니다.');
        }
        $faq = new Inquiry;
        $faq->sender_id = $authUser->id;
        $faq->title = $request->title;
        $faq->content = $request->content;
        $faq->status = 0;
        $faq->save();
        return redirect()->route('customer.faq');
    }

}
