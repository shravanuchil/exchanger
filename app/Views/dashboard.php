<div class="row">
    <?php foreach($favourites as $favourite) : ?>
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <?= $favourite['first_currency']['code'] ?>
            </div>
            <div class="col-md-4">
                <?= $favourite['second_currency']['code'] ?>
            </div>
            <div class="col-md-4">
                <?=  $favourite['second_currency']['rate'] / $favourite['first_currency']['rate'] ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<pre>
