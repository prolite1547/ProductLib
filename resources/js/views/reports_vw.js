import {elements} from "./base";

export const ReportViewController = () => {

    elements.brandSelect2.select2({
        multiple: true,
        placeholder: 'fetching data...'
    });

    elements.dimensionSelect2.select2({
        multiple: true,
        placeholder: 'fetching data...'
    });

    elements.printDetailsSelect2.select2({
        multiple: true
    })


    $.ajax('/ProdLib/public/api-brands', {
        type: "GET",  
    }).done(data =>{
        elements.brandSelect2.select2({
            placeholder : ""
        }).trigger('change')
        for(const response of data){
            elements.brandSelect2.append(new Option(response.brand, response.brand)).trigger('change');
        }
    });


    $.ajax('/ProdLib/public/api-dimension', {
        type: "GET",  
    }).done(data =>{
        elements.dimensionSelect2.select2({
            placeholder : ""
        }).trigger('change')
        for(const response of data){
            elements.dimensionSelect2.append(new Option(response.dimension, response.dimension)).trigger('change');
        }
    });

    elements.printDetailsSelect2.on('change', (e)=>{
        let details = $(e.target).val();
         
        // for(var i = 0; i<details.length; i++){
        //     var d = details[i];
        //     if(d == "All"){
        //         $(e.target).val(["All"]).trigger('change');
                 
        //     }
        // }
    });

    // var branches = $(".bBranches").val();
    //          for(var i=0; i<branches.length; i++){
    //              var b = branches[i];
    //              if(b == "all"){
    //                 $('.bBranches').val(["all"]).trigger('chosen:updated');
    //                 break;
    //              }
    //          }

}