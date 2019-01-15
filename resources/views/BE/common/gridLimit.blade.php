<div class="row DTTTFooter" style="margin-top: 6px;">
    <div class="col-sm-6">
        <div style="margin-bottom: 5px;">
            <input type="hidden" name="page"
                   value="<?= (!empty($grid['limit']) && $grid['page'] > 0) ? $grid['page'] : 1 ?>"/>
            Hiện
            <select name="limit" class="btn btn-secondary"
                    onchange="$('#gridForm').trigger('submit');" style="padding: 0;">
                <option <?= (!empty($grid['limit']) && $grid['limit'] == 5) ? 'selected' : '' ?> value="5">5</option>
                <option <?= (!empty($grid['limit']) && $grid['limit'] == 10) ? 'selected' : '' ?> value="10">10</option>
                <option <?= (!empty($grid['limit']) && $grid['limit'] == 20) ? 'selected' : '' ?> value="20">20</option>
                <option <?= (!empty($grid['limit']) && $grid['limit'] == 50) ? 'selected' : '' ?> value="50">50</option>
                <option <?= (!empty($grid['limit']) && $grid['limit'] == 100) ? 'selected' : '' ?> value="100">100
                </option>
            </select> Bản ghi / 1 trang
        </div>
    </div>
</div>
