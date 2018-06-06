<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 't_order';

    /**
     * Eloquent 也会假定每个数据表都有一个名为 id 的主键字段。
     * 你可以定义一个访问权限为protected的 $primaryKey 属性来覆盖这个约定。
     */

    protected $primaryKey = 'orderid';
//    protected $primaryKey =  'id';

    /**
     * Eloquent 假定主键是一个递增的整数值，这意味着在默认情况下主键会自动转换为 int 。
     * 如果希望使用非递增或者非数字的主键，则必须在模型上设置 public $incrementing = false 。
     * 如果主键不是一个整数，你应该在模型上设置 protected $keyType = string 。
     */

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * 默认情况下，Eloquent 会默认数据表中存在 created_at 和 updated_at 这两个字段。
     * 如果你不需要这两个字段，则需要在模型内将 $timestamps 属性设置为 false
     */
    public $timestamps = false;


    /**
     * 使用 create 方法来保存新模型， 方法会返回模型实例.在使用之前，你需要先在模型上指定 fillable 或 guarded 属性
     * $fillable 可以作为允许注入的字段数组，$guarded 属性包含的是不允许被批量赋值的字段数组。
     * 注意，在使用上，只能是 $fillable 或 $guarded 二选一。
     */

    //protected $fillable = ['title', 'content']; // 允许插入的字段
    protected $guarded = [];  //空数组指允许插入所以字段


    // 一对多
    public function order_Passengers()
    {
        return $this->hasMany('App\Http\Model\Order_Passenger','orderid','orderid');
    }

    // 一对多
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
