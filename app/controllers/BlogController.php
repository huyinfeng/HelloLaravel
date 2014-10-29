<?php

use Illuminate\Support\Facades\Redirect;
class BlogController extends BaseController
{


    public function __construct()
    {
        //updated: prevents re-login.
        $this->beforeFilter('guest', ['only' => ['getLogin']]);
        $this->beforeFilter('auth', ['only' => ['getLogout']]);
    }

    public function getIndex()
    {
        $pictures = Picture::orderBy('id', 'desc')->paginate(10);
        $pictures->getFactory()->setViewName('pagination::simple');
        $this->layout->title = 'Home Page | Picture Wall Blog';
        $this->layout->main = View::make('home')->nest('content', 'index', compact('pictures'));
    }

    public function getSearch()
    {
    	$searchTerm = Input::get('s');
    	$pictures = Picture::whereRaw('match(title,description) against(? in boolean mode)', [$searchTerm])
    	->paginate(10);
    	$pictures->getFactory()->setViewName('pagination::slider');
    	$pictures->appends(['s' => $searchTerm]);
    	$this->layout->with('title', 'Search: ' . $searchTerm);
    	$this->layout->main = View::make('home')
    	->nest('content', 'index', ($pictures->isEmpty()) ? ['notFound' => true] : compact('pictures'));
    }
    
    public function getLogin()
    {
        $this->layout->title = 'login';
        $this->layout->main = View::make('login');
    }
	
    public function getRegister()
    {
    	$this->layout->title = 'register';
    	$this->layout->main = View::make('register');
    }
    
    public function postRegister()
    {
    	$credentials = [
    	'username' => Input::get('username'),
    	'password' => Input::get('password'),
    	'email' => Input::get('email')
    	];
    	$rules = [
    	'username' => 'required',
    	'password' => 'required',
    	'email' => 'required|email'
    			];
    	$validator = Validator::make($credentials, $rules);
    	if ($validator->passes()) {
    		$userCheck = DB::table('users')->where('username',$credentials['username'])->get();
    		if (!empty($userCheck)){
    			return Redirect::back()->withInput()->with('failure', 'username already exists!');
    		}
    		$emailCheck = DB::table('users')->where('email',$credentials['email'])->get();
    		if (!empty($emailCheck)){
    			return Redirect::back()->withInput()->with('failure', 'mail address already exists!');
    		}
    		$user = array(
            'username' => $credentials['username'],
            'password' => Hash::make($credentials['password']),
    		'email' => $credentials['email'],
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
       	 	);
    		DB::table('users')->insert($user);
    		Auth::attempt($credentials);
    		return Redirect::to('admin/dash-board')->withInput()->with('success', 'register succeed!!!');
    	} else {
    		return Redirect::back()->withErrors($validator)->withInput();
    	}
    }
    
    public function postLogin()
    {
    	if (strcmp($_POST['operation'],"Register") == 0) return Redirect::to('register');
        $credentials = [
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ];
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            if (Auth::attempt($credentials))
                return Redirect::to('admin/dash-board');
            return Redirect::back()->withInput()->with('failure', 'username or password is invalid!');
        } else {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

}
