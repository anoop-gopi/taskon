<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('display_order')->get();
        return view('admin.videos.index', ['videos' => $videos]);
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        \Log::info('=== VIDEO STORE REQUEST START ===');
        \Log::info('Request method: ' . $request->getMethod());
        \Log::info('Request path: ' . $request->path());
        \Log::info('Request is authenticated: ' . (auth()->check() ? 'YES' : 'NO'));
        \Log::info('Request user ID: ' . (auth()->id() ?? 'None'));
        \Log::info('Request user is admin: ' . (auth()->user() && auth()->user()->is_admin ? 'YES' : 'NO'));
        
        try {
            \Log::info('All input received:', $request->except('_token'));

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'embed_url' => 'required|string|max:1000',
                'display_order' => 'nullable|integer',
            ]);

            \Log::info('Validation passed', ['validated' => $validated]);

            // Handle checkbox - convert presence to boolean
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            \Log::info('Calling Video::create() with data:', $validated);

            $video = Video::create($validated);

            \Log::info('Video created successfully', ['video_id' => $video->id]);

            \Log::info('=== VIDEO STORE REQUEST SUCCESS ===');
            return redirect()->route('admin.videos')->with('success', 'Video created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error:', $e->errors());
            throw $e;
        } catch (\Exception $e) {
            \Log::error('=== VIDEO STORE ERROR ===', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', ['video' => $video]);
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'embed_url' => 'required|string|max:1000',
            'display_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $video->update($validated);

        return redirect()->route('admin.videos')->with('success', 'Video updated successfully!');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.videos')->with('success', 'Video deleted successfully!');
    }
}
