<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 't_order';
    protected $primaryKey = 'orderid';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // 一对多
    public function order_Passengers()
    {
        return $this->hasMany('App\Http\Model\Order_Passenger','orderid','orderid');
    }

    public function contacts()
    {
        return $this->hasMany('App\Http\Model\Order_Contact','orderid','orderid');

    }

    //多对多
    public function passengers(){
        return $this->belongsToMany('App\Http\Model\Passenger','t_order_passenger','orderid','passengerid','orderid','passengerid');
    }

    public function items()
    {
        return $this->hasMany('App\Http\Model\Order_Item_List','orderid','orderid');
    }

    public function payments()
    {
         return $this->hasMany('App\Http\Model\Order_Payment_Plan','orderid','orderid');
    }

    public function details()
    {
        //1. 使用ORM方式
      /*  $passengers =  $this->belongsToMany('App\Http\Model\Passenger','t_order_passenger','orderid','passengerid','orderid','passengerid')
            ->get();

        $collections = new Collection();
        foreach ($passengers as $passenger){
            $collections->push($passenger->detail);
        }
        return ($collections);*/

        //2
        $details = $this->belongsToMany('App\Http\Model\Passenger','t_order_passenger','orderid','passengerid','orderid','passengerid')
            ->join("t_assign_detail","t_passenger.file_no","=","t_assign_detail.file_no")
            ->select("t_assign_detail.*")
            ->get();
        foreach ($details as $detail) {
            dd($detail->file_no);
        }
        //dd($details->file_no);
    }


}
