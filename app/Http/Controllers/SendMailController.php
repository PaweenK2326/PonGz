<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Mails;
use App\Worksheet;
use App\Branch;
use App\Email;
use App\MailOrder;
use Mail;
use PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SendMailController extends Controller
{
	public function check()
	{
		$mails = MailOrder::all();

		foreach ($mails as $mail) {
			if ($mail->status == '0') {
				try {
                    if ($mail->mail_id) {
    					switch ($mail->mail->type) {
    						case 'อีเมล์สรุปรายการ และแจ้งเลขบัญชีสำหรับลูกค้าที่เลือกจ่ายแบบโอน':
    							app('App\Http\Controllers\SendMailController')->send_bank_transfer($mail->order_id);
    							break;
    						case 'ส่งให้ทุกคนที่เกี่ยวข้อง เมื่อมีการสั่งซื้อสำเร็จ':
    							app('App\Http\Controllers\SendMailController')->sendMailWorksheetReceipt($mail->order_id);
    							break;
    						case 'เอาไว้ส่งให้ลูกค้าเวลาลูกค้า ยกเลิกคำสั่งซื้อ':
    							app('App\Http\Controllers\SendMailController')->sendMailCancelToCustomer($mail->order_id);
    							break;
    						case 'เอาไว้ส่งให้สาขา เวลาลูกค้ายกเลิกคำสั่งซื้อ':
    							app('App\Http\Controllers\SendMailController')->sendMailCancelToBranch($mail->order_id);
    							break;
                            case 'บันทึกตะกร้าสินค้า':
                                app('App\Http\Controllers\SendMailController')->sendMailSaveCart($mail->cart_id);
                                break;
                            case 'แจ้งเตือนลูกค้าให้เข้ารับบริการ':
                                $status = app('App\Http\Controllers\SendMailController')->sendMailAlert($mail->order_id);
                                if ($status == '0') {
                                    throw new \Exception("Not yet to be sent.");
                                }
                                break;
    					}	
					}

					$mail->update([
						'status' => 1
					]);
				} catch (\Exception $e) {
					$mail->update([
						'note' => $e->getMessage()
					]);
				}
			}
		}
		// delete what's done
		MailOrder::where('status', '1')->delete();
	}

	public function send_bank_transfer($order_id)
	{
		$order = Order::find($order_id);

        $mail = Mails::where('type','อีเมล์สรุปรายการ และแจ้งเลขบัญชีสำหรับลูกค้าที่เลือกจ่ายแบบโอน')->first();

        $products = '';
        $i = 1;
        $total = 0;
        foreach ($order->cart->products as $product) {
            $quantity = $product->pivot->quantity;
            if ($product->promotion == 0 || $product->promotion == null) {
              $price = $product->price;
            } else {
              $price = $product->promotion;
            }
            $total_each = $quantity*$price;
            $total += $total_each;

            $brand_name = '';
            if ($product->type != 'บริการ') {
            	$brand_name = $product->brand->brand_name.' - ';
            }
            $products .='<p><strong>'.$i.'.</strong> '.$product->type.' : '.$brand_name.$product->title_th.'<br>&emsp;&emsp;'.$quantity.' * '.number_format($price).' บาท = '.number_format($total_each).' บาท</p>';
            $i++;
        }

        $list = $products.'{{ promotion }}<p><strong>ราคารวม {{ total }} บาท</strong></p>';

        $promotion_p ='';
        if ($order->discount_name != null) {

          $promotion_p = '<p>- ใช้โค้ดส่วนลด <strong>'.$order->discount_name.'</strong>, ลดไปทั้งหมด <strong>'.number_format($order->discount_value, 2, '.', ',').'</strong> จากราคาเต็ม <strong>'.number_format($order->total_price, 2, '.', ',').'</strong> บาท</p>';
        }
        $replacetotal = str_replace('{{ total }}', number_format($order->total_pay, 2, '.', ','), $list);

        $p = str_replace('{{ promotion }}', $promotion_p, $replacetotal);
        $replaceid = str_replace('{{ orderId }}', $order->order_number, $mail->mail_th);
        $replaceproduct = str_replace('{{ product_list }}', $p, $replaceid);
        $data = array('mail' => $replaceproduct);

        Mail::send('mails.mailcartcustomer', $data, function($message) use ($order, $mail){
            $message->to($order->bill_email, $order->bill_pname.$order->bill_fname.' '.$order->bill_lname)->subject($mail->subject_th.' '.$order->order_number);
        });
	}

    public function sendMailWorksheetReceipt($id)
    {
        $order = Order::find($id);
        $branch = Branch::find($order->cart->branch_id);

        $emails = [$order->bill_email];
        if ($branch->emails) {
            $customer_email = [$order->bill_email];
            $branch_emails = explode('; ', $branch->emails);
            $emails = array_merge($customer_email, $branch_emails);
        }

        $ecom_email = Email::where('category', 'Ecommerce')->first();
        $cc_email = null;
        if ($ecom_email) {
            $cc_email = explode('; ', $ecom_email->email);
        }

        $mail = Mails::where('type','ส่งให้ทุกคนที่เกี่ยวข้อง เมื่อมีการสั่งซื้อสำเร็จ')->first();
        $replacefullname = str_replace('{{ customer_name }}', $order->bill_pname.$order->bill_fname.' '.$order->bill_lname, $mail->mail_th);
        $replaceemail = str_replace('{{ cutomer_email }}', $order->bill_email, $replacefullname);
        $replacetelphone = str_replace('{{ customer_telphone }}', $order->bill_telephone, $replaceemail);
        $replaceaddress = str_replace('{{ customer_address }}', $order->bill_address.' '.$order->bill_district.' '.$order->bill_sub_district.' '.$order->bill_province.' '.$order->bill_zipcode, $replacetelphone);
        // $replacebuttons = str_replace('{{ document_buttons }}', '<a href="'.route('worksheet',$order->id).'" target="_blank" style="background-color: #ffcb05; border: 1px solid black; border-radius: 20px; padding: 10px 40px; font-size: 15px; color: black; text-decoration: none; margin-right: 10px">PDF ใบงาน</a>&emsp;<a href="'.route('receipt',$order->id).'" target="_blank" style="background-color: #ffcb05; border: 1px solid black; border-radius: 20px; padding: 10px 40px; font-size: 15px; color: black; text-decoration: none;">PDF ใบเสร็จ</a>', $replaceaddress);
        // $replaceid = str_replace('{{ order_id }}', $order->id, $replacebuttons);
        $replaceid = str_replace('{{ order_id }}', $order->order_number, $replaceaddress);
        $replacepayment = str_replace('{{ payment }}', $order->payment_method, $replaceid);
        
        $products = '';
        $i = 1;
        $total = 0;
        foreach ($order->cart->products as $product) {
            $quantity = $product->pivot->quantity;
            if ($product->promotion == 0 || $product->promotion == null) {
              $price = $product->price;
            } else {
              $price = $product->promotion;
            }
            $total_each = $quantity*$price;
            $total += $total_each;

            $brand_name = '';
            if ($product->type != 'บริการ') {
                $brand_name = $product->brand->brand_name.' - ';
            }
            $products .='<p><strong>'.$i.'.</strong> '.$product->type.' : '.$brand_name.$product->title_th.'<br>&emsp;&emsp;'.$quantity.' * '.number_format($price).' บาท = '.number_format($total_each).' บาท</p>';
            $i++;
        }

        $list = $products.'{{ promotion }}<p><strong>ราคารวม {{ total }} บาท</strong></p>';

        $promotion_p ='';
        if ($order->discount_name != null) {

          $promotion_p = '<p>- ใช้โค้ดส่วนลด <strong>'.$order->discount_name.'</strong>, ลดไปทั้งหมด <strong>'.number_format($order->discount_value, 2, '.', ',').'</strong> จากราคาเต็ม <strong>'.number_format($order->total_price, 2, '.', ',').'</strong> บาท</p>';
        }
        $replacetotal = str_replace('{{ total }}', number_format($order->total_pay, 2, '.', ','), $list);

        $p = str_replace('{{ promotion }}', $promotion_p, $replacetotal);

        $replaceproduct = str_replace('{{ product_list }}', $p, $replacepayment);

        $sheet = Worksheet::where('type','ใบงาน')->first();
        $pdf = PDF::loadView('pdf.worksheet',compact('sheet', 'order'));
        $pdf2 = PDF::loadView('pdf.receipt',compact('order'));

        // $now = date('d-m-Y');

        $data = array('mail' => $replaceproduct);
        Mail::send('mails.mailcartcustomer', $data, function($message) use ($order, $mail, $emails, $cc_email, $pdf, $pdf2){
            $message->to($emails);
            if ($cc_email) {
                $message->cc($cc_email);
            }
            $message->subject($mail->subject_th.' '.$order->order_number);
            $message->attachData($pdf->output(), "B-Quik_worksheet_".$order->order_number.".pdf");
            $message->attachData($pdf2->output(), "B-Quik_order_".$order->order_number.".pdf");
        });

        $mail = Mails::where('type','แจ้งเตือนลูกค้าให้เข้ารับบริการ')->first();
        MailOrder::create([
            'order_id' => $order->id,
            'mail_id' => $mail->id
        ]);
    }

    public function sendMailCancelToCustomer($order_id)
    {
    	$order = Order::find($order_id);

        $mail = Mails::where('type','เอาไว้ส่งให้ลูกค้าเวลาลูกค้า ยกเลิกคำสั่งซื้อ')->first();
        $replacefname = str_replace('{{ fname }}', $order->bill_fname, $mail->mail_th);
        $replacelname = str_replace('{{ lname }}', $order->bill_lname, $replacefname);
        $link = '<a href="https://www.blackcircles.co.th/th/faq/payment/how-long-does-a-refund-take">ที่นี่</a>';
        $replacelink = str_replace('{{ link }}', $link, $replacelname);

        $data = array('mail' => $replacelink);
        Mail::send('mails.mailcartcustomer', $data, function($message) use ($order, $mail){
            $message->to($order->bill_email, $order->bill_pname.$order->bill_fname.' '.$order->bill_lname)->subject($mail->subject_th.' '.$order->order_number);
        });
    }

    public function sendMailCancelToBranch($order_id)
    {
    	$order = Order::find($order_id);
    	$note = '';
    	if ($order->cart->status == 'ยกเลิกแล้ว') {
    		$note = $order->cart->note;
    	}

        if ($order->cart->branch->emails) {
            $branch_emails = explode('; ', $order->cart->branch->emails);

            $ecom_email = Email::where('category', 'Ecommerce')->first();
            $cc_email = null;
            if ($ecom_email) {
                $cc_email = explode('; ', $ecom_email->email);
            }

            $mail_2 = Mails::where('type','เอาไว้ส่งให้สาขา เวลาลูกค้ายกเลิกคำสั่งซื้อ')->first();
            $replacename = str_replace('{{ customer_name }}', $order->bill_fname.' '.$order->bill_lname, $mail_2->mail_th);
            $replacedatetime = str_replace('{{ appoint_date-time }}', date('d/m/Y', strtotime($order->cart->appoint_date)).' '.$order->cart->appoint_time, $replacename);
            $replacenote = str_replace('{{ note }}', $note, $replacedatetime);

            $data = array('mail' => $replacenote);
            Mail::send('mails.mailcartcustomer', $data, function($message) use ($order, $mail_2, $branch_emails, $cc_email){
                $message->to($branch_emails);
                if ($cc_email) {
                    $message->cc($cc_email);
                }
                $message->subject($mail_2->subject_th.' '.$order->order_number);
            });
        }
    }

    public function sendMailSaveCart($cart_id)
    {
        $cart = Cart::find($cart_id);
        $email = $cart->customer_email;
        $mail = Mails::where('type','บันทึกตะกร้าสินค้า')->first();
        $link = url('cart/order/'.$cart->id);
        
        $products = '';
        $i = 1;
        $total = 0;
        foreach ($cart->products as $product) {
            $quantity = $product->pivot->quantity;
            $price = $product->promotion;
            if ($product->promotion == 0 || $product->promotion == null) {
              $price = $product->price;
            }
            $total_each = $quantity*$price;
            $total += $total_each;

            $brand_name = '';
            if ($product->type != 'บริการ') {
                $brand_name = $product->brand->brand_name.' - ';
            }
            $products .='<p><strong>'.$i.'.</strong> '.$product->type.' : '.$brand_name.$product->title_th.'<br>&emsp;&emsp;'.$quantity.' * '.number_format($price).' บาท = '.number_format($total_each).' บาท</p>';
            $i++;
        }
        $list = $products.'<p><strong>ราคารวม '.number_format($total, 2, '.', ',').' บาท</strong></p>';

        $replacelink = str_replace('{{ link }}', $link, $mail->mail_th);
        $replaceproduct = str_replace('{{ product_list }}', $list, $replacelink);
        $data = array('mail' => $replaceproduct);
        Mail::send('mails.cartsave', $data, function($message) use ($email, $mail){
            $message->to($email)->subject($mail->subject_th);
        });
    }

    public function sendMailAlert($order_id)
    {
        $order = Order::find($order_id);

        $today = Carbon::now();
        if ($today->toDateString() == $order->cart->appoint_date) {
            $appoint_time = $order->cart->appoint_time;
            $seperate = explode('.', $appoint_time);
            $app_time = $seperate[0].':00:00';
            $app_dt = new Carbon($order->cart->appoint_date.' '.$app_time);
            $diff = date_diff($today, $app_dt);
            if ($diff->format('%R%h') <= 6) {
                $mail = Mails::where('type','แจ้งเตือนลูกค้าให้เข้ารับบริการ')->first();
                $replacename = str_replace('{{ customer_name }}', $order->bill_fname.' '.$order->bill_lname, $mail->mail_th);
                $replacedate = str_replace('{{ appoint_date }}', date('d/m/Y', strtotime($order->cart->appoint_date)), $replacename);
                $replacetime = str_replace('{{ appoint_time }}', $order->cart->appoint_time, $replacedate);

                $products = '';
                $i = 1;
                $total = 0;
                foreach ($order->cart->products as $product) {
                    $quantity = $product->pivot->quantity;
                    if ($product->promotion == 0 || $product->promotion == null) {
                      $price = $product->price;
                    } else {
                      $price = $product->promotion;
                    }
                    $total_each = $quantity*$price;
                    $total += $total_each;

                    $brand_name = '';
                    if ($product->type != 'บริการ') {
                        $brand_name = $product->brand->brand_name.' - ';
                    }
                    $products .='<p><strong>'.$i.'.</strong> '.$product->type.' : '.$brand_name.$product->title_th.'<br>&emsp;&emsp;'.$quantity.' * '.number_format($price).' บาท = '.number_format($total_each).' บาท</p>';
                    $i++;
                }

                $list = $products.'{{ promotion }}<p><strong>ราคารวม {{ total }} บาท</strong></p>';

                $promotion_p ='';
                if ($order->discount_name != null) {

                  $promotion_p = '<p>- ใช้โค้ดส่วนลด <strong>'.$order->discount_name.'</strong>, ลดไปทั้งหมด <strong>'.number_format($order->discount_value, 2, '.', ',').'</strong> จากราคาเต็ม <strong>'.number_format($order->total_price, 2, '.', ',').'</strong> บาท</p>';
                }
                $replacetotal = str_replace('{{ total }}', number_format($order->total_pay, 2, '.', ','), $list);

                $p = str_replace('{{ promotion }}', $promotion_p, $replacetotal);

                $replaceproduct = str_replace('{{ product_list }}', $p, $replacetime);


                $replacebranchname = str_replace('{{ branch_name }}', $order->cart->branch->name_th, $replaceproduct);
                $replacebranchaddress = str_replace('{{ branch_address }}', $order->cart->branch->number.' '.$order->cart->branch->district_th.' '.$order->cart->branch->sub_district_th.' '.$order->cart->branch->road_th.' '.$order->cart->branch->province.' '.$order->cart->branch->zipcode.', '.$order->cart->branch->landmark_th, $replacebranchname);
                $link = '-';
                if ($order->cart->branch->map_link) {
                    $link = 'Google map';
                }
                $replacebranchlink = str_replace('{{ branch_link }}', '<a href="'.$order->cart->branch->map_link.'" target="_blank">'.$link.'</a>' , $replacebranchaddress);

                $data = array('mail' => $replacebranchlink);
                Mail::send('mails.mailcartcustomer', $data, function($message) use ($order, $mail){
                    $message->to($order->bill_email, $order->bill_pname.$order->bill_fname.' '.$order->bill_lname);
                    $message->subject($mail->subject_th.' '.$order->order_number);
                });
                return '1';
            } else {
                return '0';
            }
        } else {
            return '0';
        }
    }

}
