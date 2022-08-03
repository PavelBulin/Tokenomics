<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

  //   protected $fillable = [
  //     'name',
  //     'globalPercent',
  //     'adress',
  //     'raund',
  //     'blocked',
  //     'unblocked',
  // ];

  protected $fillable = [
    'address', 'raund',
    'blocked', 'unlocked',
    'timeToUnlock', 'timeToFullUnlock',
  ];
}