<div class="modal fade editManufacturer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('language.edit_manufacturer') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
                 <form action="{{ route('admin.updateManufacturerDetails'); }}" method="post" id="update-manufacturer-form">
                    @csrf
                     <input type="hidden" name="uid">
                     <div class="form-group">
                      <label for="">{{ __('language.manufacturer_name') }}</label>
                      <input type="text" class="form-control" name="manufacturer_name" placeholder="Enter Manufacturer Name">
                      <span class="text-danger error-text manufacturer_name_error"></span>
                    </div>
                     
                     <div class="form-group">
                        <label for="">{{ __('language.status') }}</label>
                        <select name="manufacturer_status" id="" class="form-control">
                            <option value="1">{{ __('language.active') }}</option>
                            <option value="0">{{ __('language.inactive') }}</option>
                        </select>
                        <span class="text-danger error-text manufacturer_status_error"></span>
                    </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success">{{ __('language.update') }}</button>
                     </div>
                 </form>
                
  
            </div>
        </div>
    </div>
  </div>