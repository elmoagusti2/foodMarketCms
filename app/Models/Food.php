<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Food
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $ingredients
 * @property float|null $price
 * @property float|null $rate
 * @property string|null $types
 * @property string|null $picturePath
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date
 * @property-read mixed $picture_path
 * @method static \Illuminate\Database\Eloquent\Builder|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food wherePicturePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'ingredients', 'price', 'rate', 'types', 'picturePath'
    ];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getPicturePathAttribute()
    {
        return url('') . Storage::url($this->attributes['picturePath']);
    }
}
