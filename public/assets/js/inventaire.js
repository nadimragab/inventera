
qrs = [];
i=0;

function getQr() {
    i++;
    var qr = $('#qr').val();
    qrs.push(qr);
    url='http://localhost:8000/api/'+qr;
    table = document.getElementById("inventaire");
    row =table.insertRow(i);
    UnitRef= row.insertCell();
    UnitStr= row.insertCell();
    UnitSer= row.insertCell();
    Unitnbr= row.insertCell();
    Unitep= row.insertCell();

    axios.get(url).then(function(response){
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

    })
}




