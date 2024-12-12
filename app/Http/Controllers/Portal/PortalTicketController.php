<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Models\Push;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(20);
        return view('site.templates.portal.support', compact('tickets'));
    }

    public function create()
    {
        return view('site.templates.portal.support_create',);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        $ticket = Ticket::create([
            'user_id' => $request->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('portal.tickets.index')
                         ->with('success','Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        return view('site.templates.portal.support_show', compact('ticket'));
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
        
        return redirect()->route('portal.tickets.show', $ticket)
                         ->with('success','Ticket reply created successfully.');
    }

    public function set_close(Ticket $ticket)
    {
        if ($ticket->user->id == Auth::user()->id) {
            $ticket->status = 'closed';
            $ticket->save();
        }
        Notify::send(Auth::user()->id, 'Ваш тикет был закрыт');
        Push::send('Закрытие обращения', 'Ваш тикет был закрыт', Auth::user()->id);
        return back();
    }

    public function set_open(Ticket $ticket)
    {
        if ($ticket->user->id == Auth::user()->id) {
            $ticket->status = 'open';
            $ticket->save();
        }
        return back();
    }
    
    
}
