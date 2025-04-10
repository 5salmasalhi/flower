<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class]);
    }
    
    /**
     * Get the view factory instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function render($view, $data = [])
    {
        return view($view, $data)->with('layout', 'layouts.admin');
    }
}