<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index($id = null)
    {
        $tickets = new Ticket();
        if (!$id) {
            $tickets = $tickets->all();
        } else {
            $tickets = $tickets->with('user')->findOrFail($id);
        }
        return response()->json(['tickets' => $tickets]);
    }

    public function store(Request $request)
    {
        $ticket = Ticket::create($request->merge(['user_id' => Auth::id()])->all());
        return response()->json(['message' => 'تیکت با موفقیت ایجاد شد', 'ticket' => $ticket]);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return response()->json(['message' => 'تیکت با موفقیت به روز رسانی شد ', 'ticket' => $ticket], 200);
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return response()->json(['message' => 'تیکت با موفقیت حذف شد',], 200);
    }

    public function restore($id)
    {
        $ticket = new Ticket();
        $ticket = $ticket->withTrashed()->findOrFail($id);
        $ticket->restore();
        return response()->json(['message' => 'تیکت با موفقیت بازیابی شد '], 200);
    }
}
