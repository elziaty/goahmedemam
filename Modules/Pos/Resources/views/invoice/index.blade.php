
<div class="tab-pane fade @if( $request->pos_page ) show active @endif" id="pills-pos-invoice" role="tabpanel" aria-labelledby="pills-pos-invoice-tab" tabindex="0">                            
    <div class="text-right my-3">
        <a class="btn btn-sm btn-primary" href="{{ route('pos.index') }}"><i class="fa fa-plus"></i> {{ __('add') }} {{ __('pos') }}</a>
    </div>
    <!-- Responsive Dashboard Table -->
    <div class="table-responsive category-table">
        <table class="table pos-invoice-table table-striped table-hover text-left">
            <thead>
                <tr class="border-bottom">
                    <th>#</th>  
                    <th>{{ __('date') }}</th>  
                    <th>{{ __('invoice_no') }}</th>   
                    <th>{{ __('branch') }}</th>   
                    <th>{{ __('customer_details') }}</th>   
                    <th>{{ __('payment_status') }}</th>   
                    <th>{{ __('total') }}</th>  
                    <th>{{ __('action') }}</th>   
                </tr>
            </thead>  
            <tbody  >  
                <tr class="odd">
                    <td valign="top" colspan="12" class="dataTables_empty">
                        <div class="text-center">
                            <img class="emptyTables" src="{{settings('table_search_image') }}" width="20%" >
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Responsive Dashboard Table -->
 
</div>
