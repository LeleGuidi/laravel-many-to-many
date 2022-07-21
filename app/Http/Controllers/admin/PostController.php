<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $posts = Post::all();
        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:150|string',
            'content' => 'required|max:65535|string',
            'public' => 'sometimes|accepted',
            'category_id' => 'exists:categories,id|nullable', //l'id che arriva dalla select deve esistere nella tabella categories nella colonna id
            'tag_id' => 'exists:tags,id|nullable', //l'id che arriva dalla select deve esistere nella tabella tag nella colonna id
        ]);

        $data = $request->all();
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->slug = $this->getSlug($data['title']);
        $newPost->public = isset($data['public']);
        $newPost->save();

        $tag = Tag::find($data['tag_id']);
        $newPost->tags()->attach($tag);
        

        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:150|string',
            'content' => 'required|max:65535|string',
            'public' => 'sometimes|accepted',
            'category_id' => 'exists:categories,id|nullable',
        ]);

        $data = $request->all();
        if( $post->title != $data['title'] ) {
            $post->slug = $this->getSlug($data['title']);
        }
        $post->fill($data);
        $post->public = isset($data['public']);
        $post->save();

        $tag = Tag::find($data['tag_id']);
        $post->tags()->sync($tag);

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post ->delete();

        return redirect()->route('admin.posts.index');
    }

    private function getSlug($title) {
        $slug = Str::slug($title, '-');
        $count = 1;

        while( Post::where('slug', $slug)->first() ) {
            $slug = Str::slug($title, '-') . "-{$count}";
            $count++;
        }

        return $slug;
    }
}
