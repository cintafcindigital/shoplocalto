<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use View;
use App\Vendor;
use App\User;
use App\FrequentlyQuestions;
use App\QuestionFields;
use App\Category;
use App\AssignQuestions;

class AdminFrequentlyQuestionsController extends Controller
{
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct()
    {
        $this->middleware('auth:admin');
        $data['new_users'] = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['new_vendors'] = Vendor::whereDate('created_at', DB::raw('CURDATE()'))->count();
        View::share('slideBar',$data);
    }

    public function questions(){
       $questionData = FrequentlyQuestions::with('field_data')->get();
       return view('admin.question.list',['questions'=>$questionData]);
    }

    public function add_questions(){
       return view('admin.question.add');
    }

    public function save_questions(Request $request){

    	 $this->validate($request, [
          'title' => 'required|string',
          'type' => 'required',
          'label_title' => 'required',
          ],['title.required' => ' Question field is required.',
           'type.required' => ' Field type is required.',
           'label_title.required' => ' Frontend label is required.',
        ]);

        $quesObj = new FrequentlyQuestions;
        $quesObj->title = $request->input('title');
        $quesObj->type = $request->input('type');
        $quesObj->description = $request->input('descriptions');
        $quesObj->note = $request->input('label_title');
        $quesObj->status = 1;
        $data = $quesObj->save();
        if($data){
          $questField = new QuestionFields;
          $questField->question_id = $quesObj->id;
          $questField->label_title = $request->input('label_title');
          $questField->label_slug = str_slug($request->input('label_title'), '-');
          $questField->options = json_encode($request->input('options'));
          $questField->status = 1;
          $data = $questField->save();
          return redirect()->back()->with('success', 'Question has been added successfully.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function delete_question($id){
        FrequentlyQuestions::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Question Deleted Successfully.');
    }

     protected function status_question($id,$status)
    {
        $tstObj = FrequentlyQuestions::find($id);
        $tstObj->status = $status;
        $data = $tstObj->save();
        if($data){
          return redirect()->back()->with('success', 'Question status has been updated.');
        }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
        }
    }

    protected function add_to_category(){
       $questions = FrequentlyQuestions::where('status',1)->get();
       $categories = Category::select('categories.*','CT.title as parent_title')->leftJoin('categories as CT','categories.parent_id','=','CT.id')->where('categories.status',1)->where('categories.is_parent','<>',1)->get();
       return view('admin.question.add_to_category',['questions'=>$questions,'categories'=>$categories]);
    }

    protected function save_to_category(Request $request){
        $this->validate($request, [
          'question_id' => 'required',
          'cat_id' => 'required',
          ],['question_id.required' => ' Question field is required.',
           'cat_id.required' => ' Category field is required.',
        ]);
      
       $questionId = $request->input('question_id');
       $categoryId = $request->input('cat_id');
       if(isset($categoryId) && !empty($categoryId)){
         $valHandler = array();
          foreach($categoryId as $key=>$cat){
             $valHandler[$key]['question_id'] = $request->input('question_id');
             $valHandler[$key]['cat_id'] = $cat;
             $valHandler[$key]['is_mandatory'] = ($request->input('is_mandatory') !== null)?$request->input('is_mandatory'):0;
             $valHandler[$key]['sequence_number'] = $request->input('sequence_number');
             $valHandler[$key]['created_at'] = new \DateTime();
             $valHandler[$key]['status'] = 1;
          }
       }
       $data = AssignQuestions::insert($valHandler);
       if($data){
          return redirect()->back()->with('success', 'Question has been assigned successfully.');
       }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
       }
    }

    protected function edit_to_category($id){
       $questions = FrequentlyQuestions::where('status',1)->get();
       $assignedQues = AssignQuestions::where('question_id',$id)->get()->toArray();
       $categories = Category::select('categories.*','CT.title as parent_title')->leftJoin('categories as CT','categories.parent_id','=','CT.id')->where('categories.status',1)->where('categories.is_parent','<>',1)->get();
       return view('admin.question.edit_to_category',['questions'=>$questions,'categories'=>$categories,'assign_questions'=>$assignedQues,'ques_id'=>$id]);
    }

    protected function update_to_category(Request $request){
        $this->validate($request, [
          'question_id' => 'required',
          'cat_id' => 'required',
          ],['question_id.required' => ' Question field is required.',
           'cat_id.required' => ' Category field is required.',
        ]);
      
       $questionId = $request->input('question_id');
       $categoryId = $request->input('cat_id');
       if(isset($categoryId) && !empty($categoryId)){
       	 $valHandler = array();
          foreach($categoryId as $key=>$cat){
             $valHandler[$key]['question_id'] = $request->input('question_id');
             $valHandler[$key]['cat_id'] = $cat;
             $valHandler[$key]['is_mandatory'] = ($request->input('is_mandatory') !== null)?$request->input('is_mandatory'):0;
             $valHandler[$key]['sequence_number'] = $request->input('sequence_number');
             $valHandler[$key]['created_at'] = new \DateTime();
             $valHandler[$key]['updated_at'] = new \DateTime();
             $valHandler[$key]['status'] = 1;
          }
       }
       $deletedRows = AssignQuestions::where('question_id', $questionId)->delete();
       $data = AssignQuestions::insert($valHandler);
       if($data){
          return redirect()->back()->with('success', 'Question has been assigned successfully.');
       }else{
          return redirect()->back()->with('success', 'Something went wrong. Please try again.');
       }
    }



}
