<div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Корзина</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Продолжить покупки</button>
                <a href="{{ route('checkout') }}" class="btn btn-success">Оформить заказ</a>
                <button onclick="clearCart()" type="button" class="btn btn-danger">Очистить корзину</button>
            </div>
        </div>
    </div>
</div>
