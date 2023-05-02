<?php

namespace App\Http\Middleware;

use App\Models\Curso;
use Closure;
use Illuminate\Http\Request;

class Matricula
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $curso = Curso::where('id', $request->id)->get();

        if($curso[0]->price_promotion == 0) {
            return redirect()->route('pay');
        }

        return $next($request);
    }
}
