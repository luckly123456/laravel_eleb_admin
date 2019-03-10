<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    //
    protected $fillable = ['name','pid','url','permission_id'];

    public static function navBar()
    {
        $html = '';
        $navs = self::where('pid',1)->get();
        foreach ($navs as $nav){
            $children_html = '';
            foreach ($nav->children as $child){
//                if(Auth::user()->can($child->pemission->name)){
                    $children_html .= '<li><a href="'.url($child->url).'">'.$child->name.'</a></li>';
//                }
            }

            if($children_html){
                $html .= ' <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        '.$nav->name.'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                $html .= $children_html;
                $html .= '</ul></li>';
            }
        }

        return $html;
    }


    public function children()
    {
        return $this->hasMany(self::class,'pid','id');
    }


    //导航菜单 权限关系
    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id','id');
    }

}
