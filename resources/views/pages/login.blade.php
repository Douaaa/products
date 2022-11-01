@extends('layouts.master')

@section('title' , trans('all.site-title'). " - ". $pageInfo['title'])
@section('content')
<div class="page-content back-page">
  <div class="banner">
    <div class="opacity">
      <ul>
        <li>
          <a href="{{url('/ar')}}">الرئيسية</a>
        </li>
        <li>
          /
        </li>
        <li>
          تسجيل دخول
        </li>
      </ul>
      <h2>تسجيل دخول</h2>
    </div>
  </div>
  <div class="content-details">
    <div class="container">
      <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
          <div class="form-content">
            <form  method="POST" id="login_form" name="login_form" action="{{ url('api/login') }}" enctype="multipart/form-data">
              <h2 class="tex-center">تسجيل دخول</h2>
              <meta name="csrf-token" content="{{ csrf_token() }}">
              @csrf
              <!-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">الاسم</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fullName" name="fullName" placeholder="الاسم" />
                </div>
              </div> -->
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">البريد الإلكتروني</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" placeholder="البريد الإلكتروني" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">كلمة المرور</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور" />
                </div>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-company">تذكرني</label>
                  <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember-me" />
                  </div>

              </div>

              <div class="row justify-content-end">
                <div class="col-sm-12 text-center" >
                  <button type="submit" id="addBtn" class="btn  profileBtn">تسجيل دخول</button>
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
$("#login_form").validate({

    rules: {

        email: {
            required: true,
            email:true,

        },

        password:{
          required:true,

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
            url: "{{ url('api/login') }}",
            data:formData,
            dataType:"json",
            cache:false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
              console.log(response);

              if (response.status=='success') {
                var delay = 1000;
                var url = "{{ url('/') }}";
                setTimeout(function(){ window.location = url; }, delay);

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
