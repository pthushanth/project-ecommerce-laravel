<?php

namespace App\DataTables;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
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
            ->addColumn('action', function (Sale $sale) {
                $btn = '<a href="' . route('admin.sales.edit', $sale->id) . '" class="edit btn btn-success btn-sm">Edit</a> <a href="' . route('admin.sales.destroy', $sale->id) . '"" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->editColumn('created_at', function (Sale $sale) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($sale->created_at));
            })

            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SalesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SalesDataTable $model)
    {
        // return $model->newQuery();
        $data = Sale::latest()->get();
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
            ->setTableId('sale')
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
            Column::make('name')->title('Libellé'),
            Column::make('discount_value')->title('Reduction'),
            Column::make('start')->title('Debut'),
            Column::make('end')->title('VFin'),
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
        return 'Sales_' . date('YmdHis');
    }
}
