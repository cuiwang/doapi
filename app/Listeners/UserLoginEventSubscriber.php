<?php

namespace App\Listeners;

use App\Syslog;
use Cookie;
use Illuminate\Support\Facades\Log;

class UserLoginEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {

        $user= $event->user;
        $msg = "用户登录".' id='.$user->id.' name='.base64_decode($user->name);
        Log::alert($msg);

       $log = new Syslog();
       $log->description = $msg;
       $log->type = '1';
       $log->level = 'alert';
       $log->project_id = 0;
       $log->user_id = $user->id;
        $log->save();
        //一周
        Cookie::queue('islogin', 'test', 10080);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {
        $user= $event->user;
        $msg = "用户退出".' id='.$user->id.' name='.base64_decode($user->name);
        Log::alert($msg);

       $log = new Syslog();
       $log->description = $msg;
       $log->type = '1';
       $log->level = 'alert';
       $log->project_id = 0;
       $log->user_id = $user->id;
        $log->save();
        Cookie::queue('islogin', 'test', -1);
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserLoginEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserLoginEventSubscriber@onUserLogout'
        );
    }

}