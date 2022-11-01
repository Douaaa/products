@extends('layouts.master')

@section('title' , trans('all.site-title'))

@section('content')
<div class="page-content back-page">
  <div class="banner">
    <div class="opacity">
      <ul>
        <li>
          <a href="{{url('/')}}">الرئيسية</a>
        </li>
        <li>
          /
        </li>
        <li>
          حساب جديد
        </li>
      </ul>
      <h2>حساب جديد</h2>
    </div>
  </div>
  <div class="content-details" style="">
    <div class="container">
      <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
          <div class="form-content">
            <form  method="POST" id="register_form" name="register_form" action="{{url('/register') }}" enctype="multipart/form-data">
                <h2 class="tex-center">إنشاء حساب</h2>
              <meta name="csrf-token" content="{{ csrf_token() }}">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">الاسم الأول</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="الاسم الأول" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">الاسم الأخير</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastName" name="lastName" placeholder="الاسم الأخير" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">الجوال</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="الجوال" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">البريد الالكتروني</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="البريد الالكتروني" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">كلمة المرور</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور" />
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">تأكيد كلمة المرور</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="confirm" name="confirm" value="" placeholder="تأكيد كلمة المرور" />
                </div>
              </div>

              <!-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-company">المرحلة الدراسية </label>
                <div class="col-sm-10">
                  <select class="form-select" id="stage" name="stage" aria-label="Default select example">
                    <option value="1" selected>الأول الابتدائي </option>
                    <option value="2">الثاني الابتدائي</option>
                    <option value="3">الثالث الابتدائي</option>

                  </select>
                </div>
              </div> -->
              <div class="row justify-content-end">
                <div class="col-sm-12 text-center">
                  <button type="submit" id="addBtn" class="btn profileBtn">إنشاء</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- <div class="col-md-6">
          <div class="image-section">
            <img src="{{asset('images/register.png')}}" alt="">

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
$("#register_form").validate({

    rules: {
        name: {
            required: true,

        },
        email: {
            required: true,
            email:true,

        },
        phone: {
            required: true,

        },
        password:{
          required:true,
          minlength:6
        },
        confirm:{

          equalTo:"#password",
        }



    },
    messages: {
      confirm:{
        equalTo:"الرجاء إدخال نفس كلمة المرور السابقة"
      }
    },
    submitHandler: function (form) {

      var formData = new FormData($('form')[0]);
        $.ajax({
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            type: "POST",
            url: "{{ url('api/register') }}",
            data:formData,
            dataType:"json",
            cache:false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
              console.log(response);

              if (response.status=="success") {
                swal({
                  title: 'تهانينا',
                  text: 'تم انشاء الحساب بنجاح',
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
                var url = "{{ url('/') }}";
                setTimeout(function(){ window.location = url; }, delay);
                  break;
              }

            });
          }else if (response.status=='token') {
            swal({
              title: 'عذرا ',
              text: 'هذا الايميل مستخدم سابقا',
              icon: 'error',
              button: 'حسنا',
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
