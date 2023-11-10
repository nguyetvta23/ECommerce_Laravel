<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 't_category';

    const ID_ROOT = 0;

    const INDEX_START = 1;

    const FIELD_ID= 'id';

    const FIELD_ID_PARENT= 'm_id_parent';

    const FIELD_TITLE = 'm_title';

    const FIELD_INDEX = 'm_index';

    public $timestamps = false;

    public function getAllCategory($idParent = 0) {
        $list = [];
        $currentList = DB::table('t_category')
                ->where(self::FIELD_ID_PARENT,$idParent)
                ->orderBy(self::FIELD_INDEX,'ASC')
                ->orderBy(self::FIELD_ID,'ASC')
                ->get();

        //$currentList=(array)$currentList;
        if ($currentList != false) {
            foreach ($currentList as $currentItem) {
                $currentItem->subCategory = $this->getAllCategory($currentItem->{self::FIELD_ID});
                array_push($list, $currentItem);
            }
        }
        return $list;
    }

    public function children()
    {
        return $this->hasMany(self::class, 'm_id_parent', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'm_id_parent');

    }
    public function tongproduct(){
        return $this->hasMany(product::class, 'm_id_category', 'id');
    }
}