<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
    ];


   public $with = ['meta'];
   public $append = ['item_total'];

    public function meta(){
        return $this->hasMany(InvoiceItemMeta::class);
    }

    public function getMeta($name){
        return $this->meta()->where('name', $name)->first();
    }

    public function getItemTotalAttribute(){
        // get meta formula
        if($formulaCol = $this->getMeta('formular')){
            $formular = $formulaCol->value;
            $total_amount = evaluate_formular($formular, 'InvoiceItemMeta', $this->id );
            return $total_amount;
        }
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }


}
