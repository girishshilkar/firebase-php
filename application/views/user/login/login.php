<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/10/2018
 * Time: 1:52 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="col-md-6">
        <form id="login-form" method="post" role="form">
            <h3>Login</h3>
            <h6><?= $this->session->flashdata('error');?></h6>
            <div class="form-group">
                <input type="text" name="email" class="form-control"
                       placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control"
                       placeholder="Password">
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                               class="form-control btn-primary" value="Log In">
                    </div>
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <div class="row">-->
<!--                    <div class="col-lg-12">-->
<!--                        <div class="text-center">-->
<!--                            <a href="http://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot-->
<!--                                Password?</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </form>
    </div>
</div>