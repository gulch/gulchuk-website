@extends('auth.template', [
    'title' => 'Password recovery :: Gulchuk'
])

@section('content')
    <div class="ui container">
        <div class="ui centered stackable grid">
            <div class="six wide column">
                <div class="ui left aligned segment">

                    <h2 class="ui teal header">
                        <div class="content">
                            Password recovery
                        </div>
                    </h2>

                    @include('backend._partials.errors_message')

                    <form class="ui form" action="/auth/recover" method="POST">
                        <div class="field">
                            <div class="ui left icon input">
                                <input type="text" name="email" placeholder="Email">
                                <i class="mail icon"></i>
                            </div>
                        </div>

                        <button class="ui basic large button" type="submit">
                            <i class="undo icon"></i>
                            Recover
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
