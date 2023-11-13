<script>
    /*$(document).ready(function(){
            alert('estoy funcionando correctamanete empresa');
        });*/
    $("#save").hide();

    let cont = 0;
    let total = 0;
    let priceindex = [];

    $(document).ready(function(){
        $("#add").click(function(){

            add();
        });
    });

    //adicionar productos a la compra
    function add(){
        number = $("#number").val();
        price = parseInt($("#value").val());
        type = $("#type").val();
        let numberProhibited = '';
        prohobiteds = {!! json_encode($prohibitedNumbers) !!};
        prohobiteds.forEach((value, i) => {
            if (value == number) {
                numberProhibited = value;
            }
        });

        if (numberProhibited == '') {
            if(number !="" && price!=""){
                priceindex[cont] = price;
                total = parseFloat(total) + parseFloat(price);
                var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="type[]" value="'+type+'">'+type+'</td><td><input type="hidden" name="number[]" value="'+number+'">'+number+'</td> <td class="rightfoot"><input type="hidden" name="value[]"  value="'+parseFloat(price)+'">'+new Intl.NumberFormat("es-CO").format(price)+'</td></tr>';
                cont++;
                totals();
                assess();
                $('#plays').append(row);
                clean();


            }else{
                //alert("Rellene todos los campos del detalle para esta compra");
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle para esta compra',
                })
            }
        }else{
            //alert("Rellene todos los campos del detalle para esta compra");
            Swal.fire({
            type: 'error',
            //title: 'Oops...',
            text: 'numero' + ' ' +  numberProhibited + ' ' + 'esta betado',
            })
        }
    }

    function clean(){
        $("#number").val("");
        $("#value").val("");
    }
    function totals(){
        $("#total_html").html("$ " + new Intl.NumberFormat("es-CO").format(total));
        $("#total").val(total);
        $("#actual_payment").val((total/110) *100);
        $("#pay").val((total/110) *100);
    }
    function assess(){

        if(total>0){

        $("#save").show();
        } else{
            $("#save").hide();
        }
    }
    function deleterow(index){
        total = total - priceindex[index];

        $("#total_html").html("$ " + total.toFixed(2));
        $("#total").val(total.toFixed(2));

        $("#row" + index).remove();
        assess();
    }

    function editrow(index) {

        $("#contMod").hide();

        // Obtener la row
        var row = $("#row" + index);
        // Solo si la row existe
        if(row) {

            // Buscar datos en la row y asignar a campos del formulario:
            // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
            $("#contModal").val(index);
            $("#numberModal").val(row.find("td:eq(3)").text());
            $("#valueModal").val(row.find("td:eq(4)").text());

            // Mostrar modal
            $('#editModal').modal('show');
        }
    }

    jQuery(document).on("click", "#updatePlay", function () {
    updaterow();
    });

    function updaterow() {
        // Buscar datos en la row y asignar a campos del formulario:
        // Primera columna (0) tiene ID, segunda (1) tiene nombre, tercera (2) capacidad
        contedit = $("#contModal").val();
        number = $("#numberModal").val();
        price = $("#valueModal").val();

        if(number !="" && price!=""){
            priceindex[cont] = price;
            total = parseInt(total) + parseInt(price);

            var row= '<tr class="selected" id="row'+cont+'"><td><button type="button" class="btn btn-danger btn-sm btndelete" onclick="deleterow('+cont+');"><i class="fas fa-trash"></i></button></td><td><button type="button" class="btn btn-warning btn-sm btnedit" onclick="editrow('+cont+');"><i class="far fa-edit"></i></button></td><td><input type="hidden" name="type[]" value="'+type+'">'+type+'</td><td><input type="hidden" name="number[]" value="'+number+'">'+number+'</td> <td class="rightfoot"><input type="hidden" name="value[]"  value="'+parseInt(price)+'">'+price+'</td></tr>';
            cont++;

            deleterow(contedit);
            totals();
            assess();
            $('#plays').append(row);
            $('#editModal').modal('hide');

            //$('#product_id option:selected').remove();
        }else{
            // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
            Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la compra',
            })
        }
    }
</script>
