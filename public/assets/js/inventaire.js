
qrs = [];
i=0;
document.getElementById("qr").addEventListener("input", () => getQr());
button=document.getElementById("fin");
function getQr() {

    var qr = $('#qr').val();

    url='http://localhost:8000/api/unites/'+qr;
    if(qr.length>10 && qrs.indexOf(qr)===-1){
    document.getElementById("qr").value='';
    qrs.push(qr);

    table = document.getElementById("inventaire");

    axios.get(url).then(function(response){
        if (response.data!=null) {
            i++;
            row =table.insertRow(i);
            UnitRef= row.insertCell();
            UnitStr= row.insertCell();
            UnitSer= row.insertCell();
            Unitnbr= row.insertCell();
            Unitep= row.insertCell();
            const inv=response.data.nbrInv;
            const ph=response.data.etatPhy;
            const ref=response.data.refUnite;
            const str=response.data.structureAtt;
            const ser=response.data.serviceAtt.nomService;
            UnitRef.textContent=ref;
            UnitStr.textContent=str.nomStructure;
            UnitSer.textContent=ser;
            Unitnbr.textContent=inv;
            Unitep.textContent=ph;
        }

    })
}
button.addEventListener("click", () => opInv(qrs));
}

function opInv(list) {

    document.getElementById("qr").remove();
    var unites=list;
    structure=structure.replace(/ /g,"-");
    service=service.replace(/ /g,"-");
    url='http://localhost:8000/inventaire/traitement/'+structure+'/'+service;
    console.log(url);
    axios.get(url).then(function(response){
        console.log(response.data);

    })



}




