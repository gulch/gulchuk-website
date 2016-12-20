<?php $this->layout('backend/auth/template', ['title' => 'Set new password :: Gulchuk']) ?>

<div class="ui container">
    <div class="ui centered stackable grid">
        <div class="six wide column">
            <div class="ui left aligned segment">

                <h2 class="ui teal header">
                    <div class="content">
                        Set new password
                    </div>
                </h2>

                <?php $this->insert('backend/includes/errors-message') ?>

                <form class="ui form" action="/auth/reset" method="POST">
                    <div class="field">
                        <div class="ui left icon input">
                            <input type="text" name="email" placeholder="Email" value="{{ $email }}">
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
                        <div class="ui left icon input">
                            <input type="password"
                                   name="password_confirmation"
                                   placeholder="Password confirmation"
                            >
                            <i class="lock icon"></i>
                        </div>
                    </div>

                    <input type="hidden" name="token" value="<?= $token ?>">

                    <button class="ui basic large button" type="submit">
                        <i class="undo icon"></i>
                        Reset
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>