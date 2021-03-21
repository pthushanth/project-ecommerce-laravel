<?php

namespace App\DataTables;

use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductAttributesDataTable extends DataTable
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
            ->addColumn('action', function (Attribute $attribute) {
                $btn = '<a href="' . route('admin.attributes.edit', $attribute->id) . '" class="edit btn btn-info"><i class="far fa-edit"></i></a> <a href="' . route('admin.attributes.destroy', $attribute->id) . '"" id="delete" class="delete btn btn-danger"><i class="fas fa-trash"></i></a>';
                return $btn;
            })
            ->editColumn('created_at', function (Attribute $attribute) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($attribute->created_at));
            })
            ->editColumn('categories.name', function (Attribute $attribute) {
                $i = 1;
                $html = "";
                foreach ($attribute->categories as $category) {
                    $html .= $i . " - " . $category->name . "</br>";
                    $i++;
                }
                return $html;
            })

            ->rawColumns(['action', 'categories.name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AttributesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductAttributesDataTable $model)
    {
        // return $model->newQuery();
        $data = Attribute::with('categories')->latest()->get();
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
            ->setTableId('attribute')
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
            Column::make('name')->title('Nom'),
            Column::make('categories.name')->title('Catégorie'),
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
        return 'Attributes_' . date('YmdHis');
    }
}
