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
        <div class="flex justify-center p-[5px] bg-white rounded-md">
            User Registration
        </div>

        <div  class="w-[500px] m-[20px] p-[10px] rounded-md bg-white ">
            <div class="my-2">
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2 rounded-md shadow-sm">
                    <input type="text" value="Pankaj Kumar" id="name" class="block w-full rounded-md py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="Pankaj Kumar">
                    <span  class="text-red-500 text-xs font-bold"  id="error_name"></span>
                </div>
            </div>
            <div class="my-2">
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2 rounded-md shadow-sm">
                    <input type="text" value="pankaj@example.com" id="email" class="block w-full rounded-md border-gray-100 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="user@example.com">
                    <span  class="text-red-500 text-xs font-bold"  id="error_email"></span>
                </div>
            </div>
            <div class="my-2">
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">password</label>
                <div class="mt-2 rounded-md shadow-sm">
                    <input type="password" value="password" id="password"  class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:border-gray-600 sm:text-sm sm:leading-6" placeholder="password">
                    <span class="text-red-500 text-xs font-bold" id="error_password"></span>
                </div>
            </div>
            <div class="m-[5px]">
                <button style="margin: 2px; padding: 5px; background: red; color:white; border-radius: 5px 5px;" onclick="signIn()"> Register </button>
                <button style="margin: 2px; padding: 5px; background: lightgray;  border-radius: 5px 5px;" onclick="reset()"> Cancel </button>
            </div>
        </div>

    </div>

</div>

<div style="margin:5px 0; float: left; display: inline;">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }}
</div>
<div style="margin:5px 0; float: right; display: inline;">
   (PHP v{{ PHP_VERSION }})
</div>

@include('Layout.script')

<script>

    function signIn() {

        let email = document.getElementById('email').value ;
        let password = document.getElementById('password').value;
        let name = document.getElementById('name').value ;

        axios.post('/api/register',{name:name , email:email , password:password}).then((res)=>{
            if( res.status === 200 && res.data.status == 'success'  ) {
                Toastify({
                    text: "Registration successfully done",
                    duration: 2000
                }).showToast();

                reset();
            }
        }).catch((error)=>{console.log(error)
            if(error && error.response.status === 422){
                Object.entries(error.response.data.errors).forEach( (e)=>{
                    document.getElementById('error_'+e[0]).innerHTML = e[1][0];
                })
            }
        });
    }

    function reset() {
        document.getElementById('email').value ='';
        document.getElementById('password').value ='';
        document.getElementById('name').value  ='';

        document.getElementById('error_email').innerHTML ='';
        document.getElementById('error_password').innerHTML ='';
        document.getElementById('error_name').innerHTML  ='';
    }


</script>
</body>
</html>
