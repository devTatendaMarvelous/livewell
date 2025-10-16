<?php

namespace App\Services;

use App\Traits\HasApiCalls;

class MemberService
{
    use HasApiCalls;
    public function getMember($request){
        $response = $this->getRequest("/members/find-by-mobile/$request->mobile");
        dd($response);
    }

}
