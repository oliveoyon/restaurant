<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
          $('#add-manufacturer-forms').on('submit', function(e){
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
                                

                            // $('#manufacturer-table').DataTable().ajax.reload(null, false);
                                $("#manufacturer_selected").find('option').remove().end().append(data.manufactureritem);
                                $('#manufacturer').modal('hide');
                                $('#manufacturer').find('form')[0].reset();
                                toastr.success(data.msg);

                                
                            }
                    }
                });
            });


           // TAGS BOX
            $("#tags input").on({
                focusout() {
                var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
                if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
                this.value = "";
                $("#myInput").val(text);
                },
                keyup(ev) {
                if(/(,|Enter)/.test(ev.key)) $(this).focusout(); 
                }
            });
            $("#tags").on("click", "span", function() {
                $(this).remove(); 
            });
            
           
            // const tags = $("#tags span").get().map(el => el.textContent);
            // alert (tags);


            
    
      })
    </script>

