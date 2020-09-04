<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Item;

class check_item_stock implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->msg = '';
    }
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $item = Item::find($this->id);
        if ($item->stok==0) {
            $this->msg = 'Barang ini habis ..!';
            return false;
        } elseif ($item->stok<$value) {
            $this->msg = 'Jumlah tidak boleh lebih besar dari stok barang';
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
