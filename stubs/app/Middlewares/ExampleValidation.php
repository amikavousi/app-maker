<?php

namespace Modules\AppName\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExampleValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($this->getData(), $this->getRules(), $this->getMessages());
        if($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->getMessages() as $field => $error) {
                $errors[] = [
                    'field' => $field,
                    'error' => $error
                ];
            }
            return back()
                ->withInput()
                ->withErrors($validator, 'Example');
        }
        return $next($request);
    }

    private function getData()
    {
        //Todo: get your data
    }

    private function getRules()
    {
        //Todo: Enter Your Rules
    }

    private function getMessages()
    {
        //Todo: Customize Your Rules
    }
}
