<div class="row">
    <div class="col-12 col-md-6 m-auto ">

<?= \Config\Services::validation()->listErrors(); ?>
    <?= form_open_multipart('/user/register') ?>
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">UserName</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="user_name">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@exchanger.com">
            </div>
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="first_name" placeholder="frist_name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="last_name" placeholder="last_name">
            </div>
            <div class="form-group">
                <label for="dob">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" placeholder="">
            </div>
            <div class="form-group">
                <label for="ageproof">Age Proof</label>
                <input type="file" class="form-control" name="age_doc" id="lastname">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            
        </form>
    </div>
</div>