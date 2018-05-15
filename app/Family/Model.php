<?php

namespace App\Family;

use Illuminate\Database\Eloquent\Model as DbModel;

class Model extends DbModel
{
    /**
     * @var string
     *
     * The name of the database connection to use for these models
     */
    protected $connection = 'family';
}
