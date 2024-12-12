<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'desc')->paginate(30);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply_store(Ticket $ticket, Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $ticket_reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->user()->id,
            'message' => $request->message,
        ]);
        
        return redirect()->route('admin.tickets.show', $ticket)
                         ->with('success','Ticket reply created successfully.');
    }

    public function set_close(Ticket $ticket)
    {
        $ticket->status = 'closed';
        $ticket->save();
        return back();
    }

    public function set_open(Ticket $ticket)
    {
        $ticket->status = 'open';
        $ticket->save();
        return back();
    }
}
