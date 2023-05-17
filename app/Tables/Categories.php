<?php

namespace App\Tables;

use App\Models\Category;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Categories extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Category::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name'])
            ->column('id', sortable: true)
            ->column('name', 'Nome', true, false, true, true)
            ->column('slug', 'Slug', true, false, true)
            ->column('updated_at', label: 'Última Atualização')
            ->column('action', label: 'Ações', canBeHidden: false, exportAs: false)
            ->export(
                label: 'Splade_categorias',
                filename: 'Splade_categorias.csv',
                type: Excel::CSV
            )
            ->bulkAction(
                label: 'Touch timestamp',
                each: fn (Category $category) => $category->touch(),
                before: fn () => info('Touching the selected projects'),
                after: fn () => Toast::info('Timestamps updated!')
            )
            ->bulkAction(
                confirm: 'Deseja realmente excluir as categorias selecionadas?',
                label: 'Excluir Selecionadas',
                each: fn (Category $category) => $category->delete(),
                before: fn () => info('Touching the selected projects'),
                after: fn () => Toast::info('Categories Excluidas!')
            )
            ->paginate(5);
    }
}
