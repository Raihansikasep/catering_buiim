<!-- <?php -->

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

// class AdminMiddleware
// {
//     public function handle(Request $request, Closure $next): Response
//     {
//         // jika belum login
//         if (!$request->user()) {
//             abort(403);
//         }

//         // jika bukan admin
//         if ($request->user()->role !== 'admin') {
//             abort(403);
//         }

//         return $next($request);
//     }
// }
