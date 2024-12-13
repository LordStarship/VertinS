<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);
    
        if ($picture->delete()) {
            return response()->json(['message' => 'Picture deleted successfully.'], 200); // Success response
        }
    
        return response()->json(['message' => 'Failed to delete picture.'], 500); // Failure response
    }
}