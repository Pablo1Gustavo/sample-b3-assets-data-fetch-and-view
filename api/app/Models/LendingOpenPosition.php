<?php
namespace App\Models;

use App\Http\Requests\LendingOpenPositionFilterRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class LendingOpenPosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['id'];

    protected $fillable = [
        'isin',
        'date',
        'ticker_symbol_id',
        'balance_amount',
        'average_price',
        'total_balance'
    ];

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

    public function scopeAsset($query, int $id): Builder
    {
        return $query->where('ticker_symbol_id', $id);
    }

    public function scopeStartDate($query, string $startDate)
    {
        return $query->where('date', '>=', $startDate);
    }

    public function scopeEndDate($query, string $endDate)
    {
        return $query->where('date', '<=', $endDate);
    }

    public function scopeDateExists($query, string $date)
    {
        return $query->where('date', $date)->exists();
    }
}
