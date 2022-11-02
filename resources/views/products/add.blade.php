@extends('layouts.master')
@section('title' , trans('all.site-title'). " - ". $pageInfo['title'])
@section('content')
<div class="page-content back-page">
  <div class="banner">
    <div class="opacity">
      <ul>
        <li>
          <a href="{{url('/my_products')}}">منتجاتي</a>
        </li>
        <li>
          /
        </li>
        <li>
        إضافة منتح
        </li>
      </ul>
      <h2>إضافة منتح</h2>
    </div>
  </div>
  <div class="content-details">
    <div class="container">
      <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
          <div class="form-content">
            <form  method="POST" id="addBlock" name="addBlock" action="{{ url('api/product/add') }}" enctype="multipart/form-data">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">اسم المنتج</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" placeholder="" value="" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">توصيف المنتج</label>
                <div class="col-sm-10">
                  <textarea id="description" name="description" class="form-control" contenteditable="true" ></textarea>

                </div>
              </div>


              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-email">إضافة صورة</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                      <input class="form-control" type="file" name="image" id="image" />
                  </div>
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-12 text-center" >
                  <button type="submit" id="addBtn" class="btn  profileBtn">إضافة منتج</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- <div class="col-md-6">
          <div class="image-section">
            <img src="{{asset('images/login.png')}}" alt="">

          </div>
        </div> -->

      </div>
    </div>


  </div>
</div>
<script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/messages_ar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>

<script src="{{ asset('admin/assets/js/jquery.form.js') }}"></script>
  <script src="	http://github.com/form-data/form-data#readme"></script>
<script type="text/javascript">
$("#addBlock").validate({

    rules: {
        name: {
            required: true,

        },
        
        image: {
            required: true,

        },

    },
    messages: {

    },
    submitHandler: function (form) {


      var formData = new FormData($('form')[0]);
        $.ajax({
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            type: "POST",
            url: "{{ url('api/product/add') }}",
            data:formData,
            dataType:"json",
            cache:false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
              console.log(response);
              if (response.status=='success') {
                swal({
                  title: 'تهانينا',
                  text: 'تم إضافة المنتج بنجاح',
                  icon: 'success',
                  buttons: {
                    catch: {
                      text: 'حسنا',
                      value: "catch",
                    },
                  },
            }).then((value) => {
              switch (value) {
                case "catch":
                var delay = 1000;
                var url = "{{ url('my_products') }}";
                setTimeout(function(){ window.location = url; }, delay);
                  break;
              }

            });
          }else{
            swal({
              title: 'عذرا ',
              text: 'يوجد خطأ ما ، الرجاء المحاولة لاحقا !',
              icon: 'error',
              button: 'حسنا',
        });
          }

            }
        });
        return false;
    }
});
</script>

 @endsection
