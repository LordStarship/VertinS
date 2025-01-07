<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function update(Request $request, $id)
    {
        // Log the start of the update process
        Log::info('Update method started', ['id' => $id, 'request_data' => $request->all()]);

        // Validate the request data
        try {
            $validatedData = $request->validate([
                'url' => 'required|url|max:2048',
            ]);

            Log::info('Request data validated', ['validated_data' => $validatedData]);
        } catch (\Exception $e) {
            Log::error('Validation failed', [
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            return redirect()->route('accounts.index')->withErrors('Validation failed.');
        }

        // Find the media record
        try {
            $media = Media::findOrFail($id);
            Log::info('Media record found', ['media' => $media]);
        } catch (\Exception $e) {
            Log::error('Media record not found', [
                'id' => $id,
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->route('accounts.index')->withErrors('Media not found.');
        }

        // Update the media record
        try {
            $media->url = $validatedData['url'];
            $media->save();

            Log::info('Media record updated successfully', ['media' => $media]);
        } catch (\Exception $e) {
            Log::error('Error saving media record', [
                'media' => $media,
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->route('accounts.index')->withErrors('Error saving media.');
        }

        // Debugging purpose log for dd() equivalent
        Log::debug('Media after update', ['media' => $media]);

        // Return success response
        return redirect()->route('accounts.index')->with('success', 'Social media updated successfully!');
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
