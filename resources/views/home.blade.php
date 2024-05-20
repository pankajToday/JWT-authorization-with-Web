<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Layout.head')

<body class="antialiased">
<div style="height: auto; min-height: 600px;"  class="content relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    <a href="{{ url('/posts') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Post</a>
                    <a href="{{ url('/logout') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    Profile
                </div>

                <div style=" border-radius: 5px 5px; background: white; margin: 20px; padding: 10px; width: 500px;">
                    <table>
                        <tr>
                            <th> Id</th>
                            <td> <span id="id_output"></span> </td>
                        </tr>
                        <tr>
                            <th> Email</th>
                            <td> <span id="email_output"></span> </td>
                        </tr>
                        <tr>
                            <th> Name</th>
                            <td> <span id="name_output"></span> </td>
                        </tr>
                        <tr>
                            <th> Auth User</th>
                            <td> {{auth()->user()->name}} </td>
                        </tr>

                    </table>
                </div>

            </div>
    </div>

@include('Layout.script')

<script>
    function getCookie(name) {
        let cookie = {};
        document.cookie.split(';').forEach(function(el) {
            let split = el.split('=');
            cookie[split[0].trim()] = split.slice(1).join("=");
        })
         return cookie[name];
    }

     var profile='';

    function fetchProfile() {

        const  headers = {headers: {
            'Authorization': 'Bearer '+ getCookie('auth_token')
        }};
        axios.post('/api/profile',{page:1}, headers ).then((res)=>{
            if( res.status === 200 && res.data.status == 'success'  ) {
                profile = res.data.user;

                document.getElementById('id_output').innerHTML =profile.id;
                document.getElementById('email_output').innerHTML =profile.email;
                document.getElementById('name_output').innerHTML =profile.name;
            }

        }).catch((error)=>{
            console.log(error)
        });
    }

    fetchProfile();

</script>

</body>
</html>
