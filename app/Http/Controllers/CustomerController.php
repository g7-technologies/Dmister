<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Transaction;
use App\Customer;
use App\Category;
use App\Service;
use App\Order;
use App\Coin;
use App\Fund;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function login()
    {
        return view('customerportal.login');
    }

    public function customer_registration()
    {
        return view('customerportal.registration');
    }

    public function customer_register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $customer = Customer::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if(Auth::guard('customer')->attempt(['email'=> $request->email, 'password' => $request->password]))
        {
            return redirect('/customer_dashboard');
        }
    }

    public function check_login_details(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        
		$customer = Customer::where('email', $request->email)->first();
		
		if($customer)
		{
			if(Auth::guard('customer')->attempt(['email'=> $request->email, 'password' => $request->password]))
			{
				return redirect('/customer_dashboard');
			}
            else
            {
                return redirect()->back()->with('error_msg', 'Invalid Credentials!');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'You are not authorized!');
        }
    }

    public function customer_dashboard()
    {
        $total_orders = Order::where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $awaiting_orders = Order::where('status','=','0')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $pending_orders = Order::where('status','=','1')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $processing_orders = Order::where('status','=','2')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $inprogress_orders = Order::where('status','=','3')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $completed_orders = Order::where('status','=','4')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $partial_orders = Order::where('status','=','5')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $cancelled_orders = Order::where('status','=','6')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        $refunded_orders = Order::where('status','=','7')->where('customer_id','=',Auth::guard('customer')->user()->id)->count();
        return view('customerportal.dashboard',compact('total_orders','awaiting_orders','pending_orders','processing_orders','inprogress_orders','completed_orders','partial_orders','cancelled_orders','refunded_orders'));
    }

    public function customer_chart_orders(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
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
            
            $awaiting_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as awaiting_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 0 AND customer_id = '$customer_id'"));
            
            $pending_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as pending_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 1 AND customer_id = '$customer_id'"));
            
            $processing_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as processing_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 2 AND customer_id = '$customer_id'"));
            
            $inprogress_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as inprogress_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 3 AND customer_id = '$customer_id'"));
            
            $completed_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as completed_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 4 AND customer_id = '$customer_id'"));
            
            $partial_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as partial_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 5 AND customer_id = '$customer_id'"));
            
            $cancelled_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as cancelled_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 6 AND customer_id = '$customer_id'"));
            
            $refunded_orders_per_month = DB::select(DB::raw("SELECT COUNT(id) as refunded_orders_per_month FROM orders WHERE DATE_FORMAT(created_at,'%b %Y') = '$month' AND status = 7 AND customer_id = '$customer_id'"));
            
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

    public function customer_create_order()
    {
        $categories = Category::where('status', 1)->get();
        return view('customerportal.create_order',compact('categories'));
    }

    public function get_services(Request $request)
    {
        $services = Service::where(['status' => 1, 'category_id' => $request->category_id])->get();
        return response()->json(['error' => false,'success_msg' => 'data fetched!','services'=>$services]);
    }

    public function get_service_info(Request $request)
    {
        $service = Service::where(['status' => 1, 'id' => $request->service_id])->first();
        return response()->json(['error' => false,'success_msg' => 'data fetched!','service'=>$service]);
    }

    public function customer_add_order(Request $request)
    {
        $service = Service::where('id',$request->service)->first();
        
        if($service->id != 30)
        {
            $total_price = (($service->price+$service->profit) / 1000) * $request->quantity;
        }
        if($service->id == 30)
        {
            $total_price = (($service->price+$service->profit) / 1000) * $request->time_quantity;
        }

        if(Auth::guard('customer')->user()->funds >= $total_price)
        {
            $new_order = Order::create([
                'customer_id' => Auth::guard('customer')->user()->id,
                'order_id' => "Order#".uniqid(),
                'category_id' => $request->category,
                'service_id' => $request->service,
                'price' => $service->price,
                'profit' => $service->profit,
                'total_price' => $total_price,
                'status' => 0,
                'order_number' => 0,
                'tweet_link' => $request->tweet_link,
                'quantity' => $request->quantity,
                'speed' => $request->speed,
                'quality' => $request->quality,
                'custom_comment' => $request->custom_comments,
                'twitter_space_link' => $request->twitter_space_link,
                'current_space_listeners' => $request->current_space_listeners,
                'discord_invite_link' => $request->discord_invite_link,
                'profile_url' => $request->profile_url,
                'time_quantity' => $request->time_quantity,
                'discord_channel_name' => $request->discord_channel_name
            ]);

            if($new_order)
            {
                $customer = Customer::where('id',Auth::guard('customer')->user()->id)->first();
                $customer->funds = $customer->funds-$total_price;
                $customer->save();

                $transaction = Transaction::create([
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'amount' => $total_price,
                    'transaction' => 'Debit',
                    'order_id' => $new_order->id
                ]);

                return redirect()->back()->with('success_msg','Order created successfully!');
            }
            else
            {
                return redirect()->back()->with('error_msg','Unable to creat order!');
            }
        }
        else
        {
            return redirect()->back()->with('error_msg', 'You dont have sufficient funds..!');
        }
    }

    public function customer_all_orders()
    {
        return view('customerportal.all_orders');
    }
    
    public function customer_awaiting_orders()
    {
        return view('customerportal.awaiting_orders');
    }
    
    public function customer_pending_orders()
    {
        return view('customerportal.pending_orders');
    }
    
    public function customer_processing_orders()
    {
        return view('customerportal.processing_orders');
    }
    
    public function customer_inprogress_orders()
    {
        return view('customerportal.inprogress_orders');
    }
    
    public function customer_completed_orders()
    {
        return view('customerportal.completed_orders');
    }
    
    public function customer_partial_orders()
    {
        return view('customerportal.partial_orders');
    }
    
    public function customer_cancelled_orders()
    {
        return view('customerportal.cancelled_orders');
    }
    
    public function customer_refunded_orders()
    {
        return view('customerportal.refunded_orders');
    }
    
    public function customer_logout()
    {
        Auth::logout();
    	return redirect('/');
    }
    
    public function customer_change_password()
    {
        return view('customerportal.change_password');
    }
    
    public function customer_change_password_submit(Request $request)
    {
        $this->validate($request,[
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'newpassword_confirmation' => 'required'
        ]);
        
        $customer = Customer::where('id','=',Auth::guard('customer')->user()->id)->first();
        
        if(!($request->newpassword == $request->newpassword_confirmation)){
            return redirect()->back()->with('error_msg','Your mew password does not matches with the confirm new password. Please try again.');
        }
        else if (!(password_verify($request->currentpassword, $customer->password)))
        {
            return redirect()->back()->with('error_msg','Your current password does not matches with the password you provided. Please try again.');
        }
        else
        {
            $customer->password = Hash::make($request->newpassword);
            $customer->save();
            
            return redirect()->back()->with('success_msg','Password changed successfully !');
        }
    }

    public function customer_add_funds()
    {
        $coins = Coin::where('status',1)->get();
        return view('customerportal.add_funds',compact('coins'));
    }

    public function customer_add_amount($id)
    {
        $coin = Coin::where('id',$id)->first();
        return view('customerportal.add_amount',compact('coin'));
    }

    public function customer_deposit(Request $request)
    {
        $fund = Fund::create([
            'coin_id' => $request->coin_id,
            'transaction_id' => $request->transaction_link,
            'status' => 0,
            'amount' => $request->amount,
            'customer_id' => Auth::guard('customer')->user()->id
        ]);

        return redirect()->back()->with('success_msg','Request received. We will notify you shortly.');
    }

    public function customer_transaction_history()
    {
        $transactions = Transaction::with(['customer_info','order_info'])->where('customer_id',Auth::guard('customer')->user()->id)->get();
        return view('customerportal.transaction_history',compact('transactions'));
    }
    
    public function customer_funds_history()
    {
        $funds = Fund::with(['customer_info','coin_info'])->where('customer_id',Auth::guard('customer')->user()->id)->get();
        return view('customerportal.funds_history',compact('funds'));
    }
}
