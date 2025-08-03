<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#add-supplier-form').on('submit', function(e){
                        e.preventDefault();
                        var form = this;
                        $.ajax({
                            url:$(form).attr('action'),
                            method:$(form).attr('method'),
                            data:new FormData(form),
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            beforeSend:function(){
                                 $(form).find('span.error-text').text('');
                            },
                            success:function(data){
                                 if(data.code == 0){
                                       $.each(data.error, function(prefix, val){
                                           $(form).find('span.'+prefix+'_error').text(val[0]);
                                       });
                                 }else{
                                     

                                    $('#supplier-table').DataTable().ajax.reload(null, false);
                                      $('#addsuppliers').modal('hide');
                                      $('#addsuppliers').find('form')[0].reset();
                                      toastr.success(data.msg);

                                      
                                 }
                            }
                        });
                    });
    
                  //GET ALL Districts
                   var table =  $('#supplier-table').DataTable({
                         processing:true,
                         info:true,
                         ajax:"{{ route('admin.getSuppliersList') }}",
                         "pageLength":5,
                         "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                         columns:[
                            //  {data:'id', name:'id'},
                             {data:'DT_RowIndex', name:'DT_RowIndex'},
                             {data:'supplier_name', name:'supplier_name'},
                             {data:'supplier_address', name:'supplier_address'},
                             {data:'supplier_phone', name:'supplier_phone'},
                             {data:'supplier_email', name:'supplier_email'},
                             {data:'status', name:'status', orderable:false, searchable:false},
                             {data:'actions', name:'actions', orderable:false, searchable:false},
                         ]
                    });    
    
                    $(document).on('click','#editSupplierBtn', function(){
                        var supplier_id = $(this).data('id');
                        $('.editSupplier').find('form')[0].reset();
                        $('.editSupplier').find('span.error-text').text('');
                        $.post("{{ route('admin.getSupplierDetails') }}",{supplier_id:supplier_id}, function(data){
                            // alert(data.details.suupplier_name);
                            $('.editSupplier').find('input[name="sid"]').val(data.details.id);
                            $('.editSupplier').find('input[name="supplier_name"]').val(data.details.supplier_name);
                            $('.editSupplier').find('input[name="supplier_address"]').val(data.details.supplier_address);
                            $('.editSupplier').find('input[name="supplier_phone"]').val(data.details.supplier_phone);
                            $('.editSupplier').find('input[name="supplier_email"]').val(data.details.supplier_email);
                            $('.editSupplier').find('select[name="supplier_status"]').val(data.details.supplier_status);
                            $('.editSupplier').modal('show');
                        },'json');
                    });
    
                    //UPDATE Court DETAILS
                    $('#update-supplier-form').on('submit', function(e){
                        e.preventDefault();
                        var form = this;
                        $.ajax({
                            url:$(form).attr('action'),
                            method:$(form).attr('method'),
                            data:new FormData(form),
                            processData:false,
                            dataType:'json',
                            contentType:false,
                            beforeSend: function(){
                                 $(form).find('span.error-text').text('');
                            },
                            success: function(data){
                                  if(data.code == 0){
                                      $.each(data.error, function(prefix, val){
                                          $(form).find('span.'+prefix+'_error').text(val[0]);
                                      });
                                  }else{
                                      $('#supplier-table').DataTable().ajax.reload(null, false);
                                      $('.editSupplier').modal('hide');
                                      $('.editSupplier').find('form')[0].reset();
                                      toastr.success(data.msg);
                                  }
                            }
                        });
                    });
    
    
                    //DELETE Version RECORD
                    $(document).on('click','#deleteSupplierBtn', function(){
                        var supplier_id = $(this).data('id');
                        var url = '<?= route("admin.deleteSupplier"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Supplier',
                             showCancelButton:true,
                             showCloseButton:true,
                             cancelButtonText:'Cancel',
                             confirmButtonText:'Yes, Delete',
                             cancelButtonColor:'#d33',
                             confirmButtonColor:'#556ee6',
                             width:300,
                             allowOutsideClick:false
                        }).then(function(result){
                              if(result.value){
                                  $.post(url,{supplier_id:supplier_id}, function(data){
                                       if(data.code == 1){
                                           $('#supplier-table').DataTable().ajax.reload(null, false);
                                           toastr.success(data.msg);
                                       }else{
                                           toastr.error(data.msg);
                                       }
                                  },'json');
                              }
                        });
                    });
    
                    
    
                    
    
      })
    </script>
    
    
    