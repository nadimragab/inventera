
qrs = [];
i=0;
document.getElementById("qr").addEventListener("input", () => getQr());
button=document.getElementById("fin");
function getQr() {

    var qr = $('#qr').val();

    url='http://localhost:8000/api/unites/'+qr;
    if(qr.length>11 && qrs.indexOf(qr)===-1){
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
            const ser=response.data.serviceAtt;
            UnitRef.textContent=ref;
            UnitStr.textContent=str.nomStructure;
            UnitSer.textContent=JSON.stringify(ser);
            Unitnbr.textContent=inv;
            Unitep.textContent=ph;
        }

    })
}
button.addEventListener("click", () => opInv(qrs));
}

function opInv(list) {
    console.log(list);
}




