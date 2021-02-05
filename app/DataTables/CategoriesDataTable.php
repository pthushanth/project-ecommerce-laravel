<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()->of($query)
            ->addIndexColumn()
            ->addColumn('action', function (Category $category) {
                $btn = '<a href="' . route('admin.categories.edit', $category->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('admin.categories.destroy', $category->id) . '"" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->editColumn('created_at', function (Category $category) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($category->created_at));
            })

            ->editColumn('image', function (Category $category) {
                //change over here
                if ($category->image == 'noImage.jpg')
                    return '<img src="' . asset("/storage/$category->image") . '"/>';
                return '<img src="' . asset("/storage/category_images/$category->image") . '"/>';
            })
            ->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CategoriesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CategoriesDataTable $model)
    {
        // return $model->newQuery();
        $data = Category::latest()->get();
        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->responsive(true)
            ->setTableId('category')
            ->AddTableClass('table table-striped table-bordered dt-responsive ')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('excel'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                Button::make('colvis'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('N°')->orderable(false)->searchable(false),
            Column::make('created_at')->title('Date'),
            Column::make('image')->title('Image'),
            Column::make('name')->title('Nom'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'categories_' . date('YmdHis');
    }
}