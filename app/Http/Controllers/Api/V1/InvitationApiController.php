<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationApiController extends Controller
{
    public function getByCode(Request $request, $code)
    {
        $invitation = Invitation::where('code', $code)->first();

        if ($invitation) {
            return response()->json([
                'status' => 'success',
                'data' => $invitation
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invitation not found'
            ], 404);
        }
    }

    public function markAttend(Request $request, $code)
    {
        $invitation = Invitation::where('code', $code)->first();
        $payload = $request->json()->all();
        $status = $payload['status'] ?? 'ATTENDING';
        if ($invitation) {
            $invitation->wish_name = $payload['wish_name'] ?? null;
            $invitation->status = $status;
            $invitation->note = $payload['note'] ?? null;
            $invitation->count = $payload['count'] ?? null;
            $invitation->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Invitation marked as ' . $status
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invitation not found'
            ], 404);
        }
    }

    public function getWishes(Request $request)
    {
        $invitations = Invitation::whereNotNull('note')->get(['name', 'note', 'wish_name', 'updated_at']);

        return response()->json([
            'status' => 'success',
            'data' => $invitations
        ], 200);
    }

    public function getStatusCount(Request $request)
    {
        $attending = Invitation::where('status', 'ATTENDING')->count();
        $notAttending = Invitation::where('status', 'NOT ATTENDING')->count();
        $maybe = Invitation::where('status', 'MAYBE')->count();

        $attendingPersons = Invitation::where('status', 'ATTENDING')->sum('count');
        $notAttendingPersons = Invitation::where('status', 'NOT ATTENDING')->sum('count');
        $maybePersons = Invitation::where('status', 'MAYBE')->sum('count');

        return response()->json([
            'status' => 'success',
            'data' => [
                'ATTENDING' => $attending,
                'NOT_ATTENDING' => $notAttending,
                'MAYBE' => $maybe,
                'total' => $attending + $notAttending + $maybe,
                'person_count' => [
                    'ATTENDING' => $attendingPersons,
                    'NOT_ATTENDING' => $notAttendingPersons,
                    'MAYBE' => $maybePersons,
                    'total' => $attendingPersons + $notAttendingPersons + $maybePersons
                ]
            ]
        ], 200);
    }
}
