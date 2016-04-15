<?php
/**
 * Created by PhpStorm.
 * User: nejc
 * Date: 14. 04. 2016
 * Time: 19:42
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LoginBan extends Model
{
    public $timestamps = true;
    protected $table = 'login_ban';
    protected $fillable = ['ip', 'username', 'fail_count', 'ban_expire'];
    protected $guarder = ['id'];

    public function isBanned()
    {
        return $this->fail_count >= 3 || $this->ban_expire > date('Y-m-d H:i:s');
    }

    public function incrementLoginAttempts()
    {
        $this->fail_count++;
        if ($this->fail_count >=3 ) {
            $this->ban_expire = date('Y-m-d H:i:s', strtotime('+ 5 min'));
        }
    }

    public function resetAttempts()
    {
        $this->fail_count = 0;
        $this->ban_expire = null;
    }
}