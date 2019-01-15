<?php

namespace App\Http\Middleware;

use Closure;

class BeforeAfter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $grid = session("grid");

            if (empty($grid)) {
                $grid = array();
            }
            $action = app('request')->route()->getAction();
            $controller = class_basename($action['controller']);
            list($controller, $action) = explode('@', $controller);
            $cur = $controller;

            if ($request->ajax() && $action == 'grid') {
                @$headers = apache_request_headers();
                if (!isset($headers['store'])) {
                    @$grid[$cur] = $_POST;
                    @session(["grid" => $grid]);
                }
            }

            $urlcurrent = url()->current();
            view()->share([
                'grid' => @$grid[$cur],
                'controller' => $controller,
                'action' => $action,
                'urlcurrent' => $urlcurrent,
                'linkedit' => str_replace('/edit', '', $urlcurrent),
                'linkadd' => str_replace('/create', '', $urlcurrent)
            ]);
            return $next($request);
        } catch (\Exception $e) {

        }
        return $next($request);
    }
}
