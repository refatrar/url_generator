<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Providers\RouteServiceProvider;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return Inertia::render('Welcome', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return Inertia::render('Create');
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'slug'=>Str::of($request->title)->slug('-'),
            'description' => $request->description
        ]);

        $post->param = DB::table('posts')
                    ->whereRaw('"param" NOT IN (SELECT param FROM posts WHERE param IS NOT NULL)')
                    ->selectRaw('lpad(conv(floor(rand()*pow(36,8)), 10, 36), 6, 0) AS param')
                    ->first()
                    ->param;

        $post->update();

        return redirect('/home');
    }

    public function show($param)
    {
        $post = Post::where('param', $param)->firstOrFail();

        return Inertia::render('Show', [
            'post' => $post
        ]);

    }
}
