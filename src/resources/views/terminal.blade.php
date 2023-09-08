<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.terminal/js/jquery.terminal.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery.terminal/css/jquery.terminal.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    

    

    <template id="greetings">
                                                                                                                              
,-.----.                                                                                                              
\    /  \                        ,--,             .--.--.                                                             
|   :    \                     ,--.'|            /  /    '.                               ,--,                        
|   |  .\ :   ,---.     ,---.  |  | :           |  :  /`. /             __  ,-.         ,--.'|                        
.   :  |: |  '   ,'\   '   ,'\ :  : '           ;  |  |--`            ,' ,'/ /|    .---.|  |,                         
|   |   \ : /   /   | /   /   ||  ' |           |  :  ;_       ,---.  '  | |' |  /.  ./|`--'_       ,---.     ,---.   
|   : .   /.   ; ,. :.   ; ,. :'  | |            \  \    `.   /     \ |  |   ,'.-' . ' |,' ,'|     /     \   /     \  
;   | |`-' '   | |: :'   | |: :|  | :             `----.   \ /    /  |'  :  / /___/ \: |'  | |    /    / '  /    /  | 
|   | ;    '   | .; :'   | .; :'  : |__           __ \  \  |.    ' / ||  | '  .   \  ' .|  | :   .    ' /  .    ' / | 
:   ' |    |   :    ||   :    ||  | '.'|         /  /`--'  /'   ;   /|;  : |   \   \   ''  : |__ '   ; :__ '   ;   /| 
:   : :     \   \  /  \   \  / ;  :    ;        '--'.     / '   |  / ||  , ;    \   \   |  | '.'|'   | '.'|'   |  / | 
|   | :      `----'    `----'  |  ,   /           `--'---'  |   :    | ---'      \   \ |;  :    ;|   :    :|   :    | 
`---'.|                         ---`-'                       \   \  /             '---" |  ,   /  \   \  /  \   \  /  
  `---`                                                       `----'                     ---`-'    `----'    `----'   
                                                                                                                      
    </template>
</body>


<script>
var auth = 0;
var config = "";

$('body').terminal(
    {   
        // define commands
        cat: function(width, height) {
            if (auth != 1) {
                this.error("You don't have permission to do this");
                return ;
            }
            this.echo('<img src="https://placekitten.com/' +
                    width + '/' + height + '">', {raw: true});
        },
        login: function(username, password) {
            loginServer(username, password)
                .then(data => {
                    if (data.data.success == true) {
                        auth = 1;

                        config = {
                            headers: {
                            'Authorization': `Bearer `+data.data.token,
                            'Accept': 'application/json' // Adjust content type if needed
                            }
                        };
                        
                        this.echo("Welcome Admin");
                        return ;
                    } 

                    this.echo("You are not Admin");

                    })
                .catch(error => {                        
                    this.echo(error.response.data.message); // Use the response data
                });
        },
        exit: function() {
            auth = 0;
            logoutServer()
                .then(data => {
                    if (data.data.success == true) {
                        this.echo("Token revoke succesfully");
                        return ;
                    }
                    this.echo("Token revoke failed"); // Use the response data
                    })
                .catch(error => {                        
                        this.echo(error.response.data.message); // Use the response data
                    });
            this.echo("Goodbye Admin");
        },
        server: function(command) {
            switch(command) {
            case 'quote':
                if (auth != 1) {
                    this.error("You don't have permission to do this");
                    break;
                }
                quote()
                    .then(data => {
                        this.echo(data.data); // Use the response data
                    })
                    .catch(error => {                        
                        this.echo(error.response.data.message); // Use the response data
                    });
                break;
            break;
            case 'up':
                if (auth != 1) {
                    this.error("You don't have permission to do this");
                    break;
                }
                up()
                    .then(data => {
                        this.echo(data.data); // Use the response data
                        
                    })
                    .catch(error => {                            
                        this.echo(error.response.data.message); // Use the response data
                    });
                break;
            break;
            case 'down':
                if (auth != 1) {
                    this.error("You don't have permission to do this");
                    break;
                }
                down()
                    .then(data => {
                        this.echo(data.data); // Use the response data
                        
                    })
                    .catch(error => {                            
                        this.echo(error.response.data.message); // Use the response data
                    });
                break;
            default:
                this.error('server what?');
            }
        },

        help: function() {
            help = [
            'up',
            'down',
            'login',
            ];

            help.forEach((element) => this.echo(element));
            

        },

        user: function () {
            user()
            .then(data => {
                    console.log(data);
                    this.echo(data.data.username); // Use the response data
                        
                    })
                    .catch(error => {                            
                        this.echo(error.response.data.message); // Use the response data
                    });
        },
        session: function () {
            session()
            .then(data => {
                    console.log(data);
                    this.echo(data.data); // Use the response data
                        
                    })
                    .catch(error => {                            
                        this.echo(error.response.data.message); // Use the response data
                    });
        }


    },  
    {
        greetings: greetings.innerHTML,
        prompt: 'PoolService@Terminal> '
    },
);
</script>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

    
    
    // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
//     const API_URL = 'http://example.com/api/endpoint';
//     const YOUR_ACCESS_TOKEN = 'YOUR_ACCESS_TOKEN';

//     const axiosInstance = axios.create({
//     headers: {
//     'Authorization': `Bearer ${YOUR_ACCESS_TOKEN}`,
//     'Content-Type': 'application/json', // Adjust content type if needed
//   },
// });

    function loginServer(username,password) {
        return new Promise((resolve, reject) => {

            const data = {
                username: username+"",
                password: password+""
            };

            axios.post("{{route('login.server')}}", data)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }

    function logoutServer() {
        return new Promise((resolve, reject) => {

        var data = {
            token : config.headers.Authorization.split(' ')[1]};

        axios.post("{{route('logout.server')}}", data)
            .then(response => {
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });
    }

    function quote() {
        return new Promise((resolve, reject) => {

            axios.post("{{route('quote.server')}}", null, config)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }

    function up() {
        return new Promise((resolve, reject) => {

            axios.post("{{route('up.server')}}", null)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }

    function down() {
        return new Promise((resolve, reject) => {

            axios.post("{{route('down.server')}}", null)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }

    function user() {
        return new Promise((resolve, reject) => {

            axios.post("{{route('getUser')}}", null, config)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }

    function session() {
        return new Promise((resolve, reject) => {

            axios.post("{{route('session')}}", null, config)
                .then(response => {
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }




</script>

<style>
    
:root {
   --size: 1.4;
}

</style>

</html>