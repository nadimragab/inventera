qrs = [];
i=0;
document.getElementById("qr").addEventListener("input", () => getQr());
button=document.getElementById("fin");

//Getting QRs from scanner
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

//Comparing scanned elements with database saved ones
function opInv(list) {
    var child = document.getElementById("qr");
    child.parentNode.removeChild(child);
    /*document.getElementById("qr").remove();*/
    var unites=list;
    structure=structure.replace(/ /g,"-");
    service=service.replace(/ /g,"-");
    url='http://localhost:8000/api/'+structure+'/'+service;
    console.log(url);
    axios.get(url).then(function(response){
        unitesApi=[];
        for(let i=0; i<response.data.length;i++){
            element=response.data[i].refUnite;
            unitesApi.push(element);
        }
        let regles=unites.filter(x => unitesApi.includes(x));
        let excedants = unites.filter(x => !unitesApi.includes(x));
        let manquants= unitesApi.filter(x => !unites.includes(x));
        console.log(regles);
        console.log(excedants);
        console.log(manquants);
        $.ajax({
            url: "/inventaire/traitement",
            type: "post",
            data: {regles:regles,
                excedants:excedants,
                manquants:manquants,
            }
        })
    })
}


        //console.log(document.location);
        //traitement(regles,excedants, manquants);
        /*

        
        
        axios.post("/inventaire/traitement", 
        {reg:regles, 
        exc:excedants, 
        mnq:manquants})*/
        //document.location.href = '/inventaire/traitement', true;

        //$(document).ready(traitement(regles,excedants, manquants));

        //document.location.href = "/inventaire/traitement";


