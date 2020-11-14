<?php if((isset($sccMsg)) || (isset($errMsg))): ?>
<div class="row">
    <div class="col-12 col-md-6 m-auto ">
    <?php  $classAlerts = (isset($sccMsg)) ? 'alert-success' : 'alert-danger'; ?>
    <div class="alert <?= $classAlerts ?>" role="alert">
            <?= (isset($sccMsg)) ? $sccMsg : $errMsg ?>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col-12 col-md-6 m-auto ">

    <?= form_open('/currency') ?>
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">Amount</label>
                <?= form_input('amount', $amount) ?>
            </div>
            <div class="form-group">
                <label for="username">Choose Currency</label>
                <?= form_dropdown('first_code', $codes, '',['id' => 'first_currency_code']) ?>
            </div>
            <div class="form-group">
                <label for="second_code">Choose Currency</label>
                <?= form_dropdown('second_code', $codes, '',['id' => 'second_currency_code'] ) ?>
            </div>
            <button type="submit" name='button' value='convert'  class="btn btn-primary">Convert</button>
            <button type="submit" name='button' value='favourite' id='make_favourite' class="btn btn-primary">Favourite</button>
            
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 m-auto ">

    <?php
        if(isset($first_rate))
            echo $amount .' '.$first_rate['code'].' = '.$second_rate['rate']/$first_rate['rate'] * $amount . ' '.$second_rate['code'];
    ?>
    </div>
</div>
