<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\Customer;
use App\Category;
use App\Service;
use App\Admin;
use App\Order;
use App\Coin;
use App\Fund;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function login()
    {
    	return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
        ]);
        
        $admin = Admin::where(['email' => $request->email])->first();
		
		if($admin)
		{
			if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password]))
			{
				return redirect('/admin_dashboard');
			}
            else
            {
                return redirect('/admin_login')->with('error_message', 'Invalid Credentials!');
            }
        }
        else
        {
            return redirect('/admin_login')->with('error_message', 'You are not authorized!');
        }
    }

    public function dashboard()
    {
        $total_orders = Order::count();
        $awaiting_orders = Order::where('status','=','0')->count();
        $pending_orders = Order::where('status','=','1')->count();
        $processing_orders = Order::where('status','=','2')->count();
        $inprogress_orders = Order::where('status','=','3')->count();
        $completed_orders = Order::where('status','=','4')->count();
        $partial_orders = Order::where('status','=','5')->count();
        $cancelled_orders = Order::where('status','=','6')->count();
        $refunded_orders = Order::where('status','=','7')->count();
        return view('admin.dashboard',compact('total_orders','awaiting_orders','pending_orders','processing_orders','inprogress_orders','completed_orders','partial_orders','cancelled_orders','refunded_orders'));
    }
    
    public function chart_orders(Request $request)
    {
        $months = [];
        $awaiting_orders = [];
        $pending_orders = [];
        $processing_orders = [];
        $inprogress_orders = [];
        $completed_orders = [];
        $partial_orders = [];
        $cancelled_orders = [];
        $refunded_orders = [];
        
        for($i=0;$i<6;$i++)
        {
            $month = Carbon::now()->addMonths(-1*$i)->format('M Y');
            
            $awaiting_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as awaiting_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 0"));
            
            $pending_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as pending_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 1"));
            
            $processing_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as processing_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 2"));
            
            $inprogress_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as inprogress_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 3"));
            
            $completed_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as completed_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 4"));
            
            $partial_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as partial_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 5"));
            
            $cancelled_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as cancelled_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 6"));
            
            $refunded_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as refunded_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 7"));
            
            array_push($awaiting_orders,$awaiting_orders_per_month[0]->awaiting_orders_per_month);
            array_push($pending_orders,$pending_orders_per_month[0]->pending_orders_per_month);
            array_push($processing_orders,$processing_orders_per_month[0]->processing_orders_per_month);
            array_push($inprogress_orders,$inprogress_orders_per_month[0]->inprogress_orders_per_month);
            array_push($completed_orders,$completed_orders_per_month[0]->completed_orders_per_month);
            array_push($partial_orders,$partial_orders_per_month[0]->partial_orders_per_month);
            array_push($cancelled_orders,$cancelled_orders_per_month[0]->cancelled_orders_per_month);
            array_push($refunded_orders,$refunded_orders_per_month[0]->refunded_orders_per_month);
            array_push($months,$month);
        }
        
        $chart_orders = array(
            'months'=> $months,
            'awaiting_orders'=> $awaiting_orders,
            'pending_orders'=> $pending_orders,
            'processing_orders'=> $processing_orders,
            'inprogress_orders'=> $inprogress_orders,
            'completed_orders'=> $completed_orders,
            'partial_orders'=> $partial_orders,
            'cancelled_orders'=> $cancelled_orders,
            'refunded_orders'=> $refunded_orders
        );
        
        return $chart_orders;
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/admin_login');
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function forgot_password_submit(Request $request)
    {
        $email = $request->email;
       
        $user = Admin::whereEmail($email)->first();
        if($user != '') {
            $password = \Str::random(10);
            $user->password = bcrypt($password);
            $user->save();
            
            $to = $user->email;
            $from = 'woke_shee@gmail.com';
            $subject = 'Your New Password for TappedN, Please change it ASAP';
            $message = $password;
            $headers = 'From: woke_shee@gmail.com'."\r\n".
            'Reply-To: woke_shee@gmail.com'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            return response()->json(['success'=> "New System Generated Password sended to this email!"]);
        }else{
            return response()->json(['error'=> 'Email Doesn"t Exist']);
        }
    }

    public function change_password()
    {
        return view('admin.change_password');
    }
    
    public function change_password_submit(Request $request)
    {
        $admin = Auth::user();
        
        if(!($request->new_password == $request->password_confirmation)){
            return redirect()->back()->with('error_msg','Your mew password does not matches with the confirm new password. Please try again.');
        }
        else if (!(password_verify($request->current_password, $admin->password)))
        {
            return redirect()->back()->with('error_msg','Your current password does not matches with the password you provided. Please try again.');
        }
        else
        {
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            
            return redirect()->back()->with('success_msg','Password changed successfully !');
        }
    }

    public function all_orders()
    {
        return view('admin.all_orders');
    }
    
    public function awaiting_orders()
    {
        return view('admin.awaiting_orders');
    }
    
    public function pending_orders()
    {
        return view('admin.pending_orders');
    }
    
    public function processing_orders()
    {
        return view('admin.processing_orders');
    }
    
    public function inprogress_orders()
    {
        return view('admin.inprogress_orders');
    }
    
    public function completed_orders()
    {
        return view('admin.completed_orders');
    }
    
    public function partial_orders()
    {
        return view('admin.partial_orders');
    }
    
    public function cancelled_orders()
    {
        return view('admin.cancelled_orders');
    }
    
    public function refunded_orders()
    {
        return view('admin.refunded_orders');
    }

    public function transactions()
    {
        $transactions = Transaction::with(['customer_info','order_info'])->get();
        return view('admin.transactions',compact('transactions'));
    }
    
    public function funds()
    {
        $funds = Fund::with(['customer_info','coin_info'])->get();
        return view('admin.funds',compact('funds'));
    }

    public function approve_funds($id)
    {
        $funds = Fund::where('id',$id)->first();
        $funds->status = 1;
        $funds->save();

        $customer = Customer::where('id',$funds->customer_id)->first();
        $customer->funds = $customer->funds+$funds->amount;
        $customer->save();

        $transaction = Transaction::create([
            'customer_id' => $funds->customer_id,
            'amount' => $funds->amount,
            'transaction' => 'Credit',
            'order_id' => 0
        ]);

        return redirect()->back()->with('success_msg','Funds approved successfully');
    }

    public function cancel_funds($id)
    {
        $funds = Fund::where('id',$id)->first();
        $funds->status = 2;
        $funds->save();
        return redirect()->back()->with('success_msg','Funds denied successfully');
    }

    public function add_coin()
    {
        return view('admin.add_coin');
    }
    
    public function view_coins()
    {
        $coins = Coin::get();
        return view('admin.view_coins',compact('coins'));
    }

    public function store_coin(Request $request)
    {
        $coin = Coin::create([
            'name' => $request->name,
            'min' => $request->min,
            'max' => $request->max,
            'address' => $request->wallet_address,
            'symbol' => $request->symbol
        ]);
        return redirect()->back()->with('success_msg','Coin added successfully');
    }

    public function disable_coin($id)
    {
        $coin = Coin::where('id',$id)->first();
        $coin->status = 0;
        $coin->save();
        return redirect()->back()->with('success_msg','Coin disabled successfully!');
    }

    public function enable_coin($id)
    {
        $coin = Coin::where('id',$id)->first();
        $coin->status = 1;
        $coin->save();
        return redirect()->back()->with('success_msg','Coin activated successfully!');
    }

    public function edit_coin($id)
    {
        $coin = Coin::where('id',$id)->first();
        return view('admin.edit_coin',compact('coin'));
    }

    public function update_coin(Request $request)
    {
        $coin = Coin::where('id',$request->coin_id)->first();
        $coin->name = $request->name;
        $coin->min = $request->min;
        $coin->max = $request->max;
        $coin->address = $request->wallet_address;
        $coin->symbol = $request->symbol;
        $coin->save();
        return redirect('/view_coins')->with('success_msg','Coin Updated successfully!');
    }

    public function view_categories()
    {
        $categories = Category::get();
        return view('admin.view_categories',compact('categories'));
    }

    public function disable_category($id)
    {
        $category = Category::where('id',$id)->first();
        $category->status = 0;
        $category->save();
        return redirect()->back()->with('success_msg','Category disabled successfully!');
    }

    public function enable_category($id)
    {
        $category = Category::where('id',$id)->first();
        $category->status = 1;
        $category->save();
        return redirect()->back()->with('success_msg','Category activated successfully!');
    }

    public function edit_category($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.edit_category',compact('category'));
    }

    public function update_category(Request $request)
    {
        $category = Category::where('id',$request->category_id)->first();
        $category->name = $request->name;
        $category->save();
        return redirect('/view_categories')->with('success_msg','Category Updated successfully!');
    }

    public function view_services()
    {
        $services = Service::with(['category_info'])->orderBy('category_id')->get();
        return view('admin.view_services',compact('services'));
    }

    public function disable_service($id)
    {
        $service = Service::where('id',$id)->first();
        $service->status = 0;
        $service->save();
        return redirect()->back()->with('success_msg','Service disabled successfully!');
    }

    public function enable_service($id)
    {
        $service = Service::where('id',$id)->first();
        $service->status = 1;
        $service->save();
        return redirect()->back()->with('success_msg','Service activated successfully!');
    }

    public function edit_service($id)
    {
        $service = Service::where('id',$id)->first();
        return view('admin.edit_service',compact('service'));
    }

    public function update_service(Request $request)
    {
        $service = Service::where('id',$request->service_id)->first();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->profit = $request->profit;
        $service->min = $request->min;
        $service->max = $request->max;
        $service->description = $request->description;
        $service->save();
        return redirect('/view_services')->with('success_msg','Service Updated successfully!');
    }

    public function test()
    {
        $url = "https://dmister.com/api/v1";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
           "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "key=rOSyNLhunJTU5IYmoulK&action=add&link=https://dmister.com/user/api/docs&service=1&quantity=500";

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);

        return response()->json(['error' => false,'user' => $resp,'success_msg' => 'Logged In successfully']);
    }
}
