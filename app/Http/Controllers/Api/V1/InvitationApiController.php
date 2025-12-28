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
}
