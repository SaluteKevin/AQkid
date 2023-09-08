<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

@error('error')
<script>
        window.onload = function() {
            alert("{{ $message }}");
        };
    </script>
@enderror

<a href="{{ route('logout') }}">{{Auth::getUser()->email}} test</a>
<form id="myForm">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <button type="button" onclick="sendData('{{Auth::getUser()->username}}')">Submit</button>
</form>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Get the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Set the CSRF token in the Axios default headers
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

    function sendData(username) {
        
        const dataToSend = {
            key1: null,
            key2: null,
        };

        axios.post("{{route('axios')}}", dataToSend)
            .then(response => {
                console.log(response); // Output: Data received successfully
            })
            .catch(error => {
                console.error(error.response.data.errors);
                
                if (error.response && error.response.data && error.response.data.errors) {
                    const validationErrors = error.response.data.errors;
                    
                    // Loop through validation errors and display them
                    for (const key in validationErrors) {
                        if (validationErrors.hasOwnProperty(key)) {
                            alert(validationErrors[key][0]);
                        }
                    }
                } else {
                    alert('An error occurred.'); // Display a generic error message
                }
            });
    }


</script>

</html>

