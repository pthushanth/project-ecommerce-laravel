<?php

namespace App\DataTables;

use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReviewsDataTable extends DataTable
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
            ->addColumn('action', function (Review $review) {
                $btn = '<a href="' . route('admin.reviews.destroy', $review->id) . '"" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->editColumn('created_at', function (Review $review) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($review->created_at));
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReviewsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ReviewsDataTable $model)
    {
        // return $model->newQuery();
        $data = Review::with('product', 'user')->get();
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
            ->setTableId('review')
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
            Column::make('review')->title('Commentaire'),
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
        return 'Reviews_' . date('YmdHis');
    }
}
