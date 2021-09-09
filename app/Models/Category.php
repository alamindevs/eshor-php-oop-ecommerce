<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'categories';

    public function statusButton() {
        if ( $this->status == 1 ) {
            return '<span class="badge badge-sm bg-gradient-success">Publish</span>';
        } else {
            return '<span class="badge badge-sm bg-gradient-danger">UnPublish</span>';
        }
    }
}