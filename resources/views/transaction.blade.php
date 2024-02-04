<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <title>Transaction</title>
</head>

<body >
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Admin Panel</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style='display: flex; flex-flow: column; gap: 25px;'>
            <button class='btn btn-primary' style='width: 100%; font-family: "Poppins";' onclick='(window.location.href = "product")'>Add Product</button>
            <button class='btn btn-primary' style='width: 100%; font-family: "Poppins";' onclick='(window.location.href = "table")'>Transaction Data</button>
            <form action="logoutAuth" method='post'>
                @csrf
                <button class='btn btn-danger' style='width: 100%; font-family: "Poppins";'>Logout</button>
            </form>
        </div>
    </div>

    <div class='center-par-partial' >
    <button class="btn btn-primary fixed-panel" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
    aria-controls="offcanvasWithBothOptions">></button>

        <div class='option-par'>
            <div class='head-option'>Kelas</div>
            <select class="js-example-basic-single selecto"  name="state"  id="classroom-selection">
                @foreach($classes as $cla)
                <option value="{{$cla['classId']}}">{{$cla['className']}}</option>
                @endforeach
            </select>
        </div>

        <div class='option-par'>
            <div class='head-option'>Siswa</div>
            <select class="js-example-basic-single selecto" name="state" id='student-selection'>
                @foreach($students as $stu)
                <option value="{{$stu->id}}">{{$stu->nama_siswa}}</option>
                @endforeach
            </select>
        </div>

        <div class='option-par'>
            <div class='head-option'>Menu</div>
            <button class='add-menu'>Add Menu</button>
            <div class='menu-col'>

                <div class='menu-row'>
                    <select class="js-example-basic-single selecto productClass product-static" name="state">
                        @foreach($products as $pro)
                        <option value="{{$pro->id}}" class='datas'>{{$pro->product_name}}</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantity" id="" value='1' class='quant' min='1'>
                    <button class='minus-button' style='display: none;'>-</button>
                </div>

            </div>
        </div>

        <div class='option-par' style='display:flex; align-items: center; justify-content: center; border: none !important;'>
            <input type="submit" value="Bayar" class='pay' onclick='(window.location.href = "qr")' style='width: 50%; height: 40px; cursor: pointer; background-color: rgb(95, 95, 255);color: white;border-radius: 20px;border: none;font-family: "Poppins"; font-size: 20px;'>
        </div>
    </div>

    <script>
        var add_menu = document.querySelector('.add-menu')
        var menu_col = document.querySelector('.menu-col')
        var menu_row = document.querySelector('.menu-row')
        var datas = document.querySelectorAll('.datas')

        add_menu.addEventListener('click', addMenu)
            window.addEventListener('resize', function() {
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            })
        });


        function addMenu(params) {
            if (document.querySelector('.productClass').childElementCount !== 1) {
                
            var select = document.createElement('select')
            var option = document.createElement('option')
            var qty = document.createElement('input')
            var minus = document.createElement('button')
            var menu_row = document.createElement('div')

            menu_row.classList.add('menu-row')
            select.classList.add('js-example-basic-single')
            select.classList.add('selecto')
            select.classList.add('product-static')
            minus.classList.add('minus-button')
            qty.classList.add('quant')

            // datas.forEach(element => {
            //     clone = element.cloneNode(true)
            //     select.appendChild(clone)
            // });

            qty.value = 1

            var buttonText = document.createTextNode('-')
            minus.appendChild(buttonText)

            select.setAttribute('name', 'state')
            qty.setAttribute('type', 'number')
            qty.setAttribute('name', 'qty')

            menu_row.appendChild(select)
            menu_row.appendChild(qty)
            menu_row.appendChild(minus)

            menu_col.appendChild(menu_row)

                        
                $(document).ready(function () {
                    $('.js-example-basic-single').select2();

                    $('.quant').on('input', function (e) {
                console.log($(this).val());
                if($(this).val() < 1){

                    var inputValue = $(this).val();
                    inputValue = inputValue.replace('-', '');
                    $(this).val(inputValue);

                    if ($(this).val().trim() == '' ) {
                        return
                    }
                    $(this).val(1)         
                }
            })

            $('.quant').on('change', function (e) {
                if($(this).val() < 1){
                    
                    var inputValue = $(this).val();
                    inputValue = inputValue.replace('-', '');
                    $(this).val(inputValue);

                    if ($(this).val().trim() == '' ) {
                        return
                    }
                    $(this).val(1)       
                }
            })
                

                    $('.minus-button').on('click', function (e) {
                        if($(this).prev().prev().prev().attr('disabled') == null){
                            $(this).parent().prev().children('.selecto').prop('disabled', false)
                            $(this).parent().remove()

                            var selecto = $('.selecto').last();
                            selecto.addClass('productClass')

                            var div_class = $(".array-div")
                            var prod_stat = $(".product-static")

                            if(prod_stat.length == 1){
                                div_class.each(function (index, element) {
                                    element.remove()
                                })

                                $('.minus-button').each(function(index, element) {
                                    $(this).css('display', 'none')
                                })
                            }

                            var checkAdd = $('.check-cond').text()

                            if(checkAdd == 'false'){
                                $('.check-cond').empty()
                                $('.check-cond').append('true')
                            }

                        }else{
                            var div_class = $(".array-div")
                            var textTarget = $(this).prev().prev().children(':eq(0)').children(':eq(0)').children(':eq(0)').text()

                            div_class.each(function (index, element){
                                
                                if(element.textContent == textTarget){
                                    var htmlContent = "<option value=\'"+element.textContent+"\'>"+element.textContent+"</option>"
                                    $('.product-static').each(function(index, element) {
                                        $(this).append(htmlContent)
                                    })
                                    element.remove()
                                }
                            });

                            $(this).parent().remove()

                            var prod_stat = $(".product-static")
                            if(prod_stat.length == 1){
                                $('.minus-button').each(function(index, element) {
                                    $(this).css('display', 'none')
                                })
                            }

                            var checkAdd = $('.check-cond').text()

                            if(checkAdd == 'false'){
                                $('.check-cond').empty()
                                $('.check-cond').append('true')
                            }
                        }

                    });
                });
            }

        }

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();

            var prod_stat = $(".product-static")
            $('.minus-button').css('display', 'none')

            $('.pay').on('click', function (e) {
                var subArrayForJson = []
                var counterReverse = $('.product-static').length - 1
                var counter = $('.quant').length - 1

                $('.product-static').each(function (index, element) {
                    var subJson = {}

                  subJson.product_id = $('.productClass').select2('data')[0]['id'];
                  subJson.product_qty = $('.quant').eq(counter).val()
                  counter--
                  subArrayForJson.push(subJson)

                  console.log(subJson);

                  $('.product-static').eq(counterReverse).removeClass('productClass')
                  counterReverse--

                  $('.product-static').eq(counterReverse).addClass('productClass')

                  return
                })

                var student = $('#student-selection').select2('data')[0]['id'];
                var classroom = $('#classroom-selection').select2('data')[0]['id'];
                
                $.ajax({
                    type: 'POST',
                    url : "/payment",
                    data:{
                        "_token" : '{{csrf_token()}}',
                        "class" : classroom,
                        "student" : student,
                        "orders" : subArrayForJson
                    },
                });

            })

            // $('#student-selection').on('change', function (e) {
            //     // Get the selected data
            //     var selectedData = $('#student-selection').select2('data');
            //     var selectedId = selectedData[0]['id']

            //     $.ajax({
            //         type:'POST',
            //         url:'/students',
            //         data:{'_token' : '{{ csrf_token() }}',
            //               'idStudent' : selectedId
            //             },
            //         success:function(data) {

            //             var datasStudent = data.datas;

            //             $('#classroom-selection').empty();

            //             $.each(datasStudent,function (index, element){ 
            //                 var htmlContent = "<option value=\'"+element['classId']+"\'>"+element['className']+"</option>"
            //                 $('#classroom-selection').append(htmlContent);
            //             });
            //         }
            //     });

            //     // Log a message with the selected data
            // });

            $('#classroom-selection').on('change', function (e) {
                var selectedData = $('#classroom-selection').select2('data');
                var selectedId = selectedData[0]['id']

                $.ajax({
                    type:'POST',
                    url:'/transactions',
                    data:{'_token' : '{{ csrf_token() }}',
                          'idClassroom' : selectedId
                        },
                    success:function(data) {

                        var datasStudent = data.datas;

                        $('#student-selection').empty();

                        $.each(datasStudent,function (index, element){ 
                            var htmlContent = "<option value=\'"+element['id']+"\'>"+element['nama_siswa']+"</option>"
                            $('#student-selection').append(htmlContent);
                        });
                    }
                });

            });


            var arrDiv = $('<div>')
            arrDiv.attr('class', 'check-cond');
            arrDiv.attr('style', 'width:0px; height: 0px; font-size: 0px; position: absolute;');
            arrDiv.text('true');
            $('body').append(arrDiv)


            $('.add-menu').on('click', function (e) {
                // Get the selected data
                var checkAdd = $('.check-cond').text()
                
                $('.minus-button').each(function (index, element) {
                    $(this).css('display', 'block')                    
                })

                if (checkAdd == "true") {

                    var firstMenu = $('.productClass');
                    var selecto = $('.selecto').last();

                    var selectedDataProduct = firstMenu.select2('data');
                    var selectedProduct = selectedDataProduct[0]['text']
                    
                    
                    var arrDiv = $('<div>')
                    arrDiv.attr('class', 'array-div');
                    arrDiv.attr('style', 'width:0px; height: 0px; font-size: 0px; position: absolute;');
                    arrDiv.text(selectedProduct);
                    $('body').append(arrDiv)

                    var arr = []
                    var div_class = $(".array-div")

                    $.each(div_class ,function (index, element){
                        arr.push(element.textContent)
                    })

                    firstMenu.prop('disabled', true)
                    firstMenu.removeClass('productClass')
                    selecto.addClass('productClass')

                    $.ajax({
                        type:'POST',
                        url:'/menus',
                        data:{'_token' : '{{ csrf_token() }}',
                            'product_limit' : arr
                            },
                        success:function(data) {

                            if (data.datas.length !== 0) {
                                
                                console.log(data.datas);
                                var datasProducts = data.datas;

                                $('.productClass').last().empty();
                                
                                $.each(datasProducts,function (index, element){
                                    var htmlContent = "<option value=\'"+element['id']+"\'>"+element['product_name']+"</option>"
                                    $('.productClass').last().append(htmlContent);
                                });
                            }
                        }
                    });

                    if ($('.product-static').length == @json($products).length) {
                        $('.check-cond').empty()
                        $('.check-cond').append('false')
                    }
                }
                


            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>