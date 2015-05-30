
<section class="content">

    <div class="error-page">
        <h2 class="headline text-blue"><?php echo $statusCode ; ?></h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-blue"></i> <?php echo $message ; ?></h3>
            <p>
                <?php echo Yii::t('main','Мы не смогли найти страницу, которую вы ищете.')?>
            </p>
        </div>
    </div><!-- /.error-page -->
</section>

<style>
    h1{
        margin: 0;
        font-size: 24px;
        margin-top: -15px;
    }
</style>