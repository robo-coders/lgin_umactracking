<?php

namespace App\Http\Controllers;

use Auth;
use App\user;
use App\event;
use App\review;
use App\ticket;
use App\history;
use App\Activity;
use Carbon\Carbon;
use App\Custom_event;
use App\Parts_detail;
use App\Sub_category;
use App\ticket_alert;
use App\Category_detail;
use App\db_notification;
use App\ticket_timeline;
use App\email_notification;
use Illuminate\Http\Request;
use App\Notifications\assignTicket;
use App\Http\Requests\technicianReview;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\closeTicketByTechnician;
use App\Notifications\assignTicketNotificationToTechnician;

class technicianController extends Controller
{
    public function addManualDataToPart()
    {
        $store = new Parts_detail();
        $store->part_no =  '0043';
        $store->description = "VALV.DE BRONCE TIPO BOLA";
        $store->cost =  '0';
        $store->currency = "USD";
        $store->save();
    }
    public function addManualCategory()
    {
        $category = new Category_detail();
        $category->category = 'Equipo Periferico';
        // $category->save();
        $sub_category = new Sub_category();
        // $sub_category->category_detail_id = $category->id;
        $sub_category->category_detail_id = '4';
        $sub_category->sub_category = 'Controladores de temp';
        // $sub_category->save();
        return 'working';
    }

    public function viewTicketByTechnician($id)
    {
        $views = ticket::where('id', '=', $id)
            ->with('ticketHistory')
            ->get();
        // return $views;
        return view('technician.view_ticket', compact('views'));
    }

    public function getSubCategory(Request $request)
    {
        $data = Sub_category::where('category_detail_id',$request->id)
        ->get();
        if($data){
            return response()->json($data);

        }else{
            return 'Null';
        }
    }

    public function technicianTasks()
    {
        // $tasks = ticket::with('ticketHistory')
        // ->whereHas('ticket_history.flag','=','2')
        // ->get();

        // $tasks = ticket::whereHas('ticketHistory', function ($query) {
        //     $query->where('flag', '=', 2);
        // })
        // ->with('ticketHistory')
        // ->get();

        // $tasks = App\ticket::whereHas('ticketHistory', function (Builder $query) {
        //     $query->where('flag','=','2');
        // })->get();
        $tasks = ticket::where('technician_id', '=', Auth::user()->id)
            ->where('status', '=', '2')
            ->with('ticketHistory')
            ->get();
        $pendings = ticket::where('technician_id', '=', Auth::user()->id)
            ->where('status', '=', '3')
            ->with('ticketHistory')
            ->get();
        // return $tasks;
        return view('technician.tasks', compact('tasks', 'pendings'));
    }

    public function assignTicketToTechnician($id)
    {
        $ticket = ticket::find($id);
        $ticket->status = '2';
        $ticket->technician_id = Auth::user()->id;
        $ticket->save();
        //History Table
        $store = new history();
        $store->user_id = $ticket->user_id;
        $store->ticket_id = $id;
        $store->technician_id = Auth::user()->id;
        $store->flag = '2';
        $store->save();
        //Event Table
        $store2 = event::where('ticket_id', $id)
            ->first();
        $store2->technician_id = Auth::User()->id;
        $days = Ticket_timeline::where('id', '1')
            ->first();
        // $store2->end = Carbon::now()->addDays($days->days);
        // $store2->technician_id = Auth::user()->id;
        $store2->flag = '2';
        $store2->save();
        //Custom Event Table
        if (
            $store = Custom_event::where('ticket_id', $id)
            ->first()
        ) {
            $store->user_id = Auth::user()->id;
            $store->save();
        }

        //Auth Notification
        $email = email_notification::where('user_id', Auth::User()->id)
            ->first();
        $db = db_notification::where('user_id', Auth::User()->id)
            ->first();
        Auth::user()->notify(new assignTicketNotificationToTechnician($ticket, $email, $db));
        //Requestor Notification    
        $requestor_email = email_notification::where('user_id', $ticket->requestor->id)
            ->first();
        $requestor_db = db_notification::where('user_id', $ticket->requestor->id)
            ->first();
        $ticket->requestor->notify(new assignTicket($ticket, $requestor_email, $requestor_db));

        session()->flash('message', 'Request# ' . $ticket->request_id . ' has been assigned to you successfully');
        return back();
    }
    public function reviewIndex($id)
    {
        $tickets = ticket::where('id', '=', $id)
        ->get();
        $categories = Category_detail::all();
        $parts = Parts_detail::all();
        return view('technician.review', compact('tickets','categories','parts'));
    }
    public function reviewFromTechnician(Request $request)
    {
        return $request;
        $ticket = ticket::find($request->ticket_id);
        $store = new review();
        $store->user_id = $request->user_id;
        $store->ticket_id = $request->ticket_id;
        $store->technician_id = Auth::user()->id;
        $store->description = $request->description;
        $store->solution = $request->solution;
        $store->prevention = $request->prevention;
        $store->explanation = $request->explanation;
        $store->comments = $request->comments;
        $store->date = Carbon::parse($request->date);
        $store->material = $request->material;
        $store->save();
        //custom Table
        if($request->part_number){
            $part = Parts_detail::where('part_no',$request->part_number)
            ->first();
            $store = review::where('id',$store->id)->first();
            $store->part_id = $part->id;
            $store->save();
        }elseif($request->custom_part_number){
            $store = new Parts_detail();
            $store->part_no = $request->custom_part_number;
            $store->description = $request->description;
            $store->cost = $request->cost;
            $store->currency = $request->currency;
            $store->save();

        }
        //second Table
        $ticket->status = '3';
        $ticket->save();
        //Third table
        $store2 = new history();
        $store2->user_id = $request->user_id;
        $store2->ticket_id = $request->ticket_id;
        $store2->technician_id = Auth::user()->id;
        $store2->flag = '3';
        $store2->save();
        //Event table
        $store2 = Event::where('ticket_id', $request->ticket_id)
            ->first();
        //  $days = Ticket_timeline::where('id','1')
        //  ->first();
        //  $store2->end = Carbon::now()->addDays($days->days);
        //  $store2->technician_id = Auth::user()->id;
        $store2->flag = '3';
        $store2->save();
        //Requestor Notification    
        $requestor_email = email_notification::where('user_id', $ticket->requestor->id)
            ->first();
        $requestor_db = db_notification::where('user_id', $ticket->requestor->id)
            ->first();
        $ticket->requestor->notify(new closeTicketByTechnician($ticket, $requestor_email, $requestor_db));
        session()->flash('message', 'Request# ' . $ticket->request_id . ' has been completed & waiting for approval');
        return redirect('/technician/tasks');
    }
    public function viewReviewByTechnician($id)
    {
        $views = review::where('ticket_id', '=', $id)
            ->get();
        return view('technician.view_review', compact('views'));
    }
    public function editTicketReviewByTechnician($id)
    {
        $tickets = review::where('ticket_id', $id)
            ->get();
        return view('technician.edit_review', compact('tickets'));
    }
    public function updateTicketReviewByTechnician(Request $request, $id)
    {
        $ticket = ticket::find($request->ticket_id);
        $store = review::where('ticket_id', $id)
            ->first();
        $store->description = $request->description;
        $store->solution = $request->solution;
        $store->prevention = $request->prevention;
        $store->explanation = $request->explanation;
        $store->comments = $request->comments;
        $store->date = Carbon::parse($request->date);
        $store->material = $request->material;
        $store->part_number = $request->part_number;
        $store->costo = $request->costo;
        $store->save();
        session()->flash('message', 'Request# ' . $ticket->request_id . ' has been updated & waiting for approval');
        return back();
    }
    public function technicianHistory()
    {
        $requests = ticket::where('technician_id', '=', Auth::user()->id)
            ->where('status', '=', '4')
            ->with('ticketHistory')
            ->latest('created_at')
            ->get();
        return view('technician.history', compact('requests'));
    }
    public function closeTicketByTechnician($id)
    {
        // $ticket = ticket::find($id);
        // $ticket->status = '3';
        // $ticket->save();

        // $ticket->requestor->notify(new closeTicketByTechnician($ticket));
        // session()->flash('message','Request# ' .$ticket->request_id.' has been closed & waiting for approval');
        // return back();
    }
    public function technicianMarkAsRead($id)
    {
        // return $id;
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return back();
    }
}
