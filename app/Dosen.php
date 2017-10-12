<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $morphClass = 'App\Dosen';
    protected $dates = ['tanggal_lahir'];
    public function alamats(){
        return $this->morphMany('App\Alamat', 'alamatable');
    }
    public function no_telps(){
        return $this->morphMany('App\NoTelp', 'telponable');
    }
    public function emails(){
        return $this->morphMany('App\Email', 'emailable');
    }
}
