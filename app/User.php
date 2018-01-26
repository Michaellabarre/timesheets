<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function timesheets(){
        return $this->hasMany(Timesheet::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
            // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    public function getTime(){
        return $this->timesheets->sum('hours');
    }

    public function getTaskTime($task = ""){

        $tasktype = Tasktype::where('name',$task)->first();

        return $this->timesheets()->where('tasktype_id',$tasktype->id)
            ->selectRaw('sum(hours) as sum')
            ->first()->sum;
    }

    public function getTimeByTask(){
        # code...
        //$arr = 
        return $this->timesheets()->with('tasktype')
            ->join('tasktypes', 'timesheets.tasktype_id', '=', 'tasktypes.id')
            ->groupBy('tasktype_id','tasktypes.name')
            ->selectRaw('sum(hours) as sum, tasktypes.name as name')
            ->pluck('sum','name');
    }
    
    public function getTimeByDate()
    {
        return $this->timesheets()->selectRaw('DATE(date) as date, sum(hours) as hours')
              ->groupBy('date')
              ->get();

    }
}
