<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Factory;
use Alaouy\Youtube\Youtube;

use TrafficBow\Video;

class VideoCreateRequest extends Request
{

    protected $video_id = '';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $videoId = $this->route('videos');

        $exists = Video::where('id', $videoId)->where('user_id', \Auth::id())->exists();
        if (\Auth::user()->is_admin) {
            $exists = true;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'video_url' => 'required|url|validate_youtube_url|validate_unique_video',
            'title' => 'required',
            'illegal' => 'required',
            'illegal_other' => 'required_if:illegal_other_show,1',
            'year' => 'integer|between:2000,'.date('Y'),
        ];
        if ($this->method()=='PUT') {
            unset($rules['video_url']);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'video_url.required' => '請輸入影片網址',
            'title.required' => '請輸入影片標題',
            'illegal.required' => '請選擇違規行為',
            'illegal_other.required_if' => '請填寫其他違規行為',
            'year.integer' => '年份必須為數字',
            'year.between' => '年份必須為 :min 至 :max',
        ];
    }

    protected function validateYoutubeUrl(Factory $factory)
    {
        $factory->extend('validate_youtube_url', function ($attribute, $value, $parameters)
            {
                try {
                    $this->video_id = Youtube::parseVidFromURL($value);
                    if (!empty($this->video_id)) {
                        return true;
                    } else {
                        return false;
                    }
                } catch(\Exception $ex) {
                    return false;
                }
                return false;
            },
            '請輸入正確的 YouTube 影片網址'
        );
    }

    protected function validateUniqueVideo(Factory $factory)
    {
        $factory->extend('validate_unique_video', function ($attribute, $value, $parameters)
            {
                $count = Video::where('source_id', $this->video_id)->count();
                if ($count > 0) {
                    return false;
                }
                return true;
            },
            '此影片已經在我們的三寶影片資料庫了'
        );
    }

    public function getVideoId()
    {
        return $this->video_id;
    }

}
