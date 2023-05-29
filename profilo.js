
function fetchPersoneJson(json){
    console.log("JSON RICEVUTO");
    console.log(json);

    if(!json.length){
        return;
    }
    document.querySelector("#no").classList.add("hidden");
    const risultato= document.querySelector("#risultato");
    risultato.innerHTML='';
    for(let i of json){
        const profilo=document.createElement('div');
        const username=document.createElement('div');
        const immagine=document.createElement('img');
        const genere=document.createElement('div');
        const sessualita=document.createElement('div');
        const info=document.createElement('div');

        username.textContent=i.username;
        genere.textContent=i.genere;
        sessualita.textContent=i.sessualita;
        immagine.src="./immagini/utente.jpg"; 

        info.classList.add('info');
        username.classList.add('username');
        genere.classList.add('genere');
        sessualita.classList.add('sessualita');
        immagine.classList.add('utente2');
        profilo.classList.add('profilo');

        info.appendChild(username);
        info.appendChild(genere);
        info.appendChild(sessualita);
        profilo.appendChild(immagine);
        profilo.appendChild(info);
        profilo.appendChild(info);
        risultato.appendChild(profilo)
        
    }
}

function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}

function fetchPersone(){
    fetch("fetch_persone.php").then(fetchResponse).then(fetchPersoneJson);
}

fetchPersone();