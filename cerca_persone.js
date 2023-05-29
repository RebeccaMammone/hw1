let scelto;
let nome;

function onJSON(json)
{
    const risultato=document.querySelector("#risultato");
    risultato.innerHTML='';
    document.querySelector("#errore").classList.add("hidden");
    
    for(let i of json){
        const profilo=document.createElement('div');
        const username=document.createElement('div');
        const immagine=document.createElement('img');
        const genere=document.createElement('div');
        const sessualita=document.createElement('div');
        const info=document.createElement('div');

        const match=document.createElement('button');
        const cuore=document.createElement('img');
        const info2=document.createElement('div');

        username.textContent=i.username;
        genere.textContent=i.genere;
        sessualita.textContent=i.sessualita;
        match.textContent="MATCH";
        match.dataset.user=i.username;
        immagine.src="./immagini/utente.jpg"; 
        cuore.src="./immagini/rosa.png";
        cuore.dataset.user=i.username;

        info.classList.add('info');
        username.classList.add('username');
        genere.classList.add('genere');
        sessualita.classList.add('sessualita');
        immagine.classList.add('utente2');
        profilo.classList.add('profilo');
        match.classList.add('match');
        cuore.classList.add('cuore');
        cuore.classList.add('hidden');
        info2.classList.add('info');

        info.appendChild(username);
        info.appendChild(genere);
        info.appendChild(sessualita);
        info2.appendChild(cuore);
        info2.appendChild(match);
        profilo.appendChild(immagine);
        profilo.appendChild(info);
        profilo.appendChild(info2);
        risultato.appendChild(profilo);
        
        fetch("fetch_controlla_match.php?q="+i.username).then(onResponse).then(databaseResponse2);

        match.addEventListener('click', matchPersona);
    }
    
    
}

function matchPersona(event){
    const match=event.currentTarget;
    scelto=match.dataset.user;

    fetch("fetch_match.php?q="+match.dataset.user).then(onResponse).then(databaseResponce);
}


function databaseResponce(json){
    cuori=document.querySelectorAll(".cuore");
    for(let k=0; k<cuori.length; k++){
        if(cuori[k].dataset.user===scelto){
            if(json.ok){
                cuori[k].classList.remove("hidden");
                
            }
            else{
                cuori[k].classList.add("hidden");
            }
        }
    }
}

function databaseResponse2(json){
    cuori=document.querySelectorAll(".cuore");
    for(let k=0; k<cuori.length; k++){
        console.log(cuori.length);

        if(cuori[k].dataset.user===json.user2){
            if(json.ok){
                console.log("CONTROLLO Matchato");
                cuori[k].classList.remove("hidden");
            }
            else{
                console.log("CONTROLLO Non matchato");
                cuori[k].classList.add("hidden");
            }
            console.log(json);
        }
    }
}


function onResponse(response)
{
    console.log(response);
    return response.json();
}


function cercaPersona(event)
{
    
    const form_data= new FormData(document.querySelector("form"));
    console.log(form_data.get('search'));
    fetch("fetch_cerca_persone.php?q="+encodeURIComponent(form_data.get('search'))).then(onResponse).then(onJSON);
    console.log("Sono in cercaPersona");
    document.querySelector("#errore").classList.remove("hidden");
    event.preventDefault();
}


document.querySelector("form").addEventListener("submit", cercaPersona);