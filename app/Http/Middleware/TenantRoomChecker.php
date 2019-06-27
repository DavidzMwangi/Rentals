<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Support\Facades\Auth;

class TenantRoomChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $tenant=Tenant::where('user_id',Auth::id())->first();

        if ($tenant==null || $tenant->is_active==false){
            return redirect()->route('add_room');
        }else{
            return $next($request);
        }
    }
}
