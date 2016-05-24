<?php

namespace TrafficBow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * TrafficBow\News
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $user_id
 * @property string $source_url
 * @property string $author
 * @property string $title
 * @property string $description
 * @property string $tags
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereSourceUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereAuthor($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TrafficBow\News whereDeletedAt($value)
 */
class News extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

}
