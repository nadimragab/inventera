
qrs = [];

function getQr() {
    


    var qr = $('#qr').val();

    url='http://localhost:8000/api/'+qr;
    spanUnit= document.querySelector('span.js-unit');

    axios.get(url).then(function(response){
        const unit=JSON.stringify(response.data);
        const inv=response.data.nbrInv
        const ph=response.data.etatPhy;
        const ref=response.data.refUnite;
        const str=response.data.structureAtt;
        const ser=response.data.serviceAtt;
        spanUnit.textContent=ref+"  "+ str+"    "+ ser+ "   "+ inv+ "   "+ ph;
        /*console.log(unit);*/

    })

    

}



