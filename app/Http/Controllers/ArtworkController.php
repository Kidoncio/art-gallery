<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArtworkController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();

        $response = Http::get('http://api.artic.edu/api/v1/artworks/search', $query)->json();

        return response()->json($response);
    }
}
