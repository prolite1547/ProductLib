import { elements, showLoader, hideLoader  } from "../views/base";

export const GenerateReportController = () => {

    elements.frmGenerateReport.on('submit', (e)=>{
        e.preventDefault();
        showLoader();
        let form = new FormData(e.target);
        $.ajax('/ProdLib/public/generate-report', {
            type: "POST",
            data : form,
            contentType: false,
            cache: false,
            processData: false
        }).done( result =>{
            // console.log(result);
            elements.reportResult.html(result);
            elements.floatButton.css('visibility', 'visible');
            hideLoader();
        }).fail(()=>{
            elements.floatButton.css('visibility', 'hidden');
            hideLoader();
        });
    });

    elements.floatButton.on('click', ()=>{
        window.print();
    });
}