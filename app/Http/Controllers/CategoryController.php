<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => SpladeTable::for(Category::class)
                ->column('name', 'Nome', true, false, true, true)
                ->withGlobalSearch(label: 'Buscar', columns: ['name'])
                ->column('slug', 'Slug', true, false, true)
                ->column('action', label: 'Ações', canBeHidden: false)
                ->paginate(5),
        ]);
    }
}
