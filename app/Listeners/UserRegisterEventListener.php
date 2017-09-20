<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use App\Mail\UserMailer;
use App\Syslog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRegisterEventListener
{

    /**
     * Create the event listener.
     *
     * @internal param UserMailer $userMailer
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisterEvent  $event
     * @return void
     */
    public function handle(UserRegisterEvent $event)
    {
        //
        $user= $event->user;
        $msg = "用户注册".' id='.$user->id.' name='.base64_decode($user->name);
        Log::alert($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '1';
        $log->level = 'alert';
        $log->project_id = 0;
        $log->user_id = $user->id;
        $log->save();

        //发送邮件
        Mail::to($user)->send(new UserMailer($user));

    }
}
