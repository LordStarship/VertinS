<?php

namespace App\Http\Controllers;

use App\Models\Pictures;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
    public function destroy($id)
    {
        $picture = Pictures::findOrFail($id);
    
        if ($picture->delete()) {
            return response()->json(['message' => 'Picture deleted successfully.'], 200); // Success response
        }
    
        return response()->json(['message' => 'Failed to delete picture.'], 500); // Failure response
    }
}