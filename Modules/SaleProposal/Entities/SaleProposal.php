<?php

namespace Modules\SaleProposal\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Config;
use Modules\Branch\Entities\Branch;
use Modules\Business\Entities\Business;
use Modules\Customer\Entities\Customer;
use Modules\Purchase\Enums\PurchasePayStatus;
use Modules\Sell\Enums\ShippingStatus;
use Modules\TaxRate\Entities\TaxRate;
use DNS1D;
class SaleProposal extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    
    public function business(){
        return $this->belongsTo(Business::class,'business_id','id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id','id');
    }
    
    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function TaxRate (){
        return $this->belongsTo(TaxRate::class,'order_tax_id','id');
    }
    public function saleItems(){
        return $this->hasMany(SaleProposalItem::class,'sale_proposal_id','id');
    }
 
    public function customer (){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function getTotalTaxAmountAttribute(){//total tax amount
        $taxRate              = $this->TaxRate->tax_rate;
        $total_sell_price     = $this->saleItems->sum('total_unit_price');
        $taxAmount            = ($total_sell_price/100)* $taxRate; 
        return $taxAmount;
    }
 
    public function getTotalSalePriceAttribute(){//total sale price with tax
        $taxRate              = $this->TaxRate->tax_rate;
        $total_sell_price     = $this->saleItems->sum('total_unit_price');
        $taxAmount            = ($total_sell_price/100)* $taxRate;
        $totalPriceWithTax    = ($total_sell_price + $taxAmount + $this->shipping_charge) - $this->discount_amount;
         
        return $totalPriceWithTax;
    }
 
    //payment
    public function payments(){
        return $this->hasMany(SaleProposalPayment::class,'sale_proposal_id','id');
    }

    public function getDueAmountAttribute(){
        $paymentAmount = $this->payments->sum('amount'); 
        $dueAmount     = ($this->TotalSalePrice - $paymentAmount);
        return $dueAmount;
    }
 
    public function getMyPaymentStatusAttribute(){
        $status = '';
        $totalPaymentAmount = $this->payments->sum('amount');
        if($totalPaymentAmount == 0):
            $status = '<span class="badge badge-pill badge-danger">'.__(Config::get('pos_default.purchase.payment_status.'.PurchasePayStatus::DUE)).'</span>';
        elseif($totalPaymentAmount < $this->TotalSalePrice):
            $status = '<span class="badge badge-pill badge-warning">'.__(Config::get('pos_default.purchase.payment_status.'.PurchasePayStatus::PARTIAL)).'</span><br>'.__('due').': '.businessCurrency($this->business_id).number_format($this->DueAmount,2);
        else:
            $status = '<span class="badge badge-pill badge-success">'.__(Config::get('pos_default.purchase.payment_status.'.PurchasePayStatus::PAID)).'</span>';
        endif; 
        return $status;
    }

    public function getMyShippingStatusAttribute(){
        $status = ''; 
        if($this->shipping_status == ShippingStatus::DELIVERED):
            $status = '<span class="badge badge-pill badge-success">'.__(Config::get('pos_default.shpping_status.'.$this->shipping_status)).'</span>';
        elseif($this->shipping_status == ShippingStatus::ORDERED):
            $status = '<span class="badge badge-pill badge-warning">'.__(Config::get('pos_default.shpping_status.'.$this->shipping_status)).'</span>';
        elseif($this->shipping_status == ShippingStatus::PACKED):
            $status = '<span class="badge badge-pill badge-dark">'.__(Config::get('pos_default.shpping_status.'.$this->shipping_status)).'</span>';
        elseif($this->shipping_status == ShippingStatus::SHIPPED):
            $status = '<span class="badge badge-pill badge-primary">'.__(Config::get('pos_default.shpping_status.'.$this->shipping_status)).'</span>';
        elseif($this->shipping_status == ShippingStatus::CANCELLED):
            $status = '<span class="badge badge-pill badge-danger">'.__(Config::get('pos_default.shpping_status.'.$this->shipping_status)).'</span>';
        endif;   
        return $status;
    }

    public function getBarcodeAttribute()
    {  
       return DNS1D::getBarcodeHTML($this->invoice_no, Config::get('pos_default.barcode_types.'.$this->business->barcode_type));
    }

}
