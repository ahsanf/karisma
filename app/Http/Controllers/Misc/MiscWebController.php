<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class MiscWebController extends Controller
{
    public function getMemberByTag($tag_id)
    {
        $tag = Tag::find($tag_id);
        $members = $tag->members;

        return response()->json($members);
    }
}
