<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', $request->user()->id)
            ->where('is_blocked', false)
            ->with('contactUser')
            ->get();

        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_or_email' => 'required|string',
        ]);

        $contactUser = User::where('email', $request->phone_or_email)
            ->orWhere('phone', $request->phone_or_email)
            ->first();

        if (!$contactUser) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($contactUser->id === $request->user()->id) {
            return response()->json(['message' => 'Cannot add yourself'], 422);
        }

        $contact = Contact::firstOrCreate([
            'user_id' => $request->user()->id,
            'contact_id' => $contactUser->id
        ]);

        return response()->json($contact->load('contactUser'));
    }

    public function blocked(Request $request)
    {
        $contacts = Contact::where('user_id', $request->user()->id)
            ->where('is_blocked', true)
            ->with('contactUser')
            ->get();

        return response()->json($contacts);
    }

    public function block(Request $request, $id)
    {
        $contact = Contact::where('user_id', $request->user()->id)->where('contact_id', $id)->first();
        if (!$contact) {
            $contact = Contact::create(['user_id' => $request->user()->id, 'contact_id' => $id]);
        }
        $contact->update(['is_blocked' => true]);
        return response()->json(['message' => 'User blocked']);
    }

    public function unblock(Request $request, $id)
    {
        $contact = Contact::where('user_id', $request->user()->id)->where('contact_id', $id)->firstOrFail();
        $contact->update(['is_blocked' => false]);
        return response()->json(['message' => 'User unblocked']);
    }

    public function toggleFavourite(Request $request, $id)
    {
        $contact = Contact::where('user_id', $request->user()->id)->where('contact_id', $id)->firstOrFail();
        $contact->update(['is_favourite' => !$contact->is_favourite]);
        return response()->json(['is_favourite' => $contact->is_favourite]);
    }

    public function destroy(Request $request, $id)
    {
        Contact::where('user_id', $request->user()->id)->where('contact_id', $id)->delete();
        return response()->json(['message' => 'Contact removed']);
    }
}
