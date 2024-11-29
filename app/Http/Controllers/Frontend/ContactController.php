<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class ContactController extends Controller
{
    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'massage' => 'required',
        ]);
        if ($validator->fails()) {
            notifyEvs('error', $validator->errors()->first());

            return redirect()->back();
        }

        Mail::to(setting('support_email'))->send(new SendMail($request->email, $request->massage));

        Subscription::updateOrCreate(
            ['email' => $request->email], // Update condition
            ['name' => $request->name, 'email' => $request->email] // Data to insert or update
        );

        notifyEvs('success', __('Message  Sent Successfully'));

        return redirect()->back();

    }
}
