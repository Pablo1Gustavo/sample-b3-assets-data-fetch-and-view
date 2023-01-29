<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TickerSymbol extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function lending_open_positions(): HasMany
    {
        return $this->hasMany(LendingOpenPosition::class);
    }
}
