<?php

namespace App\Http\Controllers;

use Auth;
use App\event;
use App\review;
use App\ticket;
use App\history;
use App\Area_list;
use Carbon\Carbon;
use App\Custom_event;
use App\Machine_list;
use App\ticket_alert;
use App\db_notification;
use App\ticket_timeline;
use App\Manufacturer_list;
use App\email_notification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\createTicket;
use App\Notifications\approveTicketByRequestor;
use App\Http\Requests\requestorRequestValidation;
use App\Notifications\approveNotificationToTechnician;

class requestorController extends Controller
{
    public function addManualMachines()
    {
        $store = new Machine_list();
        $store->name = 'Poly Picc Outer';
        // $store->save();
        return 'working';
    }
    public function addManualManufacturer()
    {
        $store = new Manufacturer_list();
        $store->name = 'Gluco';
        // $store->save();
        return 'working';
    }
    public function addManualArea()
    {
        $store = new Area_list();
        $store->brs = 'BRS6931';
        $store->area = 'POLY PICC';
        $store->room = 'B';
        // $store->save();
        return 'working';
    }
    public function createRequestIndex()
    {   $areas = Area_list::all();
        $machines = Machine_list::all();
        $manufacturers = Manufacturer_list::all();
        return view('requestor.create_request',compact('areas','machines','manufacturers'));
    }
    public function createRequest(requestorRequestValidation $request)
    {
        $store = new ticket();
        $request_id = 'LT-'.strtoupper(Str::random(4));
        $store->user_id = Auth::user()->id;
        $store->machine_description = $request->machine_description;
        // $store->brp = $request->brp;
        $store->cost_center_line = $request->cost_center_line;
        $store->supervisor_name = $request->supervisor_name;
        $store->description_of_problem = $request->description_of_problem;
        $store->priority_level = $request->priority_level;
        $store->request_id = $request_id;
        $store->save(); 
        //History table
            $store2 = new history();
            $store2->user_id =  Auth::user()->id;
            $store2->ticket_id =  $store->id;
            $store2->flag =  '1';
            $store2->save();
        //Event table
            $store2 = new event();
            $store2->user_id =  Auth::user()->id;
            $store2->ticket_id =  $store->id;
            $days = Ticket_timeline::where('id','1')
            ->first();
            $store2->end = Carbon::now()->addDays($days->days);
            $store2->flag =  '1';
            $store2->save();
        //Custom Event Table
            $store3 = new Custom_event();   
            $store3->ticket_id =  $store->id;
            $store3->custom = Carbon::now();    
            $store3->save();
        //Notifications
            $email =email_notification::where('user_id',Auth::User()->id)
            ->first();
            $db =db_notification::where('user_id',Auth::User()->id)
            ->first();
            Auth::user()->notify(new createTicket($store,$email,$db));
            session()->flash('message','Request has been generated successfully');
            return back();
    }
    public function viewRequestByRequestor($id)
    {
        $views = ticket::where('id','=',$id)
        ->with('ticketHistory')
        ->get();
        return view('requestor.view_request',compact('views'));
    }
    public function editByRequestor($id)
    {
        $ticket = ticket::find($id);
        return view('requestor.edit_request',compact('ticket'));
    }
    public function updateRequestByRequestor(Request $request, $id)
    {
        $update = ticket::find($id);
        $update->machine_description = $request->machine_description;
        $update->brp = $request->brp;
        $update->cost_center_line = $request->cost_center_line;
        $update->supervisor_name = $request->supervisor_name;
        $update->description_of_problem = $request->description_of_problem;
        $update->priority_level = $request->priority_level;
        $update->save();
        session()->flash('message','Request has been updated successfully');
        return back();
    }
    public function myRequests()
    {
        $requests = ticket::where('user_id','=',Auth::user()->id)
        // ->with('ticketHistory')
        // ->orderBy('status', 'DESC')
        ->latest()
        ->with('ticketHistory')
        ->get();
        return view('requestor.my_requests',compact('requests'));
    }
    public function requestorHistory()
    {
        $requests = ticket::where('user_id','=',Auth::user()->id)
        ->where('status','=','4')
        ->with('ticketHistory')
        ->latest('created_at')
        ->get();
        
        // $requests = Ticket::where('status','4')
        // ->with(['ticketHistory' => function ($query) {
        // $query->where('flag','4');
        // }])->get();
        // return $requests;
        return view('requestor.history',compact('requests'));
    }
    public function approveByRequestor($id)
    {
        $ticket = ticket::find($id);
        $ticket->status = '4';
        $ticket->save();
        //Notifications
            $email =email_notification::where('user_id',Auth::User()->id)
            ->first();
            $db =db_notification::where('user_id',Auth::User()->id)
            ->first();
        //Technician Notification   
            $technician_email = email_notification::where('user_id', $ticket->technician->id)
            ->first();
            $technician_db = db_notification::where('user_id', $ticket->technician->id)
            ->first();
            $ticket->technician->notify(new approveNotificationToTechnician($ticket,$technician_email,$technician_db));
            //Auth Notification
                Auth::user()->notify(new approveTicketByRequestor($ticket,$email,$db));
        //History table
            $store2 = new history();
            $store2->user_id =  Auth::user()->id;
            $store2->ticket_id =  $id;
            $store2->technician_id = $ticket->technician_id;
            $store2->flag =  '4';
            $store2->save();
        //Event table
            $store3 = Event::where('ticket_id',$id)
            ->first();
            $store3->ticket_id =  $id;
            // $days = Ticket_timeline::where('id','1')
            // ->first();
            // $store3->end = Carbon::now()->addDays($days->days);
            // $store2->technician_id = $ticket->technician_id;
            $store3->flag =  '4';
            $store3->save();
            session()->flash('message','Thank you! for approving the ticket');
            return back();
    }
    public function viewReviewByRequestor($id)
    {
        $views = review::where('user_id','=',Auth::user()->id)
        ->where('ticket_id','=',$id)
        ->with('reviewTicket')
        ->get();
        return view('requestor.review',compact('views'));
    }
    public function requestorMarkAsRead($id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return back();
    }
    public function deleteByRequestor(Request $request)
    {
        $dell = ticket::find($request->dell_id);
        $dell->delete();
        $dell = history::where('ticket_id',$request->dell_id);
        $dell->delete();
        session()->flash('delete','Your request has been deleted successfully');
        return back();
    }
}
