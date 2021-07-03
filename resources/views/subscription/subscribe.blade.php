@extends('layout.layout')
@section('content')
<!-- Page header -->
<div class="page-header page-header-light">

    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                <span class="breadcrumb-item active">Subscribe</span>
            </div>

            <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
        </div>


    </div>
</div>
<!-- Content area -->
<div class="content">

    <!-- Basic responsive configuration -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Dear {{$user->first_name}}</h5>
        </div>
        <div class="card-body">


            <p>Complete Solutions - Let our CA Prepare & eFile your Taxes</p>

                <form id="promo_form" action="{{route('plan.promo')}}" method="post">
               @csrf
               <div class="form-group row">
                <div class="col-md-5">
                    <input hidden type="text" name="id" value="{{$user->id}}">
                        <input type="text" name="promo_Code" class="form-control"  placeholder="Promo code" value="">
                        @if ($errors->has('promo_Code'))
                      <span class="text-danger">{{ $errors->first('promo_Code') }}</span>
                     @endif
                </div>
                <div class="col-md-2">
                    <button type="submit" class="promo_submit btn btn-primary">Apply</button>    
                </div>   
               </div>
                
                </form>
            <table class="table">
            <thead>
                <tr>
                    <th>My ITR</th>
                    <th>Product</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <form action="{{route('payment')}}" method="post">
                @csrf
                <input type="text" name="user" value="{{$user->id}}" hidden>
                                           <!-- <td rowspan="{{$plans->count()+1}}">{{$user->first_name}}</td> -->

                @php($i=1)


                @foreach ($plans as $plan)
                <tr>
                    @if ($i ==1)
                    <td rowspan="{{$plans->count()}}">{{$user->first_name}} {{$user->last_name}}</td>
                    @endif
                    <td>
                        <label class="form-check-label">
                            <input class="plan" type="radio" class="form-check-input" id="" name="plan" value="{{$plan->id}}"> {{$plan->name}}
                        </label>
                    </td>
                    <td>{{number_format($plan->amount,2)}}</td>
                </tr>
                @php($i++)
                @endforeach
                <tr>

                    <td colspan="3" class="">
                        <div class="form-group row">
                            <label>Comment <span class="text-danger">*</span></label>
                            <textarea type="text" name="comment" class="form-control" required placeholder="comment" value=""></textarea>
                        </div>
                    </td>
                </tr>
                <tr>

                    <td colspan="3" class="text-right"><button disabled type="submit" class="submit btn btn-primary">Proceed to Payment Gateway</button></td>
                </tr>
            </form>

            </tbody>
        </table>      
                   </div>
        
               

        
    </div>
    <script>
//    $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
// $(document).on('click', '.promo_submit', function(e) {
//         $('.text-danger').html('');
//         var fd = new FormData($('#promo_form')[0]);
//       e.preventDefault();
//       $.ajax({
        
//         url: "{{ route('plan.promo') }}",
//         data: fd,
        
//         processData: false,
//         contentType: false,
//         dataType: 'json',
//         type: 'POST',
//                  cache: false,
       
//         error: function(error){

//         var error=error.responseJSON;

//         $.each(error.errors,function(k,v){
//             console.log(k)
//             if(k=="year"){
//                 $('year').html(v);
//             }
//             if(k=="status"){
//                 $('.status').html(v);
//             }
          
          
//         });                           

// },
//         success: function(data) {
          
//           alertify.set('notifier', 'position', 'top-right');
//             var notification = alertify.notify(data.message, 'success', 6);
//           $('#createBtn').attr('disabled', false);
//           $('.message_box').html(data.msg).removeClass('hide alert-danger').addClass('alert-success');
         
//         }
//       });
//     });
    
        $(function () {


            $(".plan").on('change', function () {
                $('.submit').removeAttr("disabled")
            })
        })

    </script>


    @endsection
    @section('header-scripts')
    <!-- dashboard -->
    <script src="{!! asset('global_assets/js/demo_pages/dashboard.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/streamgraph.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/sparklines.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/lines.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/areas.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/donuts.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/bars.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/heatmaps.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/pies.js') !!}"></script>
    <script src="{!! asset('global_assets/js/demo_charts/pages/dashboard/light/bullets.js') !!}"></script>

    @endsection
