<?php

namespace App\Providers;

use App\Http\Traits\Status;
use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use App\Models\System;
use View,Session;
use Illuminate\Support\Arr;
use Overtrue\Socialite\User as SocialiteUser;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    use Status;
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        


        Carbon::setLocale('zh');

        
        $taskStatus = Status::taskStatus();        
        View::share('taskStatus',$taskStatus);  

        $system = System::first();        
        config(['wechat.official_account.default.app_id'=>$system->app_id,
                'wechat.official_account.default.secret'=>$system->app_secret,
                'wechat.official_account.default.token'=>$system->token,
                'wechat.official_account.default.aes_key'=>$system->aes_key
            ]);

        // $user = new SocialiteUser([
        //     'id' => '3123123123',
        //     'name' =>'wewewe',
        //     'nickname' => 'eewewew',
        //     'avatar' => 'ewew',
        //     'email' => null,
        //     'original' => [],
        //     'provider' => 'WeChat',
        // ]);

        //session(['wechat.oauth_user.default' => $user]); // 同理，`default` 可以更换为您对应的其它配置名

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
