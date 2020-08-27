@extends('layouts.base')

@section('content')
        <!-- Point Table Section Start -->
        <div class="rs-point-table sec-spacer">
                <div class="container">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf    
                            <fieldset>
                                    <div class="row custom-login-btn-wrapper">                                      
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Registračné čislo *</label>
                                               
                                                <input id="registration_number" maxlength="7" type="registration_number" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number') }}" required autocomplete="registration_number" autofocus>

                                                @error('registration_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>                                        
                                            <div class="form-group">
                                                <label>Heslo *</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            <input class="custom-btn" type="submit" value="Prihlásiť">
                                        </div>
                                    </div>                                   
                                </fieldset>
                            </form>	
                </div>
            </div>
            <!-- Point Table Section End -->
            
@endsection
