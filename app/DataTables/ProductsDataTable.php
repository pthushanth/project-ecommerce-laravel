<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            // ->addColumn('spec', function (Product $product) {
            //     $champs = "<table>";
            //     foreach ($product->extra_champs as $extra) {
            //         $champs .= "<tr>";
            //         $champs .=  "<td>" . $extra['champs'] . ": </td>";
            //         $champs .=  "<td>" . $extra['value'] . " </td>";
            //         $champs .= "</tr>";
            //     }
            //     $champs .= "</table>";

            //     return  $champs;
            // })
            ->editColumn('image', function (Product $product) {
                $html = "";
                // dd($product->image[1]);
                foreach ($product->image as $index => $image) {
                    // var_dump($image);
                    if ($image == 'noImage.jpg')
                        $html .= '<img src="' . asset("/storage/$image") . '"/>';
                    else {
                        $html .= '<img src="' . asset("/storage/product_images/$image") . '"/>';
                    }
                }
                return $html;
            })

            ->editColumn('status', function (Product $product) {
                //change over here

                if ($product->status) return '<label class="badge badge-success">Activé</label>';
                if (!$product->status) return '<label class="badge badge-warning">Désactivé</label>';
            })

            ->editColumn('created_at', function (Product $product) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($product->created_at));
            })

            ->addColumn('action', function (Product $product) {
                $btn = '<a href="' . route('admin.products.edit', $product->id) . '" class="edit btn btn-info btn-sm">Edit</a> 
                        <a href="' . route('admin.products.destroy', $product->id) . '"" id="delete" class="delete btn btn-danger btn-sm">Delete</a>';

                if ($product->status) $btn .= ' <a href="' . route('admin.products.desactivate', $product->id) . '" class="edit btn btn-warning btn-sm">Désactivé</a>';
                if (!$product->status) $btn .= ' <a href="' . route('admin.products.activate', $product->id) . '" class="edit btn btn-success btn-sm">Activé</a>';
                return $btn;
            })
            ->rawColumns(['action', 'status', 'image', 'spec']);
        // ->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\productsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductsDataTable $model)
    {
        // return $model->newQuery();
        $data = Product::latest()->get();
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
            ->setTableId('product')
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
            Column::make('image')->title('Images'),
            Column::make('price')->title('Prix'),
            Column::make('status')->title('visilbilité'),
            Column::make('spec')->visible(false),
            Column::make('short_description')->title('Description court'),
            Column::make('long_description')->title('Description long')->visible(false),
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
        return 'products_' . date('YmdHis');
    }
}
