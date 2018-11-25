<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MongoProduct extends Eloquent
{
    protected $collection = 'mongo_products';

    protected $connection = 'mongodb';

    protected $fillable = ['product_id', 'category_id', 'comments', 'mark', 'count'];


}
