<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body style='background-color: #0e0e0e;'>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Admin Panel</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style='display: flex; flex-flow: column; gap: 25px;'>
            <button class='btn btn-primary' style='width: 100%; font-family: "Poppins";' onclick='(window.location.href = "product")'>Add Product</button>
            <button class='btn btn-primary' style='width: 100%; font-family: "Poppins";' onclick='(window.location.href = "transaction")'>Add Transaction</button>
            <form action="logoutAuth" method='post'>
                @csrf
                <button class='btn btn-danger' style='width: 100%; font-family: "Poppins";'>Logout</button>
            </form>
        </div>
    </div>

    <button class="btn btn-primary fixed-panel" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
    aria-controls="offcanvasWithBothOptions">></button>

    <div style='margin: 30px;box-sizing: border-box;' class='par-tab'> 
    <table align=center cellpadding=5 class='table table-dark table-striped table-data'>
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Class</th>
            <th>Date</th>
            <th>Detail</th>
        </tr>
        @php $i = 0; @endphp
        @foreach($datas as $data)
        @php $i++; @endphp
        <tr>
            <td>{{$i}}</td>
            <td>{{$data['student']}}</td>
            <td>{{$data['classroom']}}</td>
            <td>{{$data['date']}}</td>
            <td><button class='detail btn btn-primary'>Detail</button>
            <input type="text" name="" id="id_transaction" value='{{$data["transaction_id"]}}' hidden></td>
        </tr>
        @endforeach

    </table>
    <div class='grand-profits'>
    <div class='dirty-profit-grand'>Grand Dirty Profit : Rp{{$dirtyTotalFormat}}</div>
    <div class='clean-profit-grand'>Grand Clean Profit : Rp{{$cleanTotalFormat}}</div>
    </div>

    </div>


    <div id='detail-content' style='display:none;'>
        <i class="ri ri-close-line close-table" style='color: white; position: absolute; top: 0; right: 0; margin: 10px; font-weight: 700; font-size: 18px; cursor: pointer;'></i>
        <table cellpadding='10' id='table-detail' border=2 style='background-color: #0e0e0e; color: white; width: 100%;'>

        </table>
        <div class='grand-profits'>
        <div class='dirty-profit'></div>
        <div class='clean-profit'></div>
        </div>
        
    </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
     $('.close-table').on('click', function name(params) {
        $('#detail-content').css('display', 'none')
     })

    $('.detail').on('click', function (params) {
        $.ajax({
            type:'POST',
            url:'/detail',
            data:{'_token' : '{{ csrf_token() }}',
                  'id_transaction' : $(this).next().val()
                },
            success : function(data) { 
                console.log(data.datas);
                var responseData = data.datas;
                var counter = 0

                $('#table-detail').empty()

                var htmlHead =
                    "<tr>"+
                    "<th>Number</th>"+
                    "<th>Product Name</th>"+
                    "<th>Product Capital Price</th>"+
                    "<th>Product Sell Price</th>"+
                    "<th>Quantity</th>"+
                    "<th>Product Sub Total</th>"+
                    "</tr>"

                    $('#table-detail').append(htmlHead)

                dirtyTotals = 0
                cleanTotals = 0

                $.each(responseData ,function (index ,element) {
                    counter++

                    var htmlContent =
                    "<tr>"+
                    "<td>"+counter+"</td>"+
                    "<td>"+element['prod_name']+"</td>"+
                    "<td>"+"Rp"+element['prod_first'].toLocaleString('id-ID')+"</td>"+
                    "<td>"+"Rp"+element['prod_sell'].toLocaleString('id-ID')+"</td>"+
                    "<td>"+element['prod_qty']+"</td>"+
                    "<td class='sub-dirty-total'>"+"Rp"+(element['prod_qty']*element['prod_sell']).toLocaleString('id-ID')+"</td>"+
                    "</tr>"

                    $('#table-detail').append(htmlContent)

                    var capital = element['prod_first']
                    var sell = element['prod_sell']

                    var clean_profit = (sell - capital) * element['prod_qty']

                    cleanTotals = cleanTotals + clean_profit
                    dirtyTotals = dirtyTotals + (element['prod_qty']*element['prod_sell'])
                } )


                $('.dirty-profit').empty()
                $('.dirty-profit').append("Untung Kotor Total : Rp"+dirtyTotals.toLocaleString('id-ID'))
                $('.clean-profit').empty()
                $('.clean-profit').append("Untung Bersih Total : Rp" +cleanTotals.toLocaleString('id-ID'))

                $('#detail-content').css('display', 'block')
            }
        })
    })
        
    </script>
</body>

</html>