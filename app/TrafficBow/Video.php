<?php

namespace TrafficBow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * TrafficBow\Video
 *
 * @mixin \Eloquent
 */
class Video extends Model
{

    use SoftDeletes;

    const SOURCE_SITE_YOUTUBE = 'YouTube';

    protected $guarded = ['id'];

    /**
     * Get illegal type list
     *
     * @return array
     */
    public static function illegalTypes()
    {
        $illegalTypes = config('video.illegal_types');
        $config = [];
        foreach ($illegalTypes as $name) {
            $config[$name] = $name;
        }
        return $config;
    }

    /**
     * Get video place
     *
     * @return array
     */
    public static function places()
    {
        $configPlaces = config('video.places');
        $config = [];
        foreach ($configPlaces as $placeGroup => $places) {
            if (is_array($places)) {
                foreach ($places as $name) {
                    $config[$placeGroup][$name] = $name;
                }
            } else {
                $config[$placeGroup] = $places;
            }
        }
        return $config;
    }

    public function formatForEdit()
    {
        $illegalTags = [];
        $illegalOther = [];
        $illegalTypes = self::illegalTypes();
        foreach (explode(',', $this->illegal) as $tag) {
            if (isset($illegalTypes[$tag])) {
                $illegalTags[] = $tag;
            } else {
                $illegalOther[] = $tag;
            }
        }
        $this->setAttribute('illegal', $illegalTags);
        $this->setAttribute('illegal_other', join(',', $illegalOther));
        $this->setAttribute('illegal_other_show', count($illegalOther) > 0 ? true : false);
    }

    public function getIllegalArray()
    {
        $illegalArray = [];
        if (!empty($this->illegal)) {
            $illegalArray = explode(',', $this->illegal);
            foreach ($illegalArray as $key => $val) {
                if ($val=='其他') {
                   unset($illegalArray[$key]);
                }
            }
        }
        return $illegalArray;
    }

    public function getVideoThumbnail()
    {
        return 'https://i.ytimg.com/vi/'.$this->source_id.'/hqdefault.jpg';
    }

    public function getVideoUrl()
    {
        return 'https://www.youtube.com/watch?v='.$this->source_id;
    }

}
