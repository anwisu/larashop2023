<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\Order;

class Item extends Model implements HasMedia, Searchable
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'item'; 
    protected $primaryKey = 'item_id';
    public $fillable = ['description', 'sell_price', 'cost_price', 'image_path'];
    

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orderline', 'item_id', 'orderinfo_id')->withPivot('quantity');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class,'item_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('item.show', $this->item_id);
    
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}