<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model
{
    /**
     * Database table this model represents.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primary_key = 'id';
}
