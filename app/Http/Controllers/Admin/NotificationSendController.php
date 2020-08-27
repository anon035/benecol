<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\NotificationMail;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\FileUploadException;
use App\Http\Requests\SendNotificationRequest;

class NotificationSendController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SendNotificationRequest $request)
    {
        $photoPath = '';
        if (isset($request->photo)) {
            $photo = $request->photo;
            $tempPath = $photo->path();
            $relativePath = 'public_files/mail_photos/' . time() . $photo->hashName();
            $photoPath = str_replace('/project/', '/web/', base_path($relativePath));
            if (!move_uploaded_file($tempPath, $photoPath)) {
                throw new FileUploadException('Nahrávanie fotografie zlyhalo.');
            }
            $photoPath = url($relativePath);
        }
        Mail::to(Auth::user())->bcc($request->recipients)->send(new NotificationMail($request->subject, $request->body, $photoPath));
        return redirect()->route('notifications', ['message' => 'success']);
    }
}
