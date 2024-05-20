@extends('Layout.layout')

@section('title', 'Post View')

@section('header')
    @parent
@endsection

@section('pageMenu')
    <a href="{{ url('/post-add') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Add Post</a>
@endsection

@section('bodySection')
    @parent
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
           User Posts
        </div>

        <div style=" border-radius: 5px 5px; background: white; margin: 20px; padding: 10px; width: 500px;">
            <table style="width: 100%">
               <thead>
               <tr>
                   <th> No.</th>
                   <th> Title</th>
                   <th> Description</th>
                   <th> Image </th>
                   <th></th>
               </tr>
               </thead>
                <tbody>
                <tr>
                    <th> No.</th>
                    <th> Title</th>
                    <th> Description</th>
                    <th> Image </th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection

@section('pageScript')
    @parent
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
            if( error.response.status === 401)
            {
                window.location='/'
            }
            console.log(error)
        });
    }

   // fetchProfile();

</script>


@endsection

@section('pageFooter')
    @parent
    <h1> Page Footer</h1>
@endsection
