
                           
            <div class="col-sm-2">
            
                    <div class="container">
                        <img src="https://scontent-lax3-1.xx.fbcdn.net/v/t1.0-9/1936510_10207216981375364_4596889339024157957_n.jpg?oh=f3031e9add8769ca489e5865a54b6bc4&oe=57B0E02E"
                             class="img-rounded" alt="{{$client->first_name}} {{$client->middle_name}} {{$client->last_name}}" width="150" height="150">
                    </div>
                
            </div>
            <div class="col-sm-10">
                <div class="container">

                    <h4>{{$client->first_name}} {{$client->middle_name}} <b>{{$client->last_name}}</b></h4>

                    <p>E {{$client->email}} | P {{$client->number}}</p>

                    <p>
                        {{ $client->street }}
                        {{ $client->suburb }}
                        {{ $client->state }}
                        {{ $client->postcode }}
                        {{ get_country($client->country_id) }}
                    </p>


                </div>
                <div class="container">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand visible-xs" href="#">AMS</a>
                            </div>

                            @include('Tenant::Client/navbar')
                        </div>
                        <!--/.container-fluid -->
                    </nav>

                </div>


            </div>

