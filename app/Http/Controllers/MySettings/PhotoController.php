<?php

namespace App\Http\Controllers\MySettings;

use App\Service\PhotoUploaderService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        return view('user-settings/photo', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request, PhotoUploaderService $photoUploaderService)
    {
        $request->validate([
            'profilePhoto' => 'required|image',
        ]);

        $profilePhoto = $request->file('profilePhoto');

        Auth::user()->updateProfilePhoto($photoUploaderService, $profilePhoto);

        $request->session()->flash('user-settings-photo-success', 'Profile photo updated successfully');

        return redirect()->route('user-settings');
    }

    public function photo(User $user, $size, Request $request)
    {
        $lastModified = new \DateTime($user->image_updated_at);

        $response = new Response();
        $response->setLastModified($lastModified);

        if ($response->isNotModified($request)) {
            return $response;
        }

        return response()->file(Storage::disk('local')->path($user->imageFile($size)))
            ->setLastModified($lastModified)
            ->setPublic();
    }
}
