<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;
    /**
 * fillable
 *
 * @var array
 */
protected $fillable = [
    'Tanggal',
    'PartNumber',
    'Operations',
    'Quantity',
];
}
