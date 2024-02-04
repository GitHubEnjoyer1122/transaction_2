<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

    <title>Add Produk</title>
</head>

<body>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Admin Panel</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style='display: flex; flex-flow: column; gap: 25px;'>
            <button class='btn btn-primary' style='width: 100%; font-family: "Poppins";'
                onclick='(window.location.href = "transaction")'>Add Transaction</button>
            <button class='btn btn-primary' style='width: 100%; font-family: "Poppins";'
                onclick='(window.location.href = "table")'>Transaction Data</button>
            <form action="logoutAuth" method='post'>
                @csrf
                <button class='btn btn-danger' style='width: 100%; font-family: "Poppins";'>Logout</button>
            </form>
        </div>
    </div>

    <div class='center-par'>
        <button class="btn btn-primary fixed-panel" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">></button>

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
        @endif

        <form action="productStore" method='post'>
            <h1>Add Product</h1>
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                <input type="text" name='product_name' class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Harga Modal</label>
                <input type="number" name='product_capital_price' class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Harga Jual</label>
                <input type="number" name='product_sell_price' class="form-control">
            </div>
            <br>
            <button type="submit" class="btn btn-primary" style='width: 100%;'>Add Product</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>