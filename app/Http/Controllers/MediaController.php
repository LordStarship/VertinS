<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'social_media' => 'required|string|max:255',
            'url' => 'required|url|max:2048',
        ]);

        Media::create([
            'social_media' => $validatedData['social_media'],
            'url' => $validatedData['url'],
            'admin_id' => auth('web')->id(),
        ]);

        return redirect()->route('accounts.index')->with('success', 'Social media added successfully!');
    }

    public function show($id)
    {
        // Find the media record by its ID
        $media = Media::find($id);
    
        // Check if the media record exists
        if (!$media) {
            return response()->json(['error' => 'Media not found'], 404);
        }
    
        // Return the media record as a JSON response
        return response()->json(['data' => $media], 200);
    }
    

    public function update(Request $request)
    {
        // Loop through each media item in the request
        foreach ($request->input('media', []) as $mediaData) {
            // Validate each media item
            $validated = validator($mediaData, [
                'id' => 'required|exists:medias,id',
                'url' => 'required|url|max:2048',
            ])->validate();
            
            // Find the media by ID
            $media = Media::findOrFail($validated['id']);
            
            // Ensure the logged-in user is the owner
            if ($media->admin_id !== auth('web')->id()) {
                abort(403, 'Unauthorized action.');
            }
        
            // Update the media item
            $media->update(['url' => $validated['url']]);
        }
    
        return redirect()->route('accounts.index')->with('success', 'Social media updated successfully.');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Ensure the logged-in admin owns the media record
        if ($media->admin_id != auth('web')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $media->delete();

        return response()->json(['message' => 'Social Media deleted successfully.']);
    }
}
