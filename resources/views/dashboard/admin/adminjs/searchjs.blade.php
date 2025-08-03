<script>
    toastr.options.preventDuplicates = true;
      $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
          }
      });
    
      $(function(){
          //ADD NEW District
          
        $(document).on('keyup', function(e){
            e.preventDefault();
            let search_string = $('#search').val();
            // console.log(search_string);
            $.ajax({
                url:"{{ route('admin.searchResult') }}",
                method:'POST',
                data:{search_string:search_string},
                success:function(res){
                    $('.table-responsive').html(res);
                }
            })
        })
    
      })
    </script>
    
    
    