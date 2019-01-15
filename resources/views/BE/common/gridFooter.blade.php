<div style="margin-top: 20px;border-top: solid 1px #d2d2d2;padding-top: 10px">
    @php
        if(empty($grid['limit'])){
            $grid['limit'] = 5;
        }
        if(empty($grid['page'])){
            $grid['page'] = 1;
        }
    @endphp

    <div class="row DTTTFooter" style="max-height: 36px;">
        <div class="col-sm-6">
            <div style="margin-top: 8px;">Đang xem từ <?= (1 + $grid['limit'] * ($grid['page'] - 1)) ?>
                đến <?= (count($docs) + $grid['limit'] * ($grid['page'] - 1)) ?> của tổng số <?= $total ?> bản ghi.
            </div>
        </div>
        <div class="col-sm-6 text-right">
            @php
                echo getPaging($total, $grid['limit']);
            @endphp
        </div>
    </div>
</div>
