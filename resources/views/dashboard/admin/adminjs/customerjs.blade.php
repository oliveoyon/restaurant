<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#add-customer-form').on('submit', function(e){
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
                                     

                                    $('#customer-table').DataTable().ajax.reload(null, false);
                                      $('#addcustomers').modal('hide');
                                      $('#addcustomers').find('form')[0].reset();
                                      toastr.success(data.msg);

                                      
                                 }
                            }
                        });
                    });
    
                  //GET ALL Districts
                   var table =  $('#customer-table').DataTable({
                         processing:true,
                         info:true,
                         ajax:"{{ route('admin.getCustomersList') }}",
                         "pageLength":5,
                         "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                         columns:[
                            //  {data:'id', name:'id'},
                             {data:'DT_RowIndex', name:'DT_RowIndex'},
                             {data:'customer_name', name:'customer_name'},
                             {data:'customer_address', name:'customer_address'},
                             {data:'customer_phone', name:'customer_phone'},
                             {data:'customer_email', name:'customer_email'},
                             {data:'status', name:'status', orderable:false, searchable:false},
                             {data:'actions', name:'actions', orderable:false, searchable:false},
                         ]
                    });    
    
                    $(document).on('click','#editCustomerBtn', function(){
                        var customer_id = $(this).data('id');
                        $('.editCustomer').find('form')[0].reset();
                        $('.editCustomer').find('span.error-text').text('');
                        $.post("{{ route('admin.getCustomerDetails') }}",{customer_id:customer_id}, function(data){
                            // alert(data.details.suupplier_name);
                            $('.editCustomer').find('input[name="sid"]').val(data.details.id);
                            $('.editCustomer').find('input[name="customer_name"]').val(data.details.customer_name);
                            $('.editCustomer').find('input[name="customer_address"]').val(data.details.customer_address);
                            $('.editCustomer').find('input[name="customer_phone"]').val(data.details.customer_phone);
                            $('.editCustomer').find('input[name="customer_email"]').val(data.details.customer_email);
                            $('.editCustomer').find('select[name="customer_status"]').val(data.details.customer_status);
                            $('.editCustomer').modal('show');
                        },'json');
                    });
    
                    //UPDATE Court DETAILS
                    $('#update-customer-form').on('submit', function(e){
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
                                      $('#customer-table').DataTable().ajax.reload(null, false);
                                      $('.editCustomer').modal('hide');
                                      $('.editCustomer').find('form')[0].reset();
                                      toastr.success(data.msg);
                                  }
                            }
                        });
                    });
    
    
                    //DELETE Version RECORD
                    $(document).on('click','#deleteCustomerBtn', function(){
                        var customer_id = $(this).data('id');
                        var url = '<?= route("admin.deleteCustomer"); ?>';
                        swal.fire({
                             title:'Are you sure?',
                             html:'You want to <b>delete</b> this Customer',
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
                                  $.post(url,{customer_id:customer_id}, function(data){
                                       if(data.code == 1){
                                           $('#customer-table').DataTable().ajax.reload(null, false);
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
    
    
    