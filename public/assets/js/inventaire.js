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
        //console.log(regles);
        //console.log(excedants);
        //console.log(manquants);
        //traitement(regles, excedants, manquants)      
        //working code for posting data to php controller
        $.ajax({
            url: "/inventaire/redirection",
            type: "post",
            data: {statut:"hello"
            }
        }).then((response)=>{document.body.innerHTML = response}).then(()=>traitement(regles,excedants, manquants));
    })
}

//treating elements
function traitement(reg, exc, manq)
{

        //console.log(reg);
        //button.remove();
        table = document.getElementById("traitement");
        //console.log(table);
        endButton=document.getElementById("fin-traitement");
        let long=0
        for(i=0; i<manq.length;i++)
        {
        j=i+1;
        row =table.insertRow(j);
        refUnite= row.insertCell();
        statUnite= row.insertCell();
        actUnite= row.insertCell();
        refUnite.textContent=manq[i];
        statUnite.textContent="Manquant";
        actUnite.innerHTML="<select name='manquants' id='"+manq[i]+"'> <option value='manquant'>Manquant</option><option value='retrouve'>retrouvé</option><option value='Deteriore'>Déterioré</option>";
        long=j
        }
        //console.log(long);
        for(i=0; i<exc.length;i++)
        {
        j=long+i+1;
        row =table.insertRow(j);
        refUnite= row.insertCell();
        statUnite= row.insertCell();
        actUnite= row.insertCell();
        refUnite.textContent=exc[i];
        statUnite.textContent="excedant";
        actUnite.innerHTML="<select name='excedants' id='"+exc[i]+"'> <option value='excedant'>Excedant</option><option value='restituer'>réstituer</option><option value='reaffecter'>réaffecter</option>";

        }
        endButton.addEventListener("click", () => (
                finOp(reg, exc, manq)

        ));
}

//End of operation
function finOp(regles, excedants, manquants)
{
    var decisions= new Map();
    table = document.getElementById("traitement");
    for (var i = 1, row; row = table.rows[i]; i++) {
        refUnite=row.cells[0].textContent;
        //console.log(refUnite);
        choix = document.getElementById(refUnite);
        if(choix!=null){
            //choix = document.getElementById(refUnite);
            action = choix.options[choix.selectedIndex].value;
            //console.log(action);
            //action=row.cells[2];
            decisions.set(refUnite, action);
            console.log(decisions);
        }
     }
     for(i=0; i<regles.length;i++)
     {
        decisions.set(regles[i], "regle");
     }

     $.ajax({
        url: "/inventaire/traitement",
        type: "post",
        data: {decisions:decisions,
        }
    }).then((response)=>{console.log(response)})

}


