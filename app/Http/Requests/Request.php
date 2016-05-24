<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;

abstract class Request extends FormRequest
{

    public function __construct(Factory $factory)
    {
        parent::__construct();
        foreach (get_class_methods($this) as $method) {
            if (preg_match('#validate[\w]+#', $method)) {
                $this->{$method}($factory);
            }
        }
    }

    public function all()
    {
        $input = parent::all();

        foreach ($input as $key => $val) {
            if (is_string($val)) {
                $input[$key] = trim($val);
            }
        }

        return $input;
    }

}
