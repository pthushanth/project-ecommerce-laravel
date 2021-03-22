<?php

namespace App\DataTables;

use App\Models\Stock;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StocksDataTable extends DataTable
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
            ->addColumn('action', function (Stock $stock) {
                $btn = '<a href="' . route('admin.stocks.edit', $stock->id) . '" class="edit btn btn-info"><i class="far fa-edit"></i></a>';
                return $btn;
            })
            ->editColumn('created_at', function (Stock $stock) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($stock->created_at));
            })
            ->editColumn('image', function (Stock $stock) {
                // var_dump($stock->id);
                $image = $stock->product->getThumbnailUrl();
                return '<img src="' . asset($image) . '"/>';
            })
            ->rawColumns(['action', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StocksDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StocksDataTable $model)
    {
        $data = Stock::with('product')->get();
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
            ->setTableId('stock')
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
            Column::make('updated_at')->title('Dernière mise à jour'),
            Column::make('image')->title('Images'),
            Column::make('product.name')->title('Produit'),
            Column::make('stock')->title('Stock'),
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
        return 'Stocks_' . date('YmdHis');
    }
}
