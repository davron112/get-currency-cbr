<?php
namespace App\Models;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/11/20
 * Time: 3:58 PM
 */
use Illuminate\Database\Eloquent\Model;

class Currency extends Model {

    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'rate',
        'separator',
    ];
}