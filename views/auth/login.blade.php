<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>Login</title>

        @include('assets.css')
    </head>
    <body>
        <div class="ui middle aligned center aligned grid">
            <div class="column">
                <form class="ui large form" method="post" action="/login">
                    <div class="ui stacked segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="E-mail address">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="ui fluid large green submit button">Login</div>
                    </div>
                    <div class="ui error message"></div>
                </form>
            </div>
        </div>
    </body>
</html>

