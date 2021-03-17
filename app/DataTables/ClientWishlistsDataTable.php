<?php

namespace App\DataTables;

use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientWishlistsDataTable  extends DataTable
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
            ->editColumn('product', function (Wishlist $whishlist) {
                $i = 1;
                $html = "";
                foreach ($whishlist->products as $product) {
                    $html .= '<a target="_blank" href="' . route('productDetail', $product->slug) . '">' . $i . " - " . $product->name . "</a></br>";
                    $i++;
                }
                return $html;
            })

            ->editColumn('product_image', function (Wishlist $whishlist) {
                $html = "";
                foreach ($whishlist->products as $product) {
                    $image = $product->image[0];
                    if ($image == 'noImage.jpg') {
                        $html .= '<a target="_blank" href="' . route('productDetail', $product->slug) . '"> <img src="' . asset("/storage/$image") . '"/> </a>';
                    } else {
                        $html .= '<a target="_blank" href="' . route('productDetail', $product->slug) . '"> <img src="' . asset("/storage/product_images/$image") . '"/></a>';
                    }
                }

                return $html;
            })
            ->editColumn('created_at', function (Wishlist $whishlist) {
                //change over here
                return date('d-M-Y H:i:s', strtotime($whishlist->created_at));
            })
            ->rawColumns(['product', 'product_image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ClientWishlistsDataTable  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClientWishlistsDataTable  $model)
    {
        // return $model->newQuery();
        $data = Wishlist::with('user', 'products')->where('user_id', auth()->user()->id)->latest()->get();
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
            ->setTableId('whishlist')
            ->AddTableClass('table table-striped table-bwhishlisted dt-responsive ')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->whishlistBy(1)
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
            Column::make('DT_RowIndex')->title('N°')->whishlistable(false)->searchable(false),
            Column::make('created_at')->title('Date'),
            Column::make('product')->title('Produit'),
            Column::make('product_image')->title('Produit image'),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Wishlists_' . date('YmdHis');
    }
}
