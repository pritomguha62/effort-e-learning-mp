<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Admin_user;
use App\Models\Course;
use App\Models\Member_user;
use App\Models\Online_class;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\FileExists;

class MemberUserController extends Controller
{
    public function member_register() {

        $courses = Course::all();

        return view('member_view.register', compact('courses'));
    }

    public function member_login() {

        return view('member_view.login');
    }
    

    public function dashboard() {

        $courses = Course::all();

        $classes = Online_class::latest()->limit(6)->get();

        return view('member_view.dashboard', compact('courses', 'classes'));

    }
    
    public function member_register_info(Request $request){

        $request->validate(
            [
            "name" => "required",
            "phone" => "required",
            "email" => "required|email|unique:member_users",
            "whatsapp" => "required",
            "gender" => "required",
            "home_town" => "required",
            "city" => "required",
            "country" => "required",
            "parent_user_code" => "required",
            // "course_id" => "required",
            "password"=> "required|min:8|max:16",
            "confirm_password"=> "required|same:password",
            "terms_condition"=> "required",
        ]);

        $parent_user_admin = Admin_user::where('user_code', $request->parent_user_code)->first();
        $parent_user_member = Member_user::where('user_code', $request->parent_user_code)->first();

        if (empty($parent_user_admin)) {
            if (empty($parent_user_member)) {
                return back()->with('error', 'Refer code is invalid..!');
            }
        }
        
        $member = new Member_user();

        

        $pro_pic_name = null;

        if (!empty($request->pro_pic)) {

            $request->validate([
                "pro_pic"=> "required|max:7240",
            ]);

            $name = $request->name;
            $pro_pic_name = $name.'_pro_pic_'.date("Y_m_d_h_i_sa").'.'.$request->file('pro_pic')->getClientOriginalExtension();
            $request->file('pro_pic')->move(public_path('storage/uploads/pro_pic/'), $pro_pic_name);


        }

        $member->name = $request->name;
        $member->phone = $request->phone;
        $member->email = $request->email;
        $member->whatsapp = $request->whatsapp;
        $member->gender = $request->gender;
        $member->home_town = $request->home_town;
        $member->city = $request->city;
        $member->country = $request->country;
        $member->balance = $request->balance;
        $member->gender = $request->gender;
        $member->parent_user_code = $request->parent_user_code;
        if (!empty($parent_user_admin)) {
            $member->group_leader_code = $parent_user_admin->user_code;
        }else {
            $group_leader = Admin_user::where('user_code', $parent_user_member->group_leader_code)->first();
            $member->group_leader_code = $group_leader->user_code;
        }
        $member->course_id = $request->course_id;
        $member->pro_pic = $pro_pic_name;
        $member->role_id = 11;
        $member->password = Hash::make($request->password);
        $member->save();

        session()->put('email', $request->email);
        
        $last_member_user = Member_user::where('email', session()->get('email'))->first();

        $last_number = $last_member_user->member_id;
        
        $string_user_code = date('y').'000000';

        $user_code = intval($string_user_code)+$last_number;

        $last_member_user->user_code = $user_code;

        $last_member_user->update();


        $subject = 'New application received.';

        $body = '
        Hello Sir, <br><br>
        New application was received. Please check your admission application dashboard. <br> <br>
        Thank you <br>
        Effort E-learning MP.
        ';
        Mail::to('mpeffortelearning@gmail.com')->send(new SendMail($subject, $body));

        return redirect()->route('member.token_verify')->with('success', 'Registration complete, please verify email..!');

    }
    
    public function member_token_verify(){
        
        $verify_token = rand(100000,999999);

        $member = Member_user::where('email', session()->get('email'))->first();
        
        $member->verify_token = $verify_token;
        $member->update();

        session()->put('verify_token', $verify_token);

        $subject_member = 'Mail verification request.';

            
        $body_member = '
        Hello Sir, <br><br>
        Your otp is <br><br>'.$verify_token.' <br> <br>
        Provide the otp to verify account. <br>
        Thank you, <br>
        Effort E-learning MP.
        ';

        Mail::to($member->email)->send(new SendMail($subject_member, $body_member));

        return view('member_view.member_token_verify');
    }

    public function member_token_verification(Request $request){

        $email_token_submit = Member_user::where('email', session()->get('email'))->where('verify_token', $request->verify_token)->update([ 'email_verified' => 1 ]);
        
            if($email_token_submit){
                
                session()->put('email_verified', 1);
                session()->forget('verify_token');

                return redirect(route('member.login'))->with('success', 'Email successfully verified. You will be notified by email if your registration is approved or not..!');
            }else {
                return redirect(route('member.token_verify'))->with('error', 'Email can not be verified, please retry..!');
            }

    }
    
    public function check_login(Request $request){


        $request->validate(
            [
            "email_whatsapp" => "required",
            "password"=> "required|min:8|max:16",
        ]);

        $email_whatsapp = $request->email_whatsapp;
        $password = $request->password;

        $member_user = Member_user::where('email', $email_whatsapp)->orWhere('whatsapp', $email_whatsapp)->first();

        if (!empty($member_user) && Hash::check($password, $member_user->password)) {
            
            if ($request->rememberme == 'on') {
                setcookie('email_whatsapp', $request->email_whatsapp, time() + 60*60*24*50);
                setcookie('password', $request->password, time() + 60*60*24*50);
            }else {
                setcookie('email', $request->email, time() - 30);
                setcookie('password', $request->password, time() - 30);
            }
            $role = User_role::find($member_user->role_id);
            session()->put('member_id', $member_user->member_id);
            session()->put('name', $member_user->name);
            session()->put('email', $member_user->email);
            session()->put('role_name', $role->role_name);
            session()->put('role_id', $member_user->role_id);
            session()->put('email_verified', $member_user->email_verified);
            session()->put('pro_pic', $member_user->pro_pic);
            session()->put('status', $member_user->status);
            session()->put('logged_in', 1);

            return redirect(route('member.dashboard'));

        }else{

            return redirect(route('member.login'))->with('error', 'Incorrect Email or Password..!');

        }
    }
    

    public function member_profile(){
        $member_profile = Member_user::find(session()->get('member_id'));

        return view('member_view.member_profile', compact('member_profile'));

    }
    

    public function presenter_approval(){
        $cp_approvals = Member_user::where('presenter_approval', 0)->where('presenter_id', null)->get();

        $all_presenters = Admin_user::where('role_id', 8)->get();

        $roles = User_role::all();

        return view('admin_view.common.cp_approval', compact('cp_approvals', 'all_presenters', 'roles'));

    }
    

    public function delete_member($member_id){
        $delete_member = Member_user::find($member_id);

        if (!empty($delete_member->pro_pic)) {
            if (file_exists(public_path('storage/uploads/pro_pic/'.$delete_member->pro_pic))) {
                unlink(public_path('storage/uploads/pro_pic/'.$delete_member->pro_pic));
            }
        }

        $delete_member->delete();


        return redirect()->back()->with('error', 'Member deleted..');

    }
    

    public function member_deactive(){

        return view('member_view.member_deactive');

    }


    public function active_members(){

        $active_members = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('status', 1)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.active_members', compact('active_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters', 'roles', 'all_admins', 'all_members'));
    }
    

    public function inactive_members(){

        $inactive_members = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('status', 0)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.inactive_members', compact('inactive_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters', 'roles', 'all_admins', 'all_members'));
    }
    

    public function inactive_members_update(Request $request){

        $inactive_members_update = Member_user::find($request->member_id);

        if(!empty($request->director_id)){
            $inactive_members_update->director_id = $request->director_id;
        }

        if(!empty($request->seo_id)){
            $inactive_members_update->seo_id = $request->seo_id;
        }

        if(!empty($request->eo_id)){
            $inactive_members_update->eo_id = $request->eo_id;
        }

        if(!empty($request->executive_id)){
            $inactive_members_update->executive_id = $request->executive_id;
        }

        if(!empty($request->cp_id)){
            $inactive_members_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $inactive_members_update->presenter_id = $request->presenter_id;
        }

        if($request->status == 1){
            $inactive_members_update->status = $request->status;
                
            $subject_member = 'Account activation.';

                
            $body_member = '
            Hello Sir, <br><br>
            Your account has been activated. <br> <br>
            Check your dashboard. <br>
            Thank you, <br>
            Effort E-learning MP.
            ';

            Mail::to($inactive_members_update->email)->send(new SendMail($subject_member, $body_member));
            
        }

        $inactive_members_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function active_members_update(Request $request){

        $active_members_update = Member_user::find($request->member_id);

        if(!empty($request->director_id)){
            $active_members_update->director_id = $request->director_id;
        }

        if(!empty($request->seo_id)){
            $active_members_update->seo_id = $request->seo_id;
        }

        if(!empty($request->eo_id)){
            $active_members_update->eo_id = $request->eo_id;
        }

        if(!empty($request->executive_id)){
            $active_members_update->executive_id = $request->executive_id;
        }

        if(!empty($request->cp_id)){
            $active_members_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $active_members_update->presenter_id = $request->presenter_id;
        }

        if($request->status == 0){
            $active_members_update->status = $request->status;
                
            $subject_member = 'Account deactivation.';

                
            $body_member = '
            Hello Sir, <br><br>
            Your request has been deactivated. <br> <br>
            If you think we are wrong then contact us. <br>
            Thank you, <br>
            Effort E-learning MP.
            ';

            Mail::to($active_members_update->email)->send(new SendMail($subject_member, $body_member));
            
        }

        $active_members_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    
    public function dg_approvals(){

        $dg_approvals = Member_user::where('dg_approval', 0)->where('director_approval', 0)->where('status', 0)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.dg_approvals', compact('dg_approvals', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters', 'roles', 'all_admins', 'all_members'));
    }
    
    public function admin_money_add($parent_user_admin, $total_balance, $remaining_profit){

        $directors = Admin_user::where('role_id', 2)->get();
        $director_profit = ($total_balance/100)*8;
        $presenter_profit = ($total_balance/100)*5;
        $cp_profit = ($total_balance/100)*7.5;
        $executive_profit = ($total_balance/100)*7.5;
        $eo_profit = ($total_balance/100)*5;
        $seo_profit = ($total_balance/100)*2.5;

        if(!empty($parent_user_admin)){
            if ($parent_user_admin->role_id == 8) {
                $parent_user_admin->balance = intval($parent_user_admin->balance)+$presenter_profit;
                $remaining_profit = $total_balance-$presenter_profit;
                // $parent_user_admin->update();
                echo $remaining_profit;
    
                foreach ($directors as $director) {
                    
                    $director->balance = intval($director->balance)+$director_profit;
                    $remaining_profit = $remaining_profit-$director_profit;
                    // $director->update();
                    echo $remaining_profit; 
                }
    
                $dg = Admin_user::find(3);
    
                $dg->balance = intval($dg->balance)+$remaining_profit;
                // $dg->update();
                echo $remaining_profit;
    
    
                    
    
            }elseif($parent_user_admin->role_id == 7){
                $parent_user_admin->balance = intval($parent_user_admin->balance)+$cp_profit;
                $remaining_profit = $total_balance-$cp_profit;
                $parent_user_admin->update();
                    
                foreach ($directors as $director) {
                    
                    $director->balance = intval($director->balance)+$director_profit;
                    $remaining_profit = $remaining_profit-$director_profit;
                    $director->update();
                }
    
                $dg = Admin_user::find(3);
    
                $dg->balance = intval($dg->balance)+$remaining_profit;
                $dg->update();
    
    
                    
    
            }elseif($parent_user_admin->role_id == 6){
                $parent_user_admin->balance = intval($parent_user_admin->balance)+$executive_profit;
                $remaining_profit = $total_balance-$executive_profit;
                $parent_user_admin->update();
                
                    
                foreach ($directors as $director) {
                    
                    $director->balance = intval($director->balance)+$director_profit;
                    $remaining_profit = $remaining_profit-$director_profit;
                    $director->update();
                }
    
                $dg = Admin_user::find(3);
    
                $dg->balance = intval($dg->balance)+$remaining_profit;
                $dg->update();
    
    
                    
    
            }elseif($parent_user_admin->role_id == 5){
    
                $parent_user_admin->balance = intval($parent_user_admin->balance)+$eo_profit;
                $remaining_profit = $total_balance-$eo_profit;
                $parent_user_admin->update();
    
                foreach ($directors as $director) {
                    
                    $director->balance = intval($director->balance)+$director_profit;
                    $remaining_profit = $remaining_profit-$director_profit;
                    $director->update();
                }
    
                $dg = Admin_user::find(3);
    
                $dg->balance = intval($dg->balance)+$remaining_profit;
                $dg->update();
    
    
                
            // }elseif($parent_user_admin->role_id == 4){
            //     $parent_user_admin->balance = ($total_balance/100)*7.5;
            }elseif($parent_user_admin->role_id == 3){
    
                $parent_user_admin->balance = intval($parent_user_admin->balance)+$seo_profit;
                $remaining_profit = $total_balance-$seo_profit;
                $parent_user_admin->update();
                
                foreach ($directors as $director) {
                    
                    $director->balance = intval($director->balance)+$director_profit;
                    $remaining_profit = $remaining_profit-$director_profit;
                    $director->update();
                }
    
                $dg = Admin_user::find(3);
    
                $dg->balance = intval($dg->balance)+$remaining_profit;
                $dg->update();
    
    
                
            }
        }else{
                
            foreach ($directors as $director) {
                
                $director->balance = intval($director->balance)+$director_profit;
                $remaining_profit = $remaining_profit-$director_profit;
                $director->update();
            }

            $dg = Admin_user::find(3);

            $dg->balance = intval($dg->balance)+$remaining_profit;
            $dg->update();

        }
    }


    public function dg_approval_update(Request $request){

        $dg_approval_update = Member_user::find($request->member_id);

        $dg_approval_update->dg_id = session()->get('admin_id');
        $dg_approval_update->dg_approval = 1;
        $dg_approval_update->director_approval = 1;
        $parent_user_member = Member_user::where('user_code', $dg_approval_update->parent_user_code)->first();
        $parent_user_admin = Admin_user::where('user_code', $dg_approval_update->parent_user_code)->first();

        // $total_balance = 600;

        // $member_profit = ($total_balance/100)*20;

        // if (!empty($parent_user_member)) {

        //     $parent_user_member->balance = intval($parent_user_member->balance)+$member_profit;
        //     $remaining_profit = $total_balance-$member_profit;
        //     $parent_user_member->update();
        //     echo $remaining_profit;

        //     $group_leader_info = Admin_user::where('user_code', $parent_user_member->group_leader_code)->where('status', 1)->first();

        //     $this->admin_money_add($group_leader_info, $total_balance, $remaining_profit);

        // }else {

        //     $remaining_profit = $total_balance;
        //     $this->admin_money_add($parent_user_admin, $total_balance, $remaining_profit);

        // }

            

            // $director1 = Admin_user::find(4);

            // $director1->balance = intval($director1->balance)+$director_profit;
            // $remaining_profit = $remaining_profit-$director_profit;
            // $director1->update();

            // $director2 = Admin_user::find(5);

            // $director2->balance = intval($director2->balance)+$director_profit;
            // $remaining_profit = $remaining_profit-$director_profit;
            // $director2->update();


        if(!empty($request->director_id)){
            $dg_approval_update->director_id = $request->director_id;
        }

        if(!empty($request->seo_id)){
            $dg_approval_update->seo_id = $request->seo_id;
        }

        if(!empty($request->eo_id)){
            $dg_approval_update->eo_id = $request->eo_id;
        }

        if(!empty($request->executive_id)){
            $dg_approval_update->executive_id = $request->executive_id;
        }

        if(!empty($request->cp_id)){
            $dg_approval_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $dg_approval_update->presenter_id = $request->presenter_id;
        }

        if(!empty($request->status)){
            $dg_approval_update->status = $request->status;
                
            $subject_member = 'Mail verification request.';

                
            $body_member = '
            Hello Sir, <br><br>
            Your request has been approved. <br> <br>
            Check your dashboard. <br>
            Thank you, <br>
            Effort E-learning MP.
            ';

            Mail::to($dg_approval_update->email)->send(new SendMail($subject_member, $body_member));
            
        }

        $dg_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function director_approvals(){

        $director_approvals = Member_user::where('dg_approval', 0)->where('director_approval', 0)->where('status', 0)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.director_approvals', compact('director_approvals', 'all_admins', 'all_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters'));
    }
    
    public function director_approval_update(Request $request){

        $director_approval_update = Member_user::find($request->member_id);

            $director_approval_update->director_id = session()->get('admin_id');
            $director_approval_update->dg_approval = 1;
            $director_approval_update->director_approval = 1;

        if(!empty($request->seo_id)){
            $director_approval_update->seo_id = $request->seo_id;
        }

        if(!empty($request->eo_id)){
            $director_approval_update->eo_id = $request->eo_id;
        }

        if(!empty($request->executive_id)){
            $director_approval_update->executive_id = $request->executive_id;
        }

        if(!empty($request->cp_id)){
            $director_approval_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $director_approval_update->presenter_id = $request->presenter_id;
        }

        if(!empty($request->status)){
            $director_approval_update->status = $request->status;
            
        $subject_member = 'Mail verification request.';

        $body_member = '
        Hello Sir, <br><br>
        Your request has been approved. <br> <br>
        Check your dashboard. <br>
        Thank you, <br>
        Effort E-learning MP.
        ';

        Mail::to($director_approval_update->email)->send(new SendMail($subject_member, $body_member));
        }

        $director_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function seo_approvals(){

        $seo_approvals = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('seo_id', session()->get('admin_id'))->where('seo_approval', 0)->where('status', 1)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.seo_approvals', compact('seo_approvals', 'all_admins', 'all_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters'));
    }
    
    public function seo_approval_update(Request $request){

        $seo_approval_update = Member_user::find($request->member_id);

        $seo_approval_update->seo_id = session()->get('admin_id');
        $seo_approval_update->seo_approval = 1;
        

        if(!empty($request->eo_id)){
            $seo_approval_update->eo_id = $request->eo_id;
        }

        if(!empty($request->executive_id)){
            $seo_approval_update->executive_id = $request->executive_id;
        }

        if(!empty($request->cp_id)){
            $seo_approval_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $seo_approval_update->presenter_id = $request->presenter_id;
        }

        $seo_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function eo_approvals(){

        $eo_approvals = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('eo_id', session()->get('admin_id'))->where('eo_approval', 0)->where('status', 1)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.eo_approvals', compact('eo_approvals', 'all_admins', 'all_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters'));
    }
    
    public function eo_approval_update(Request $request){

        $eo_approval_update = Member_user::find($request->member_id);

        $eo_approval_update->eo_id = session()->get('admin_id');
        $eo_approval_update->eo_approval = 1;

        if(!empty($request->executive_id)){
            $eo_approval_update->executive_id = $request->executive_id;
        }

        if(!empty($request->cp_id)){
            $eo_approval_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $eo_approval_update->presenter_id = $request->presenter_id;
        }

        $eo_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function executive_approvals(){

        $executive_approvals = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('executive_id', session()->get('admin_id'))->where('executive_approval', 0)->where('status', 1)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.executive_approvals', compact('executive_approvals', 'all_admins', 'all_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters'));
    }
    
    public function executive_approval_update(Request $request){

        $executive_approval_update = Member_user::find($request->member_id);

        $executive_approval_update->executive_id = session()->get('admin_id');
        $executive_approval_update->executive_approval = 1;
        

        if(!empty($request->cp_id)){
            $executive_approval_update->cp_id = $request->cp_id;
        }

        if(!empty($request->presenter_id)){
            $executive_approval_update->presenter_id = $request->presenter_id;
        }

        $executive_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function cp_approvals(){

        $cp_approvals = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('cp_id', session()->get('admin_id'))->where('cp_approval', 0)->where('status', 1)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.cp_approvals', compact('cp_approvals', 'all_admins', 'all_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters'));
    }
    
    public function cp_approval_update(Request $request){

        $cp_approval_update = Member_user::find($request->member_id);

        $cp_approval_update->cp_id = session()->get('admin_id');
        $cp_approval_update->cp_approval = 1;
        

        if(!empty($request->presenter_id)){
            $cp_approval_update->presenter_id = $request->presenter_id;
        }

        $cp_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    

    public function presenter_approvals(){

        $presenter_approvals = Member_user::where('dg_approval', 1)->where('director_approval', 1)->where('presenter_id', session()->get('admin_id'))->where('presenter_approval', 0)->where('status', 1)->get();

        $all_directors = Admin_user::where('role_id', 2)->where('status', 1)->get();
        $all_seos = Admin_user::where('role_id', 4)->where('status', 1)->get();
        $all_eos = Admin_user::where('role_id', 5)->where('status', 1)->get();
        $all_executives = Admin_user::where('role_id', 6)->where('status', 1)->get();
        $all_cps = Admin_user::where('role_id', 7)->where('status', 1)->get();
        $all_presenters = Admin_user::where('role_id', 8)->where('status', 1)->get();

        $roles = User_role::all();

        $all_admins = Admin_user::all();

        $all_members = Member_user::all();

        return view('admin_view.common.presenter_approvals', compact('presenter_approvals', 'all_admins', 'all_members', 'all_directors', 'all_seos', 'all_eos', 'all_executives', 'all_cps', 'all_presenters'));
    }
    
    public function presenter_approval_update(Request $request){

        $presenter_approval_update = Member_user::find($request->member_id);

        if(!empty($request->presenter_id)){
            $presenter_approval_update->presenter_id = $request->presenter_id;
        }

        $presenter_approval_update->update();


        return back()->with('success', 'Request submitted..!');
    }
    






}



