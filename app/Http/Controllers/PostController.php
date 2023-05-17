<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Tables\Posts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    /**
     * Method Default to List Posts
     *
     * @return View
     */
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Posts::class
        ]);
    }

    /**
     * Load Form to Create Post
     *
     * @return View
     */
    public function create(): View
    {
        return view('posts.create', [
            'categories' => Category::pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Store Post
     *
     * @param PostStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        Toast::title('Post cadastrado com sucesso!')
            ->autoDismiss(3);

        return redirect()->route('posts.index');
    }

    /**
     * Load Edit Form to Update Post
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update Post
     *
     * @param PostStoreRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostStoreRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());

        Toast::title('Post Editado com Sucesso!')
            ->autoDismiss(3);

        return redirect()->route('posts.index');
    }

    /**
     * Delete Post
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        Toast::success('Post excluído com sucesso!');

        return redirect()->back();
    }
}
