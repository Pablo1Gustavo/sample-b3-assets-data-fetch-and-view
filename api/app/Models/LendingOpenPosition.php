<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class LendingOpenPosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('ticker_symbol', function (Builder $builder) {
            $builder->with('ticker_symbol');
        });
    }

    public function ticker_symbol(): BelongsTo
    {
        return $this->belongsTo(TickerSymbol::class);
    }
}
