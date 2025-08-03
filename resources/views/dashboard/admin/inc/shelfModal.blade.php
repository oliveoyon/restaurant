<div class="modal fade editShelf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('language.edit_shelf') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
                 <form action="{{ route('admin.updateShelfDetails'); }}" method="post" id="update-shelf-form">
                    @csrf
                     <input type="hidden" name="sid">
                     <div class="form-group">
                      <label for="">{{ __('language.shelf_name') }}</label>
                      <input type="text" class="form-control" name="shelf_name" placeholder="Enter Shelf Name">
                      <span class="text-danger error-text shelf_name_error"></span>
                    </div>
                     
                     <div class="form-group">
                        <label for="">{{ __('language.status') }}</label>
                        <select name="shelf_status" id="" class="form-control">
                            <option value="1">{{ __('language.active') }}</option>
                            <option value="0">{{ __('language.inactive') }}</option>
                        </select>
                        <span class="text-danger error-text unit_status_error"></span>
                    </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">{{ __('language.update') }}</button>
                     </div>
                 </form>
                
  
            </div>
        </div>
    </div>
  </div>