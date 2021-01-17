<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
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
            ->addColumn('action', function (Order $order) {
                $btn = '<a href="' . route('admin.orders.destroy', $order->id) . '"" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->editColumn('product', function (Order $order) {
                // return $query->products->map(function ($product) {
                //     // return str_limit($product->name, 30, '...');
                //     return $product->name;
                // })->implode('<br>');
                $i = 1;
                $html = "";
                foreach ($order->products as $product) {
                    $html .= $i . " - " . $product->name . "</br>";
                    $i++;
                }
                return $html;
            })
            // ->editColumn('product_image', function (Order $order) {
            //     $html = "";
            //     foreach ($order->products as $product) {
            //         if ($product->image == 'noImage.jpg')
            //             $html .= '<img src="' . asset("/storage/$product->image") . '"/>';
            //         else {
            //             $html .= '<img src="' . asset("/storage/product_images/$product->image") . '"/>';
            //         }
            //     }
            //     return $html;
            // })
            ->editColumn('product_image', function (Order $order) {
                $html = "";
                foreach ($order->products as $product) {

                    foreach ($product->image as $index => $image) {
                        if ($image == 'noImage.jpg') {
                            $html .= '<img src="' . asset("/storage/$image") . '"/>';
                        } else {
                            $html .= '<img src="' . asset("/storage/product_images/$image") . '"/>';
                        }
                    }
                }

                return $html;
            })
            ->editColumn('created_at', function (Order $order) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($order->created_at));
            })
            ->rawColumns(['action', 'product', 'product_image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrdersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrdersDataTable $model)
    {
        // return $model->newQuery();
        $data = Order::with('user', 'products', 'orderStatus')->latest()->get();
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
            ->setTableId('order')
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
            Column::make('id')->title('Id Order'),
            Column::make('created_at')->title('Date'),
            Column::make('amount')->title('Montant'),
            Column::make('payment_status')->title('status de paiement'),
            Column::make('user.email')->title('Client mail'),
            Column::make('order_status.status')->title('status commande'),
            Column::make('product')->title('Produit'),
            Column::make('product_image')->title('Produit image'),
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
        return 'Orders_' . date('YmdHis');
    }
}
