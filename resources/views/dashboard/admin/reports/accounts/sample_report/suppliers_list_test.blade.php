
<div class="content">
    <div class="card">
  <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">

        <br>
        <table style="width: 100%">
            <tr style="text-align: center">
                <td><p style="font-size: 25px; font-weight: bold; text-decoration:underline">{{ $settings->company_title }}</p></td>
            </tr>
            <tr style="text-align: center">
                <td><p style="font-weight: bold;">{{ $settings->company_address }}</p></td>
            </tr>
            <tr style="text-align: center">
                <td><p style="font-weight: bold;">Suppliers List</p></td>
            </tr>
        </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Supplier Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Total</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <!-- ITEMS HERE -->
                   
                   
                    @forelse ($suppliers as $sup)
                    <tr> 
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sup->supplier_name }}</td>
                        <td>{{ $sup->supplier_address }}</td>
                        <td>{{ $sup->supplier_phone }}</td>
                        <td>{{ $sup->supplier_email }}</td>
                        
                    </tr>
                    
                    @empty
                        
                    @endforelse
                    
                    
                    
                </tbody>
            </table>
            <br>

    </div>
</div>   
        
  
  </div>
</div>
</div>