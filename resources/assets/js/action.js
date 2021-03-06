(function ($) {
    "use strict";
    $("#NBENFANTS").prop('disabled', true);

    var typeDeContrat = ($('#contrat_id :selected').text());
    if (typeDeContrat.toLowerCase() == "cdi") {
      //
        $("#dateFinDuContrat").attr("value", "");
      //  $("#dateFinDuContrat").prop('disabled', true);
        $("#groupFindContrat").slideToggle(0);
    }
    $('#dateNaissance').datepicker({

        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $('#dateEntree').datepicker({

        format: 'dd/mm/yyyy',
        autoclose: true

    });

    $('#dateFinDuContrat').datepicker({
        format: 'dd/mm/yyyy',
        /* isRTL: true,
         format: 'yyyy-dd-mm',*/
        autoclose: true

    });
    $('#dateDebutConge').datepicker({
        format: 'dd/mm/yyyy',
        /* isRTL: true,
         format: 'yyyy-dd-mm',*/
        autoclose: true

    });
    $('#dateFinConge').datepicker({
        format: 'dd/mm/yyyy',
        /* isRTL: true,
         format: 'yyyy-dd-mm',*/
        autoclose: true

    });





    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('#CF').on('change', function () {

        if (this.value == 1)  $("#NBENFANTS").prop('disabled', false);
        else {
            $("#NBENFANTS").prop('disabled', true);
        }

    });

    $('#contrat_id').on('change', function () {
        typeDeContrat=(($('#contrat_id :selected').text()));
        if(typeDeContrat.toLowerCase() == "cdi"){

            $("#dateFinDuContrat").attr("value", "");
            $("#groupFindContrat").slideToggle(500);

           // $("#dateFinDuContrat").prop('disabled', true);

        }else{
            $("#groupFindContrat").slideToggle(500);
           // $("#dateFinDuContrat").prop('disabled', false);
        }
    });


   // $('#prime_id').select2() ({

    //});

    var x = 1; //initlal text box count
    var matches = 0;

    $( "#IDprime" )
        .change(function () {


            var montant_prime=[];
            var nom_prime = [];
            $( "#IDprime option:selected" ).each(function() {

                montant_prime.push($(this).val());
                nom_prime.push($(this).text());

            });
            $.each(montant_prime, function( index, value ) {

                if(value>1 && $("#input_montant_prime_"+value).length<1 ){

                    x++; //text box increment
                    $(".container-montant-prime").append('<div class="prime">' +
                        '<label class="label_montant_prime">'+nom_prime[index]+': </label>' +
                        '<input type="text" name="montant_prime[]" class="input_montant_prime" id="input_montant_prime_'+value+'"/>'
                        +
                        ' <input type="hidden" name="montant_prime_exoneree['+matches+']" value="-1" />'
                        +'<div class="checkbox-inline"> <input type="checkbox" name="montant_prime_exoneree['+matches+']" value="'+value+'">exonérée cnss </div>' +
                        '<input type="hidden" name="prime_id[]" value="'+value+'" />'
                        +'<a href="#" class="remove_field_montant_prime"">Supprimer</a></div>');
                    ++matches;


                }else if(value==1){
                    $(".prime").remove();
                }

            })
            //Join the elements of an array into a string:
          // alert("" + countries.join(""));
        })
        .change();


    $(".container-montant-prime").on("click",".remove_field_montant_prime", function(e){ //user click on remove text
            e.preventDefault();--matches; $(this).parent('div').remove(); --x;
        })

    /******************************* Message Flash Laravel **********************/
    $('.alert').delay( 4000).slideUp(400);
    /**********************************************************************/

   /***************************Personnel mask input**************************/

      // alert( $.isFunction($("#post").mask));

     $("#dateNaissance").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
     $("#dateEntree").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
     $("#dateFinDuContrat").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    $("#cnss").mask("99999999-00",{placeholder:""});
    $("#cin").mask("99999999",{placeholder:""});

    /******************************************************************/

    /************************Mask Congee*********************************/
    $("#dateDebutConge").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    $("#dateFinConge").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
    /******************************************************************/


    })(jQuery);
