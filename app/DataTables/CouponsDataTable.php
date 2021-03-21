<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponsDataTable extends DataTable
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
            ->addColumn('action', function (Coupon $coupon) {
                $btn = '<a href="' . route('admin.coupons.edit', $coupon->id) . '" class="edit btn btn-info"><i class="far fa-edit"></i></a> <a href="' . route('admin.coupons.destroy', $coupon->id) . '"" id="delete" class="delete btn btn-danger"><i class="fas fa-trash"></i></a>';
                return $btn;
            })
            ->editColumn('created_at', function (Coupon $coupon) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($coupon->created_at));
            })

            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CouponsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CouponsDataTable $model)
    {
        // return $model->newQuery();
        $data = Coupon::latest()->get();
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
            ->setTableId('coupon')
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
            Column::make('id')->title('Id marque'),
            Column::make('created_at')->title('Date'),
            Column::make('code')->title('Code promo'),
            Column::make('discount_type')->title('Type'),
            Column::make('discount_value')->title('Valeur'),
            Column::make('start')->title('Debut'),
            Column::make('end')->title('Valable jusqu\'à'),
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
        return 'Coupons_' . date('YmdHis');
    }
}
