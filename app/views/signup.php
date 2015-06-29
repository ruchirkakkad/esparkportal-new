    <div class="container w-xxl w-auto-xs" ng-controller="SignupFormController" ng-init="app.settings.container = false;">
      <a href class="navbar-brand block m-t"><img src="<?= ImgProxy::link("public/img/login-page-logo.png",150,150); ?>"></a>
      <div class="m-b-lg">
        <div class="wrapper text-center">
          <strong>Sign up to find interesting thing</strong>
        </div>
        <form name="form" class="form-validation">
          <div class="text-danger wrapper text-center" ng-show="authError">
                   <div flash-message="5000" ></div>

          </div>
          <div class="list-group list-group-sm">
            <div class="list-group-item">
              <input placeholder="First name" ng-pattern="/^(\D)+$/"  name="first_name" class="form-control no-border" ng-model="user.first_name" required>
            </div>
            <div class="list-group-item">
              <input placeholder="Middle name" ng-pattern="/^(\D)+$/"  name="middle_name" class="form-control no-border" ng-model="user.middle_name" required>
            </div>
            <div class="list-group-item">
              <input placeholder="Last name" ng-pattern="/^(\D)+$/"  name="last_name" class="form-control no-border" ng-model="user.last_name" required>
            </div>
            <div class="list-group-item">
              <input type="email" placeholder="Email" name="email" class="form-control no-border" ng-model="user.email" required>
            </div>
<!--            <div class="list-group-item">
              <input ng-pattern="/[0-9]{10}$/"  placeholder="(XXX) XXXX XXX" name="phone" class="form-control no-border" ng-model="user.phone" required>
            </div>-->

          </div>
<!--          <div class="checkbox m-b-md m-t-none">
            <label class="i-checks">
              <input type="checkbox" ng-model="agree" required><i></i> Agree the <a href>terms and policy</a>
            </label>
          </div>-->
          <button type="submit" class="btn btn-lg btn-primary btn-block" ng-click="signup()" ng-disabled='form.first_name.$invalid || form.email.$invalid || form.middle_name.$invalid || form.last_name.$invalid'>Sign up</button>
          <div class="line line-dashed"></div>
          <p class="text-center"><small>Already have an account?</small></p>
          <a ui-sref="access.signin" class="btn btn-lg btn-default btn-block">Sign in</a>
        </form>
      </div>
      <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
        {% include 'blocks/page_footer.html' %}
      </div>
    </div>