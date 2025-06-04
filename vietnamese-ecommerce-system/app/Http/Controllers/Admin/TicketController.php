<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        // Load tickets list
        return view('admin.tickets.index');
    }

    public function show($id)
    {
        // Show ticket details
        return view('admin.tickets.show', compact('id'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        // Save ticket reply logic here

        return redirect()->route('admin.tickets.show', $id)->with('success', 'Reply sent successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        // Update ticket status logic here

        return redirect()->route('admin.tickets.show', $id)->with('success', 'Ticket status updated successfully.');
    }

    public function destroy($id)
    {
        // Delete ticket logic here

        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
