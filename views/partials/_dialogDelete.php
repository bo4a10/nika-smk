<div class="modal modal-danger fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog" style="width: 350px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-book"></i> <?= $this->title ?> </h4>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12" style="text-align: center;">
                                <p><?php echo Yii::t('main', 'Вы уверены что хотите удалить данный элемент?') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    <?php echo Yii::t('main', 'Отмена')?></button>
                <button id="btn-modal-delete" type="button" class="btn btn-primary"><i class="fa fa-check"></i>
                    <?php echo Yii::t('main', 'Удалить')?></button>
            </div>
        </div>
    </div>
</div>