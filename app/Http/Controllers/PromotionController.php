<?php

namespace App\Http\Controllers;

use App\Promotion;
use App\Promotion_Image_TH;
use App\Promotion_Image_EN;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

  	public function index(){
      if (!Auth::user()->permissions->contains(12)) {
        return redirect()->route('admin.home')->withErrors('You don\'t have permission to promotion page');
      }
      return view('admin/promotion');
  	}

    public function list(){
      $list = Promotion::select([
          'id',
          'new',
          'title_th',
          'title_en',
          'start_date',
          'end_date',
          'short_detail_th',
          'short_detail_en',
          'thumbnail_th',
          'thumbnail_en',
          'photo_th',
          'photo_en',
          'created_at',
          'updated_at',
          'priority',
          'status']);

        $datatables = Datatables::of($list)
            ->editColumn('new', function ($list) {
              if ($list->new == 'Yes') {
                return '<strong>'.$list->new.'</strong>';
              } else {
                return $list->new;
              }
            })
            ->editColumn('short_detail_th', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_detail($list, 'short_detail_th');
            })
            ->editColumn('short_detail_en', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_detail($list, 'short_detail_en');
            })
            ->editColumn('thumbnail_th', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_image($list, 'thumbnail_th', '/image/promotion/');
            })
            ->editColumn('thumbnail_en', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_image($list, 'thumbnail_en', '/image/promotion/');
            })
            ->editColumn('photo_th', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_image($list, 'photo_th', '/image/promotion/');
            })
            ->editColumn('photo_en', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_image($list, 'photo_en', '/image/promotion/');
            })
            ->editColumn('period', function ($list) {
                $start = app('App\Http\Controllers\HomeController')->DT_DateThai($list, 'start_date');
                $end = app('App\Http\Controllers\HomeController')->DT_DateThai($list, 'end_date');
                return 'Start: '.$start.'<br>End: '.$end;
            })
            ->editColumn('created_at', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_DatetimeThai($list, 'created_at');
            })
            ->editColumn('updated_at', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_DatetimeThai($list, 'updated_at');
            })
            ->addColumn('status', function ($list) {
                return app('App\Http\Controllers\HomeController')->DT_StatusBox($list);
            })
            ->addColumn('action', function ($lists) {
                return app('App\Http\Controllers\HomeController')->DT_EditDeletePriorityButton($lists, 'promotion');
            });
        $datatables->rawColumns(['status', 'action', 'new', 'short_detail_th', 'short_detail_en', 'thumbnail_th', 'thumbnail_en', 'photo_th', 'photo_en', 'period']);

        return $datatables->addIndexColumn()->make(true);
    }

    public function store(Request $request) {

      if ($request->start_date == null) {
        $start_date = null;
      } else {
        $start_date = date('Y-m-d', strtotime($request->start_date));
      }
      if ($request->end_date == null) {
        $end_date = null;
      } else {
        $end_date = date('Y-m-d', strtotime($request->end_date));
      }

      $data = $request->validate([
        'type' => ['string', 'max:255'],
        'new' => ['required', 'string', 'max:255'],
        'layout' => ['required'],
        'title_th' => ['required', 'string', 'max:255'],
        'title_en' => ['required', 'string', 'max:255'],
        'slug_url_th' => ['nullable', 'string', 'max:255'],
        'slug_url_en' => ['nullable', 'string', 'max:255'],        
        'short_detail_th' => ['nullable', 'string'],
        'short_detail_en' => ['nullable', 'string'],
        'start_date' => ['nullable', 'date'],
        'end_date' => ['nullable', 'date', 'after:start_date'],
        'thumbnail_th' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'thumbnail_en' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'photo_th' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'image_th.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'photo_en' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'pdf_th' => ['nullable', 'mimes:pdf'],
        'pdf_en' => ['nullable', 'mimes:pdf'],
        'condition_th' => ['nullable', 'string'],
        'condition_en' => ['nullable', 'string'],
      ],['required' => 'The :attribute field is required.',
        'after' => 'Promotion end date must be after start date',
        'image' => 'Only accept image file',
        'mimes' => 'Wrong file type']);

      $path = 'image/promotion/'; // upload path

      $nameThumbnailth = "-";
      if ($request->hasFile('thumbnail_th')) {
        $thumbnailth = $request->file('thumbnail_th');
        $nameThumbnailth = Str::slug(Str::random(10)).'.'.$request->file('thumbnail_th')->getClientOriginalName();    
        $thumbnailth->move($path, $nameThumbnailth);   
      }

      $nameThumbnailen = "-";
      if ($request->hasFile('thumbnail_en')) {
        $thumbnailen = $request->file('thumbnail_en');
        $nameThumbnailen = Str::slug(Str::random(10)).'.'.$request->file('thumbnail_en')->getClientOriginalName();    
        $thumbnailen->move($path, $nameThumbnailen);
      }   

      $namePhototh = "-";
      if ($request->hasFile('photo_th')) {
        $phototh = $request->file('photo_th');
        $namePhototh = Str::slug(Str::random(10)).'.'.$request->file('photo_th')->getClientOriginalName();    
        $phototh->move($path, $namePhototh);   
      }

      $namePhotoen = "-";
      if ($request->hasFile('photo_en')) {
        $photoen = $request->file('photo_en');
        $namePhotoen = Str::slug(Str::random(10)).'.'.$request->file('photo_en')->getClientOriginalName();    
        $photoen->move($path, $namePhotoen);    
      }     

      $pathPdf = 'pdf/promotion/'; // upload path

      $namePdfth = "-";    
      if ($request->hasFile('pdf_th')) {
        $pdfth = $request->file('pdf_th');
        $namePdfth = $request->file('pdf_th')->getClientOriginalName();    
        $pdfth->move($pathPdf, $namePdfth);
      }     

      $namePdfen = "-";    
      if ($request->hasFile('pdf_en')) {
        $pdfen = $request->file('pdf_en');
        $namePdfen = $request->file('pdf_en')->getClientOriginalName();    
        $pdfen->move($pathPdf, $namePdfen);
      }

      $newPromotion = Promotion::where('new', 'Yes')->get();
      $count = count($newPromotion);
      $max = Promotion::max('priority');

      if ($request->new == 'Yes') {
        if ($count == 2) {
          $oldest = Promotion::all()->where('new', 'Yes')->sortBy('updated_at')->first();
          Promotion::whereId($oldest->id)->update([
            'new' => 'No',
          ]);
        }
        $priority = $max+1;
      } else {

        $priority = ($max - $count)+1;
        Promotion::where('priority','>=',$priority)->update(['priority' => DB::raw('priority + 1')]);
      }

      $promotion = Promotion::create([
        'type' => $data['type'],
        'new' => $data['new'],
        'layout' => $data['layout'],
        'title_th' => $data['title_th'],
        'title_en' => $data['title_en'],
        'slug_url_th' => $data['slug_url_th'],
        'slug_url_en' => $data['slug_url_en'],        
        'short_detail_th' => $data['short_detail_th'],
        'short_detail_en' => $data['short_detail_en'],
        'start_date' => $start_date,
        'end_date' => $end_date,
        'thumbnail_th' => $nameThumbnailth,
        'thumbnail_en' => $nameThumbnailen,
        'photo_th' =>  $namePhototh,
        'photo_en' => $namePhotoen,
        'pdf_th' => $namePdfth,
        'pdf_en' => $namePdfen,
        'condition_th' => $data['condition_th'],
        'condition_en' => $data['condition_en'],
        'priority' => $priority
      ]);
      
      $pathImage = 'image/promotion/'.$request->slug_url_en;

      if ($request->hasFile('image_th')) {

        foreach ($request->file('image_th') as $image) {
          $nameImageth = Str::slug(Str::random(10)).'.'.$image->getClientOriginalName();    
          $image->move($pathImage, $nameImageth);   

          $promotion->images_th()->create([
            'image' => $nameImageth,
          ]);
        }
      }      

      if ($request->hasFile('image_en')) {

        foreach ($request->file('image_en') as $image) {
          $nameImageen = Str::slug(Str::random(10)).'.'.$image->getClientOriginalName();    
          $image->move($pathImage, $nameImageen);   

          $promotion->images_en()->create([
            'image' => $nameImageen,
          ]);
        }
      }

      return redirect('/admin/promotion')->with('success', 'Promotion is successfully added');
    }

    public function edit($id)
    {
      $promotion = Promotion::findOrFail($id);

      return view('admin/editPromotion', compact('promotion'));
    }

    public function update(Request $request, $id)
    {
      $promotion = Promotion::findOrFail($id);
      if ($request->start_date == null) {
        $start_date = null;
      } else {
        $start_date = date('Y-m-d', strtotime($request->start_date));
      }
      if ($request->end_date == null) {
        $end_date = null;
      } else {
        $end_date = date('Y-m-d', strtotime($request->end_date));
      }

      $data = $request->validate([
        'type' => ['string', 'max:255'],
        'new' => ['required', 'string', 'max:255'],
        'layout' => ['required'],
        'title_th' => ['required', 'string', 'max:255'],
        'title_en' => ['required', 'string', 'max:255'],
        'slug_url_th' => ['nullable', 'string', 'max:255'],
        'slug_url_en' => ['nullable', 'string', 'max:255'],
        'short_detail_th' => ['nullable', 'string'],
        'short_detail_en' => ['nullable', 'string'],
        'start_date' => ['nullable', 'date'],
        'end_date' => ['nullable', 'date', 'after:start_date'],
        'thumbnail_th' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'thumbnail_en' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'photo_th' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        'photo_en' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],                
        'pdf_th' => ['nullable', 'mimes:pdf'],
        'pdf_en' => ['nullable', 'mimes:pdf'],
        'condition_th' => ['nullable', 'string'],
        'condition_en' => ['nullable', 'string'],
      ],['required' => 'The :attribute field is required.',
        'after' => 'Promotion end date must be after start date',
        'image' => 'Only accept image file',
        'mimes' => 'Wrong file type']);

      $path = 'image/promotion/'; // upload path

      if ($request->hasFile('thumbnail_th')) {
        $thumbnailth = $request->file('thumbnail_th');
        $nameThumbnailth = Str::slug(Str::random(10)).'.'.$request->file('thumbnail_th')->getClientOriginalName();
        $thumbnailth->move($path, $nameThumbnailth);
        File::delete('image/promotion/'.$promotion->thumbnail_th);
        Promotion::whereId($id)->update(['thumbnail_th' => $nameThumbnailth]);
      }

      if ($request->hasFile('thumbnail_en')) {
        $thumbnailen = $request->file('thumbnail_en');
        $nameThumbnailen = Str::slug(Str::random(10)).'.'.$request->file('thumbnail_en')->getClientOriginalName();
        $thumbnailen->move($path, $nameThumbnailen);
        File::delete('image/promotion/'.$promotion->thumbnail_en);
        Promotion::whereId($id)->update(['thumbnail_en' => $nameThumbnailen]);
      }           

      if ($request->hasFile('photo_th')) {
        $phototh = $request->file('photo_th');
        $namePhototh = Str::slug(Str::random(10)).'.'.$request->file('photo_th')->getClientOriginalName();    
        $phototh->move($path, $namePhototh);
        File::delete('image/promotion/'.$promotion->photo_th);
        Promotion::whereId($id)->update(['photo_th' => $namePhototh]);
      }

      if ($request->hasFile('photo_en')) {
        $photoen = $request->file('photo_en');
        $namePhotoen = Str::slug(Str::random(10)).'.'.$request->file('photo_en')->getClientOriginalName();    
        $photoen->move($path, $namePhotoen);
        File::delete('image/promotion/'.$promotion->photo_en);
        Promotion::whereId($id)->update(['photo_en' => $namePhotoen]);
      } 

      $pathPdf = 'pdf/promotion/'; // upload path

      if ($request->hasFile('pdf_th')) {
        $pdfth = $request->file('pdf_th');
        $namePdfth = $request->file('pdf_th')->getClientOriginalName();    
        $pdfth->move($pathPdf, $namePdfth);
        File::delete('pdf/promotion/'.$promotion->pdf_th);
        Promotion::whereId($id)->update(['pdf_th' => $namePdfth]);
      }

      if ($request->hasFile('pdf_en')) {
        $pdfen = $request->file('pdf_en');
        $namePdfen = $request->file('pdf_en')->getClientOriginalName();    
        $pdfen->move($pathPdf, $namePdfen);
        File::delete('pdf/promotion/'.$promotion->pdf_en);
        Promotion::whereId($id)->update(['pdf_en' => $namePdfen]);
      }

      // priority change
      $newPromotion = Promotion::where('new', 'Yes')->get();
      $count = count($newPromotion);
      $max = Promotion::max('priority');
      if ($request->new == 'Yes' && $promotion->new == 'No') {
        if ($count == 2) {
          $oldest = Promotion::where('new', 'Yes')->orderBy('priority')->first();
          $oldest->update(['new' => 'No']);
          $oldest->save();
        }
        Promotion::where('priority', '>', $promotion->priority)->update(['priority' => DB::raw('priority - 1')]);
          $promotion->update(['priority' => $max]);
          $promotion->save();
      } elseif ($request->new == 'No' && $promotion->new == 'Yes') {
        $lastest = ($max - $count) + 1 ;
        Promotion::where('new','Yes')->where('priority', '<', $promotion->priority)->update(['priority' => DB::raw('priority + 1')]);
          $promotion->update(['priority' => $lastest]);
          $promotion->save();
      }

      // update
      Promotion::whereId($id)->update([
          'type' => $data['type'],
          'new' => $data['new'],
          'layout' => $data['layout'],
          'title_th' => $data['title_th'],
          'title_en' => $data['title_en'],
          'slug_url_th' => $data['slug_url_th'],
          'short_detail_th' => $data['short_detail_th'],
          'short_detail_en' => $data['short_detail_en'],
          'start_date' => $start_date,
          'end_date' => $end_date,
          'condition_th' => $data['condition_th'],
          'condition_en' => $data['condition_en'],
      ]);

      $pathImage = 'image/promotion/'.$request->slug_url_en;

      if ($request->hasFile('image_th')) {

        foreach ($request->file('image_th') as $image) {
          $nameImageth = Str::slug(Str::random(10)).'.'.$image->getClientOriginalName();    
          $image->move($pathImage, $nameImageth);   

          $promotion->images_th()->create([
            'image' => $nameImageth,
          ]);
        }
      }      

      if ($request->hasFile('image_en')) {

        foreach ($request->file('image_en') as $image) {
          $nameImageen = Str::slug(Str::random(10)).'.'.$image->getClientOriginalName();    
          $image->move($pathImage, $nameImageen);   

          $promotion->images_en()->create([
            'image' => $nameImageen,
          ]);
        }
      }

      return redirect('/admin/promotion')->with('success', 'Promotion is successfully updated');
    }

  	public function changeStatus(Request $request)
    {
      $promotion = Promotion::find($request->promotion_id);
      $promotion->status = $request->status;
      $promotion->save();

      return response()->json(['success'=>'Status change successfully.']);
    }

    public function changePriorityPromotion(Request $request)
    {
        $promotion = Promotion::find($request->priority_id);
        $newPromotion = Promotion::where('new', 'Yes')->get();
        $count = count($newPromotion);
        if ($promotion->priority == null) {
          $min = Promotion::min('priority');
          if ($min == null) {
            $min = 1;
          }
          Promotion::where('priority','>','0')->update(['priority' => DB::raw('priority + 1')]);
          $promotion->update(['priority' => $min]);
          $promotion->save();

          return response()->json(['error'=>'Error: please try again']);

        } else if ($promotion->status == 0) {
          return response()->json(['error'=>'Error: Only active item can be changed']);

        } else {
            if ($request->priority == 'first') {
                $max = Promotion::max('priority');
                if ($promotion->priority == $max) {
                  return response()->json(['error'=>'Error: This item is at top']);

                } else {
                  if ($promotion->new == 'No') {
                    $maxold = $max - $count;
                    if ($promotion->priority == $maxold) {
                      return response()->json(['error'=>'Error: This item is at top of normal promotion, to make this higher, edit this promotion to highlight promotion']);

                    } else {
                      Promotion::where('new','No')->where('priority', '>', $promotion->priority)->update(['priority' => DB::raw('priority - 1')]);
                      $promotion->update(['priority' => $maxold]);
                      $promotion->save();
                      return response()->json(['success'=>'Success: Priority is successfully changed']);

                    }
                  } else {
                    Promotion::where('priority', '>', $promotion->priority)->update(['priority' => DB::raw('priority - 1')]);
                    $promotion->update(['priority' => $max]);
                    $promotion->save();
                    return response()->json(['success'=>'Success: Priority is successfully changed']);
                  }
                }
            } elseif ($request->priority == 'last') {
                $min = Promotion::min('priority');
                if ($promotion->priority == $min) {
                  return response()->json(['error'=>'Error: This item is at bottom']);

                } else {
                  if ($promotion->new == 'Yes') {
                    $minnew = Promotion::where('new','Yes')->min('priority');
                    if ($promotion->priority == $minnew) {
                      return response()->json(['error'=>'Error: This item is at bottom of highlight promotion, to make this lower, edit this promotion to normal promotion']);

                    } else {
                      Promotion::where('new','Yes')->where('priority', '<', $promotion->priority)->update(['priority' => DB::raw('priority + 1')]);
                      $promotion->update(['priority' => $minnew]);
                      $promotion->save();
                      return response()->json(['success'=>'Success: Priority is successfully changed']);
                    }
                  } else {
                    Promotion::where('priority', '<', $promotion->priority)->update(['priority' => DB::raw('priority + 1')]);
                    $promotion->update(['priority' => $min]);
                    $promotion->save();
                    return response()->json(['success'=>'Success: Priority is successfully changed']);
                  }
                }
            } elseif ($request->priority == 'up') {
                $above = Promotion::where('priority', $promotion->priority+1)->first();
                $maxold = Promotion::where('new', 'No')->max('priority');
                if ($above) {
                  if ($promotion->priority == $maxold) {
                    return response()->json(['error'=>'Error: This item is at top of normal promotion, to make this higher, edit this promotion to highlight promotion']);

                  } else {
                    $above->update(['priority' => DB::raw('priority - 1')]);
                    $above->save();
                    $promotion->update(['priority' => DB::raw('priority + 1')]);
                    $promotion->save();
                    return response()->json(['success'=>'Success: Priority is successfully changed']);
                  }
                } else {
                  $above2 = Promotion::where('priority','>',$promotion->priority)->orderBy('priority')->first();
                  if ($above2) {
                    $distance = $above2->priority - $promotion->priority;
                    $above2->update(['priority' => DB::raw('priority - '.$distance.'')]);
                    $above2->save();
                    $promotion->update(['priority' => DB::raw('priority + 1')]);
                    $promotion->save();
                    return response()->json(['success'=>'Success: Priority is successfully changed']);
                  } else {
                    return response()->json(['error'=>'Error: This item is at top']);

                  }
                }
            } elseif ($request->priority == 'down') {
                $below = Promotion::where('priority', $promotion->priority-1)->first();
                $minnew = Promotion::where('new', 'Yes')->min('priority');
                if ($below) {
                  if ($promotion->priority == $minnew) {
                    return response()->json(['error'=>'Error: This item is at bottom of highlight promotion, to make this lower, edit this promotion to normal promotion']);

                  } else {
                    $below->update(['priority' => DB::raw('priority + 1')]);
                    $below->save();
                    $promotion->update(['priority' => DB::raw('priority - 1')]);
                    $promotion->save();
                    return response()->json(['success'=>'Success: Priority is successfully changed']);
                  }
                } else {
                  $below2 = Promotion::where('priority','<',$promotion->priority)->orderByDESC('priority')->first();
                  if ($below2) {
                    $distance = $promotion->priority - $below2->priority;
                    $below2->update(['priority' => DB::raw('priority + 1')]);
                    $below2->save();
                    $promotion->update(['priority' => DB::raw('priority - '.$distance.'')]);
                    $promotion->save();
                    return response()->json(['success'=>'Success: Priority is successfully changed']);
                  } else {
                    return response()->json(['error'=>'Error: This item is at bottom']);

                  }
                }
            }
        }
        return response()->json(['error'=>'Error: Something wrong, please try again or contact IT staff']);
    }

    public function imageDelete($id){
        $image_th = Promotion_Image_TH::findOrFail($id);
        $image_th->delete();
      
        return response()->json(['success' => 'Image deleted successfully!']);
    }
    public function imageDelete2($id){
        $image_th = Promotion_Image_EN::findOrFail($id);
        $image_th->delete();
      
        return response()->json(['success' => 'Image deleted successfully!']);
    }

    public function imageDeletePromotion(Request $request, $id)
    {
      $type = $request->type;
      $promotion = Promotion::find($id);
      if ($type == 'thumbnail_th') {
        File::delete('image/promotion/'.$promotion->thumbnail_th);
        Promotion::whereId($id)->update(['thumbnail_th' => '-']);
      } elseif ($type == 'photo_th') {
        File::delete('image/promotion/'.$promotion->photo_th);
        Promotion::whereId($id)->update(['photo_th' => '-']);
      } elseif ($type == 'thumbnail_en') {
        File::delete('image/promotion/'.$promotion->thumbnail_en);
        Promotion::whereId($id)->update(['thumbnail_en' => '-']);
      } elseif ($type == 'photo_en') {
        File::delete('image/promotion/'.$promotion->photo_en);
        Promotion::whereId($id)->update(['photo_en' => '-']);
      }
      return response()->json(['success' => 'Image deleted successfully!']);
    }

    public function destroy($id)
    {
      $promotion = Promotion::findOrFail($id);
      Promotion::where('priority', '>', $promotion->priority)->update(['priority' => DB::raw('priority - 1')]);
      File::delete('image/promotion/'.$promotion->thumbnail_th, 'image/promotion/'.$promotion->thumbnail_en, 'image/promotion/'.$promotion->photo_th, 'image/promotion/'.$promotion->photo_en, 'pdf/promotion/'.$promotion->pdf_th, 'pdf/promotion/'.$promotion->pdf_en);
      File::deleteDirectory('image/promotion/'.$promotion->slug_url_en);
      $promotion->delete();
      return response()->json(['success'=>'Delete successfully.']);
    }
}
