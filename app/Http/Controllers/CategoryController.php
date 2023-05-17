<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use App\Tables\Categories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CategoryController extends Controller
{

    /**
     * Method Default to List Categories
     *
     * @return View
     */
    public function index(): View
    {
        return view('categories.index', [
            'categories' => Categories::class
        ]);
    }

    /**
     * Load Form to Create Category
     *
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store Category in Database
     *
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        Toast::title('Categoria cadastrada com Sucesso!')
            ->autoDismiss(5);

        return redirect()->route('categories.index');
    }

    /**
     * Load Edit View to Update Category
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update Category
     *
     * @param CategoryStoreRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryStoreRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        Toast::title('Categoria Editada com Sucesso!')
            ->autoDismiss(5);

        return redirect()->route('categories.index');
    }

    /**
     * Delete Category
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        Toast::success('Categoria excluída com sucesso!')->autoDismiss(3);

        return redirect()->back();
    }
}
