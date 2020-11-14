<div class="row">
    <div class="col-12 col-md-6 m-auto ">

<?= \Config\Services::validation()->listErrors(); ?>
    <?= form_open('/user/login') ?>
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">UserName</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="user_name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="firstname" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            
        </form>
    </div>
</div>