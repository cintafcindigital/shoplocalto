<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrequentlyQuestions extends Model
{
    //
    public function field_data(){
    	return $this->hasOne('App\QuestionFields','question_id');
    }
}
