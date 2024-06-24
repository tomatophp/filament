<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $table_id
 * @property string $name
 * @property string $type
 * @property integer $length
 * @property string $default
 * @property string $comment
 * @property string $foreign_table
 * @property string $foreign_col
 * @property string $foreign_model
 * @property boolean $nullable
 * @property boolean $index
 * @property boolean $auto_increment
 * @property boolean $primary
 * @property boolean $unique
 * @property boolean $unsigned
 * @property boolean $foreign
 * @property boolean $foreign_on_delete_cascade
 * @property string $created_at
 * @property string $updated_at
 * @property Table $table
 */
class TableCol extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['table_id', 'name', 'type', 'length', 'default', 'comment', 'foreign_table', 'foreign_col', 'foreign_model', 'nullable', 'index', 'auto_increment', 'primary', 'unique', 'unsigned', 'foreign', 'foreign_on_delete_cascade', 'created_at', 'updated_at'];

    protected $casts = [
        'nullable' => 'boolean',
        'index' => 'boolean',
        'auto_increment' => 'boolean',
        'primary' => 'boolean',
        'unique' => 'boolean',
        'unsigned' => 'boolean',
        'foreign' => 'boolean',
        'foreign_on_delete_cascade' => 'boolean'
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo('App\Models\Table');
    }
}
