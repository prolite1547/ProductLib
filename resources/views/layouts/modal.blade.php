
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditTitle">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['method' => 'POST','route' => 'updateproduct.update','id' => 'form-updateProduct']) !!}
        @auth
            {!! Form::hidden('product_id', null, ['id'=>'product_id']) !!}
            {!! Form::hidden('updated_by', Auth::user()->id , ['id'=>'updated_by']) !!}
        @endauth

          <div class="container">
            <div class="row mb-2">
                <div class="col-md-12 text-center">
                    <div class="form-group">
                      <img height="312px" width="312px" src="../images/no-image.png" title="Click image to upload" alt="No image Preview" id="img_modal" data-img_def="{{ asset('images/no-image.svg') }}" class="img-fluid">
                      <input type="file" name="image_choice" id="modal_image_choice" style="visibility: hidden;" accept="image/png, image/jpeg" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="features_modal">Features</label>
                      <textarea name="feature" class="form-control input__text-area" id="features_modal" cols="15" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="benefits_modal">Benefits</label>
                     <textarea name="benefits" class="form-control input__text-area" id="benefits_modal" cols="15" rows="3"></textarea>
                  </div>
              </div>
          </div>
 
          </div>
        
        {!! Form::close() !!}
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="modalClose" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modalSaveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>
 


 
