
<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Auth;

class User {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        echo "df";exit;
        if (Auth::user()->user_type == "3" ) {
            return $next($request);
        } else {
            return response(view('errors.404'), 404);
        }
    }

}
