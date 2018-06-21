<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Task extends Model
{
  protected $fillable =
    [
      'user_id', 'deviceId', 'latitude', 'longitude', 'type'
    ];

  public function user(){
    return $this->belongsTo(User::class);
  }
}
