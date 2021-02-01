<?php

namespace App\DataTables;

use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RatingsDataTable extends DataTable
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
            ->addColumn('action', function (Rating $rating) {
                $btn = '<a href="' . route('admin.ratings.destroy', $rating->id) . '"" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->editColumn('star', function (Rating $rating) {
                //change over here
                $html = '<div class="rating">';
                for ($i = 0; $i < (int)$rating->star; $i++) {
                    $html .= ' <i class="fa fa-star"></i>';
                }
                $html .= ' </div> ' . $rating->star;
                return $html;
            })
            ->editColumn('created_at', function (Rating $rating) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($rating->created_at));
            })
            ->rawColumns(['action', 'star']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RatingsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(RatingsDataTable $model)
    {
        // return $model->newQuery();
        $data = Rating::with('product', 'user')->get();
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
            ->setTableId('rating')
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
            Column::make('user.name')->title('Client'),
            Column::make('star')->title('Rating'),
            Column::make('product.name')->title('Produit'),
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
        return 'Ratings_' . date('YmdHis');
    }
}
