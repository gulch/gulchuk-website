<?php $this->layout('auth/template', ['title' => 'Login :: Gulchuk']) ?>

<div class="ui container">
    <div class="ui centered stackable grid">
        <div class="six wide column">
            <div class="ui left aligned segment">

                <h2 class="ui teal header">
                    <div class="content">
                        Login
                    </div>
                </h2>

                <?php $this->insert('backend/_partials/errors-message') ?>

                <form class="ui form" action="/auth/login" method="POST">
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="text" name="email" placeholder="Email">
                            <i class="mail icon"></i>
                        </div>
                    </div>

                    <div class="field">
                        <div class="ui left icon input">
                            <input type="password" name="password" placeholder="Password">
                            <i class="lock icon"></i>
                        </div>
                    </div>

                    <div class="field">
                        <div class="ui checkbox">
                            <input name="remember" type="checkbox" tabindex="0" value="1" class="hidden">
                            <label>Remember</label>
                        </div>
                    </div>

                    <button class="ui basic large button" type="submit">
                        Login <i class="sign in icon"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>