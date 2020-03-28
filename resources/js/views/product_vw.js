
import {elements} from "./base";

export const ProductViewController = () => {
   let table = elements.productsTable.DataTable({
        ajax: '/api-products',
        order: [[0, 'desc']],
        columns: [
            {"className": 'details-control',data: null},
            {data: 'barcode',name: 'barcode'},
            {data: 'legacy_barcode',name: 'legacy_barcode'},
            {data: 'description',name: 'description'},
            {data: 'supplier',name: 'supplier'},
            {data: 'brand',name: 'brand'},
            {data: 'division',name: 'division'},
            {data: 'status',name: 'status'},
            {data: 'barcode',name: 'barcode'},
            {data: 'path',name: 'path', visible: false},
        ],
        columnDefs: [
            { 
              orderable: true, 
              targets: [1,2,3,4,5,6,7]
            },
            {   
                targets: 0,  
                orderable: false,
                render: (data, type, row) => {
                    let path = "../../images/no-image.png";
                    if(row.path != null){
                        path = "../storage/product_images/"+row.path;
                    }
                    return `<a href="${path}" target="_about" data-barcode="${data.barcode}" data-department="${data.department}" data-category="${data.category}" class="preview" data-title="${row.description}" data-sub_categ="${data.sub_category}" data-dimension="${data.dimension}" data-finish_color="${data.finish_color}" data-material="${data.material}" data-code="${data.code}" data-feature="${data.feature}" data-ebs_date="${data.ebs_msi_updated_at}" data-ebs_by="${data.ebs_msi_updated_by}" data-benefits="${data.benefits}" data-date_created="${data.created_at}" data-created_by="${data.created_by}" data-updated_by="${data.updated_by}" data-updated_date="${data.updated_at}"><img src="${path}" width="64px" height="64px" alt="No image preview"></a>`;
                }

             },
            {   
                targets: 8,  
                orderable: false,
                render: (data, type, row) => {
                    let path = "../../images/no-image.png";
                    if(row.path != null){
                        path = "../storage/product_images/"+row.path;
                    }
                    return `<button class="btn btn-sm btn-danger" data-action="edit-product" data-toggle="modal" data-href="${path}" data-features="${row.feature}" data-id="${row.id}" data-benefits="${row.benefits}"  data-target="#modalEdit" >EDIT</button>`
                }

             }  
     ]
    });

    imagePreview();

    // function format ( d ) {
    //     let path = "../../images/no-image.png";
    //     if(d.path != null){
    //         path = d.path;
    //     }
    //     return `<td>
    //                 <div class="container">
    //                     <div class="row">
    //                             <div class="col-sm-3">
    //                                 <img src="../storage/product_images/${path}" width="100px" height="100px">
    //                             </div>
    //                     </div>
    //                 </div>
    //             </td>`;
    // }


    // $('#table_products tbody').on('click', 'td.details-control', (e)=>{
    //     var tr = $(e.target).closest('tr');
    //     var row = table.row( tr );
       
    //     if ( row.child.isShown() ) {
    //         // This row is already open - close it
    //         row.child.hide();
    //         tr.removeClass('shown');
    //         $(e.currentTarget).html('<img src="../images/more.png" style="border:none;">');
    //     }
    //     else {
    //         // Open this row
    //         row.child( format(row.data()) ).show();
    //         $(e.currentTarget).html('<img src="../images/less.png" style="border:none;">');
    //         tr.addClass('shown');
    //     }
    // });

   
   

     function  imagePreview(){
        
        var xOffset = 200;
        var yOffset = 30;
     

        $('#table_products tbody').on('mouseover','td.details-control>a.preview', (e)=>{
            
           
            var t = $(e.currentTarget).data('title');
            var barcode = $(e.currentTarget).data('barcode');
            var dep = $(e.currentTarget).data('department');
            var category = $(e.currentTarget).data('category');
            var sub_categ = $(e.currentTarget).data('sub_categ');
            var dimension  = $(e.currentTarget).data('dimension');  
            var finish_color = $(e.currentTarget).data('finish_color');  
            var material = $(e.currentTarget).data('material');  
            var code = $(e.currentTarget).data('code');  
            var feature  = '';
            if($(e.currentTarget).data('feature') != null){
               feature = convertLines($(e.currentTarget).data('feature')); 
            }
            var benefits = '';
            if($(e.currentTarget).data('benefits') != null){
                benefits = convertLines($(e.currentTarget).data('benefits')); 
             }
            var ebs_date = $(e.currentTarget).data('ebs_date');
            var ebs_by = $(e.currentTarget).data('ebs_by');

            var created_by = $(e.currentTarget).data('created_by');
            var date_created = $(e.currentTarget).data('date_created');

            var updated_by = $(e.currentTarget).data('updated_by');
            var updated_date = $(e.currentTarget).data('updated_date');



            var href = $(e.currentTarget).attr('href')
            var c = (t != "") ? "<br/>" + t : "";
            $("body").append(`<div id='preview' class="container-fluid">
                                 <h3>${t}</h3>
                                 <hr/>
                                <div class="row">
                                  
                                    <div class="col-md-3 text-center">
                                       <img  class="img-fluid"  alt='No image preview' src='${href}' alt='Image preview'/><br>
                                       <h3 class="mt-3 bg-dark text-light">${barcode}</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="hover-label">Department</label> : ${dep}<br>
                                        <label class="hover-label">Category</label> : ${category}<br>
                                        <label class="hover-label">Sub Category</label> : ${sub_categ}<br>
                                        <label class="hover-label">Dimension</label> : ${dimension}<br>
                                        <label class="hover-label">Finish/Color</label> : ${finish_color}<br>
                                        <label class="hover-label">Material</label> : ${material}<br>
                                        <label  class="hover-label">Code</label> : ${code}<br>
                                     </div>

                                     <div class="col-md-3">
                                            <label class="hover-label">Features :</label><br>
                                            <label>${feature}</label><br>
                                            <label class="hover-label">Benefits :</label><br>
                                            <label>${benefits}</label><br>
                                    </div>

                                     <div class="col-md-3">
                                        <label class="hover-label">Item created date</label> : <br> ${date_created.split(' ')[0]} <br>
                                        <label class="hover-label">Item created by</label> : <br> ${created_by.toUpperCase()} <br>
                                        <label class="hover-label">Item update date</label> : <br> ${updated_date.split(' ')[0]} <br>
                                        <label class="hover-label">Item updated by</label> : <br> ${updated_by.toUpperCase()}<br>
                                        
                                        <label class="hover-label">EBS update date</label> : <br> ${ebs_date} <br>
                                        <label class="hover-label">EBS updated by</label> : <br> ${ebs_by} <br>
                                     </div>
                                  
                                </div>
                            
                              </div>`);
            $("#preview")
            // .css("top",(e.pageY - xOffset) + "px")
            // .css("left",(e.pageX + yOffset) + "px")
            // .css("top","50%")
            // .css("left","50%")
           
            .fadeIn("fast");

           
        });

        $('#table_products tbody').on('mouseout','td.details-control>a.preview', (e)=>{
         
            $("#preview").remove();
        });
    
        // $('#table_products tbody').on('mousemove','td.details-control>a.preview', (e)=>{
        //     $("#preview")
        //     .css("top",(e.pageY - xOffset) + "px")
        //     .css("left",(e.pageX + yOffset) + "px");
        // });

        $('#table_products tbody').on('click','button[data-action="edit-product"]', (e)=>{
            let href = $(e.currentTarget).data('href');
            let features = $(e.currentTarget).data('features');
            let benefits = $(e.currentTarget).data('benefits');
            elements.img_modal.attr('src', href);
            elements.benefits_modal.val(benefits);
            elements.features_modal.val(features);
            elements.product_id.val($(e.currentTarget).data('id'));
        });
        

        // $("#table_products tbody").find('td.details-control>a.preview').hover("",function(e){
        // this.t = this.title;
        // this.title = "";
        
        // var c = (this.t != "") ? "<br/>" + this.t : "";
        //     $("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");
        //     $("#preview")
        //     .css("top",(e.pageY - xOffset) + "px")
        //     .css("left",(e.pageX + yOffset) + "px")
        //     .fadeIn("fast");
        // },
        // function(){
        // this.title = this.t;
        //        $("#preview").remove();
        // });
        // $("a.preview").mousemove(function(e){
        //     $("#preview")
        //     .css("top",(e.pageY - xOffset) + "px")
        //     .css("left",(e.pageX + yOffset) + "px");
        // });
    };

    function convertLines(text){
        var lines =  text.split("\n");
        var list = '';
        var items = "";
        $.each(lines, function(n, elem) {
             items += `<li>${elem}</li>`
        });
       if(items != ''){
        list = "<ul>" + items + "</ul>";
          return list;
       }
       return list;
  }

  function decodeLines(text){
   return text.replace("<br />", "'\r\n").trim();
  }
     
    
}

