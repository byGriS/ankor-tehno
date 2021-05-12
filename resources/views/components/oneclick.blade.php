<div class="modal fade" id="oneClickModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title">ОФОРМЛЕНИЕ ЗАЯВКИ</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('oneClick')}}" method="POST">
        <div class="modal-body">

          @csrf
          <input type="hidden" name="product_id" id="product_id" value="0">
          <input type="hidden" name="product_count" id="product_count" value="0">
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Имя*" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email*" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Номер телефона">
          </div>
          <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Комментарии"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
      </form>
    </div>
  </div>
</div>

