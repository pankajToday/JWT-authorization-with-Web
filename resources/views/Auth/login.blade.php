<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Layout.head')

<body class="antialiased">
<div style="height: auto; min-height: 600px;"  class="content relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
   @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center  bg-white" style="border-radius: 5px 5px;">
          JWT Token based  Login
        </div>

        <div style=" border-radius: 5px 5px; background: white; margin: 20px; padding: 10px; width: 500px;">
            <div class="my-2">
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2 rounded-md shadow-sm">
                    <input type="text" value="email@example.com" id="email" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="user@example.com">
                </div>
            </div>
            <div style="margin: 5px;">
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">password</label>
                <div class="mt-2 rounded-md shadow-sm">
                    <input type="password" value="password" id="password"  class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="password">
                </div>
            </div>
            <div class="" style="margin: 5px">
                <button style="margin: 2px; padding: 5px; background: red; color:white; border-radius: 5px 5px;" onclick="login()"> Login </button>
                <button style="margin: 2px; padding: 5px; background: lightgray;  border-radius: 5px 5px;"> Cancel </button>
            </div>
        </div>

    </div>
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center bg-white" style="border-radius: 5px 5px;">
             Web Basic  Login
            </div>

            <form method="post" action="/web-login">

                {{csrf_field()}}
            <div style=" border-radius: 5px 5px; background: white; margin: 20px; padding: 10px; width: 500px;">
                <div class="my-2">
                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2 rounded-md shadow-sm">
                        <input type="text" name="email" value="email@example.com" id="email" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="user@example.com">
                    </div>
                </div>
                <div style="margin: 5px;">
                    <label for="price" class="block text-sm font-medium leading-6 text-gray-900">password</label>
                    <div class="mt-2 rounded-md shadow-sm">
                        <input type="password"  name="password" value="password" id="password"  class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="password">
                    </div>
                </div>
                <div class="" style="margin: 5px">
                    <input type="submit"  style="margin: 2px; padding: 5px; background: red; color:white; border-radius: 5px 5px;" value="Login" />
                    <button style="margin: 2px; padding: 5px; background: lightgray;  border-radius: 5px 5px;"> Cancel </button>
                </div>
            </div>
            </form>

        </div>
    </div>


@include('Layout.script')

<script>

    function login() {

        let email = document.getElementById('email').value ;
        let password = document.getElementById('password').value;

      axios.post('/api/login',{email:email ,password:password}).then((res)=>{
          if( res.status === 200 && res.data.status == 'success'  ) {
           //   document.cookie = 'auth_token=' + res.data.authorisation.token;
              window.location='/home-mobile';
          }

      }).catch((error)=>{
          console.log(error)
      });
    }

</script>



</body>
</html>
