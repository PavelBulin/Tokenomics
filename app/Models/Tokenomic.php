<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Tokenomic extends Model
{
    use HasFactory;

    protected $fillable = [
          'category_id',
          'globalPercent',
          '1Mo', '2Mo', '3Mo',
          '4Mo', '5Mo', '6Mo',
          '7Mo', '8Mo', '9Mo',
          '10Mo', '11Mo', '12Mo',
          '13Mo', '14Mo', '15Mo',
          '16Mo', '17Mo', '18Mo',
          '19Mo', '20Mo', '21Mo',
          '22Mo', '23Mo', '24Mo',
          '25Mo', '26Mo', '27Mo',
          '28Mo', '29Mo', '30Mo',
          '31Mo', '32Mo', '33Mo',
          '34Mo', '35Mo', '36Mo',
          '37Mo', '38Mo', '39Mo',
          '40Mo', '41Mo', '42Mo',
          '43Mo', '44Mo', '45Mo',
          '46Mo', '47Mo', '48Mo',
          '49Mo',

    ];

    public function category() {
      return $this->belongsTo(Category::class);
    }
}